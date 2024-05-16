<?php

namespace Controller;

class Category extends Core\Base {


    public function viewAction() {
        $grid = $this->getLayout()->createBlock('\Block\Category\Grid');
        $grid->getLayout()->getChild('content')->addChild($grid, 'grid');
        $this->renderLayout();
    }

    public function editAction() {
        try {
            if (!$id = $this->getRequest()->getRequest('i')) {
                throw new \Exception("Invalid Request.");
            }
            $category = \Ccc::objectManager('\Model\Category');
            $row = $category->load($id);
            if (is_null($row->getData())) {
                throw new \Exception("No Record Found.");
            }
            $add = $this->getLayout()->createBlock('\Block\Category\Add');
            $add->setCategory($row);
            // $add->setController($this);
                $add = $add->toHtml();
            $this->responce(' ' ,$add);   
        } catch (\Exception $e) {
            $this->getMessageModel->setMessage('failure',$e->getMessage());
        }
        
    }

    public function addAction() {
        // echo $add = $this->getLayout()->createBlock('\Block\Category\Add')->toHtml();
        $this->responce('\Block\Category\Add');
    }

    public function saveAction() {
        try {
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Request");
            }
            $categoryData = $this->getRequest()->getPost('category');
            $category = \Ccc::objectManager('\Model\Category');
            // echo "<pre>";
            if ($id = $this->getRequest()->getRequest('i')) {
                if (!$category = $category->load($id)) {
                    throw new \Exception('Invalid Id');
                }
                $category->updatedAt = date('Y-m-d H:i:s');
                $category->path = $category->getParentPath($id, $categoryData['parentCategory']);
            } else {
                $category->createdAt = date('Y-m-d H:i:s');
                $category->path = $category->getParentPath($categoryData['parentCategory']);
            }
            
            $category->setData($categoryData);
            $category->save();

            $this->getMessageModel()->setMessage('success', 'Category Saved.');
        } catch (\Exception $e) {
            $this->getMessageModel()->setMessage('failure', $e->getMessage());   
        } finally {
            $this->responce('\Block\Category\Grid');
        }
    }

    public function gridAction() {
        $this->responce('\Block\Category\Grid');
    }

    public function deleteAction() {
        try {
            $category = \Ccc::objectManager('\Model\Category');
            if ($id = $this->getRequest()->getRequest('i')) {
                $category->delete($id);    
            } else {
                $category->id = $this->getRequest()->getPost('multipleDelete');
                $category->delete();
            }
        } catch (\Exception $e) {
            $this->getMessageModel->setMessage('failure', $e->getMessage());
        } finally {
            $this->responce('\Block\Category\Grid');
        }
    }
}