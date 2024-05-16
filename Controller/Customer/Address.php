<?php

namespace Controller\Customer;

class Address extends \Controller\Core\Base {

	protected $customerId = null;

	public function setCustomerId($customerId) {
		$this->customerId = $customerId;
		return $this;
	}

	public function getCustomerId() {
		return $this->customerId;
	}

	public function viewAction() {
		try {
			if (!$id = $this->getRequest()->getRequest('i')) {
				throw new \Exception("Invalid Request");	
			}
			$this->setCustomerId($id);
			$grid = $this->getLayout()->createBlock('\Block\Customer\Address\Grid');
			$grid->setAddress(null, $id);
			$grid = $grid->toHtml();
        	$this->responce('\Block\Customer\Add', $grid);
		} catch (\Exception $e) {
			$this->getMessageModel()->setMessage('failure', $e->getMessage());		
		}
	}

	public function addAction() {
		if (!$id = $this->getRequest()->getRequest('i')) {
			throw new Exception("Invalid Request");	
		}
		$add = $this->getLayout()->createBlock('\Block\Customer\Address\Add');
		$add->setCustomerId($id);
		$add = $add->toHtml();
        $this->responce('\Block\Customer\Add', $add);
	}

	public function editAction() {
		try {
            
            if (!$id = $this->getRequest()->getRequest('id')) {
                throw new Exception("Invalid Request .");
            }
            
            $address = \Ccc::objectManager('\Model\Customer\Address');
            $address = $address->load($id);
            if ($address == null) {
                throw new Exception("Customer Not Found .");
            }
            $add = $this->getLayout()->createBlock('\Block\Customer\Address\Add');
            $add->setAddress($address);
            $add->setCustomerId($this->getRequest()->getRequest('i'));
            $add = $add->toHtml();
            $this->responce('', $add);

        } catch (\Exception $e) {
            $this->getMessageModel()->setMessage('failure', $e->getMessage());
        }
	}

	public function saveAction() {
		try {
            
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Inavalid Request");
            }

            $address = \Ccc::objectManager('\Model\Customer\Address');
            $customerId = $this->getRequest()->getRequest('id');
            if ($id = $this->getRequest()->getRequest('i')) {
                if (!$address = $address->load($id)) {
                    throw new \Exception("Invalid Id");
                }

                $address->updatedAt = date('Y-m-d H:i:s');

            } else {
                $address->createdAt = date('Y-m-d H:i:s');
            }
            $address->user_id = $customerId;
            $addressData = $this->getRequest()->getPost('address');
            $address->setData($addressData);
            $address->save();
            $this->getMessageModel()->setMessage('success', 'Address Saved .');

        } catch (\Exception $e) {
        	echo $e->getMessage();
            $this->getMessageModel()->setMessage('failure', $e->getMessage());
        } finally {
        	$grid = $this->getLayout()->createBlock('\Block\Customer\Address\Grid');
			$grid->setAddress(null, $customerId);
			$grid = $grid->toHtml();
        	$this->responce('\Block\Customer\Add', $grid);
        }
	}

	public function deleteAction() {
		try {
            $address = \Ccc::objectManager('\Model\Customer\Address');
            $customerId = $this->getRequest()->getRequest('i');
            if ($id = $this->getRequest()->getRequest('id')) {
                $address->delete($id);
            } else {
                $id = $this->getRequest()->getRequest('multipleDelete');
                $address->id = $id;
                $address->delete();
            }

            $this->getMessageModel()->setMessage('success', 'Data Deleted .');

        } catch (\Exception $e) {
            $this->getMessageModel()->setMessage('failure', $e->getMessage());
        } finally {
            $grid = $this->getLayout()->createBlock('\Block\Customer\Address\Grid');
			$grid->setAddress(null, $customerId);
			$grid = $grid->toHtml();
        	$this->responce('\Block\Customer\Add', $grid);
        }
	}
}