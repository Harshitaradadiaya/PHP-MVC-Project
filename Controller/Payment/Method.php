<?php

namespace Controller\Payment;

class Method extends \Controller\Core\Base {

	public function viewAction() {
		$this->setLayout();
		$grid = $this->getLayout()->createBlock('\Block\Payment\Grid');
		$grid->getLayout()->getChild('content')->addChild($grid , 'grid');
		$this->renderLayout();
	}

	public function addAction() {
		$add = \Ccc::objectManager('\Block\Payment\Add');
		echo $add->toHtml();
	}

	public function saveAction() {
		try {

			if (!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Request");
            }		

			$method = \Ccc::objectManager('\Model\Payment\Method');

			if ($id = $this->getRequest()->getRequest('i')) {
				if (!$method->load($id)) {
					throw new \Exception("Method Not Found");
				}
				$method->updateAt = date('Y-m-d H:i:s');
			} else {
				$method->createdAt = date('Y-m-d H:i:s');
			}

			$methodData = $this->getRequest()->getPost('method');
			$method->setData($methodData);
			$method->save();
		} catch (\Exception $e) {
			echo $e->getMessage();
		} finally {
			$this->redirect('view');
		}
	}

	public function editAction() {
		try {
			if (!$id = $this->getRequest()->getRequest('i')) {
				throw new Exception("Invalid Request");
			}

			$method = new \Model\Payment\Method();
			if (!$method = $method->load($id)) {
				throw new \Exception("Data Not Found");
			}
			$add = new \Block\Payment\Add();
			$add->setMethod($method);
			echo $add->toHtml();
		} catch (\Exception $e) {
			echo $e->getMessage();
		}
	}

	public function deleteAction() {
		try {

			$method = new \Model\Payment\Method();

			if ($id = $this->getRequest()->getRequest('i')) {
				$method->load($id);
				$method->delete();
			} else {
				$id = $this->getRequest()->getRequest('multipleDelete');
				$method->id = $id;
				$method->delete();
			}
		} catch (\Exception $e) {
			echo $e->getMessage();
		} finally {
			$this->redirect('view');
		}
	}
}