<?php

namespace Controller;

class Product extends Core\Base {


    public function viewAction() {
        $grid = $this->getLayout()->createBlock('\Block\Product\Grid');
        $grid->getLayout()->getChild('content')->addChild($grid, 'grid');
        $this->renderLayout();
    }

    public function gridAction() {
        $this->responce('\Block\Product\Grid');
    }

    public function addAction() {
        $this->responce('\Block\Product\Add');
    }

    public function editAction() {
        try {
            
            $id = $this->getRequest()->getRequest('i');
            
            if (!$id) {
                throw new Exception("Invalid Id.");
            }

            $product = \Ccc::objectManager('\Model\Product');
            $row = $product->load($id);
            
            if (is_null($row->getData())) {
                throw new \Exception("No Record Found .");
            }

            $add = $this->getLayout()->createBlock('\Block\Product\Add');
            $add->setProduct($row);
            $add->setController($this);
            $add = $add->toHtml();
            $this->responce('\Block\Product\Add', $add);
        
        } catch (\Exception $e) {
            $this->getMessageModel()->setMessage('failure', $e->getMessage());
        }
    }

    public function getAddBlockAction() {
        $addHtml = $this->getLayout()
            ->createBlock("\Block\Product\Add");
        $addHtml = $addHtml->toHtml();
        $responseData = [
            'responceType'=>'success',
            'elements'=> [
                [
                    'elementId' => 'content',
                    'html' => $addHtml
                ]
            ]
        ];

        $response = json_encode($responseData);
        $this->getResponse()->setBody($response);
    }

    public function saveAction() {
        try {
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Request.");
            }

            $productData = $this->getRequest()->getPost('product');
            $categories = $this->getRequest()->getPost('categiries');
            $product = \Ccc::objectManager('\Model\Product');
            $categoryProduct = \Ccc::objectManager('\Model\CategoryProduct');

            if ($id = $this->getRequest()->getRequest('i')) {
                $product = $product->load($id);

                if (!$product) {
                    throw new \Exception("Invalid Id.");
                    
                }

                $product->updatedAt = (string)date('Y-m-d H:i:s');
                $categoryProduct->deleteCategoryProduct($id);

            } else {
                $product->createdAt = date('Y-m-d H:i:s');
            }

            $product->setData($productData);
            $product->save();
            if (!$categories) {
                throw new \Exception("Please Select categories");
                
            }
            foreach ($categories as $key => $categoryId) {
                $categoryProduct->productId = $id;
                $categoryProduct->categoryId = $categoryId;
                $categoryProduct->save();
            }

            $this->getMessageModel()->setMessage('success', 'Product Saved');

        } catch (\Exception $e) {
            $this->getMessageModel()->setMessage('failure', $e->getMessage());        
        } finally {
            $this->responce('\Block\Product\Grid');
        }
    }

    public function deleteAction() {
        try {
            $product = \Ccc::objectManager('\Model\Product');
            if ($id = $this->getRequest()->getRequest('i')) {
                $product->delete($id);    
            } else {
                $product->id = $this->getRequest()->getPost('multipalDelete');
                $product->delete();
            }

            $this->getMessageModel()->setMessage('success', 'Product Deleted.');
        } catch (\Exception $e) {
            $this->getMessageModel()->setMessage('failure', $e->getMessage()); 
        } finally {
            $this->responce('\Block\Product\Grid');
        }
    }
}
