<?php 

namespace Controller;

 class Customer extends Core\Base {
    public function viewAction() {
        $grid = $this->getLayout()->createBlock('\Block\Customer\grid');
        $this->getLayout()->getChild('content')->addChild($grid, 'grid');
        $this->renderLayout();    
    }

    public function addAction() {
        $this->responce('\Block\Customer\Add');
    }

    public function gridAction() {
        $this->responce('\Block\Customer\Grid');
    }

    public function editAction() {
        try {
            
            if (!$id = $this->getRequest()->getRequest('i')) {
                throw new Exception("Invalid Request .");
            }
            
            $customer = \Ccc::objectManager('\Model\Customer');
            $customer = $customer->load($id);
            if (!$customer->getData()) {
                throw new Exception("Customer Not Found .");
            }

            $add = $this->getLayout()->createBlock('\Block\Customer\add');
            $add->setCustomer($customer);
            $add = $add->toHtml();
            $this->responce('\Block\Customer\Add', $add);            

        } catch (\Exception $e) {
            $this->getMessageModel()->setMessage('failure', $e->getMessage());
        }
    }

    public function saveAction() {
        try {
            
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Inavalid Request");
            }

            $customer = \Ccc::objectManager('\Model\Customer');

            if ($id = $this->getRequest()->getRequest('i')) {
                if (!$customer = $customer->load($id)) {
                    throw new \Exception("Invalid Id");
                }

                $customer->updatedAt = date('Y-m-d H:i:s');

            } else {
                $customer->createdAt = date('Y-m-d H:i:s');
            }

            $customerData = $this->getRequest()->getPost('customer');
            $customer->setData($customerData);
            $customer->save();

            $this->getMessageModel()->setMessage('success', 'Product Saved .');
            
        } catch (\Exception $e) {
            $this->getMessageModel()->setMessage('failure', $e->getMessage());
        } finally {
            $this->responce('\Block\Customer\Grid');
        }
    }

    public function deleteAction() {
        try {
            $customer = \Ccc::objectManager('\Model\Customer');

            if ($id = $this->getRequest()->getRequest('i')) {
                $customer->delete($id);
            } else {
                $id = $this->getRequest()->getRequest('multipleDelete');
                $customer->id = $id;
                $customer->delete();
            }

            $this->getMessageModel()->setMessage('success', 'Data Deleted .');

        } catch (\Exception $e) {
            $this->getMessageModel()->setMessage('failure', $e->getMessage());
        } finally {
            $this->responce('\Block\Customer\Grid');
        }
    }
 }