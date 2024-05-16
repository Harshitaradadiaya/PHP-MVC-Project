<?php 

namespace Model\Core;

class Request {
    public function isPost() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return true;
        }
        return false;
    }

    public function getPost($parameter1 = null,$parameter2 = null) {

        if (!$this->isPost()) {
            throw new Exception('Post method is not set');
        }

        if (!$parameter1) {
            return $_POST;
        }
        
        if (!array_key_exists($parameter1, $_POST)) {
            return $parameter2;
        }

        return $_POST[$parameter1];
    }

    public function getRequest($parameter1 = null,$parameter2 = null) {
        
        if (!$parameter1) {
            return $_REQUEST;
        }
        
        if (!array_key_exists($parameter1, $_REQUEST)) {
            return $parameter2;
        }

        return $_REQUEST[$parameter1];
    }

    public function getControllerName() {
        return $this->getRequest('c', 'index');
    }

    public function getActionName() {
        return $this->getRequest('a', 'index');
    }
}

?>