<?php

namespace Controller\Core;

use Exception;

class Front {
    public static function init() {
        $controllerClassName = self :: getControllerClassName();
        $request = \Ccc::objectManager('\Model\Core\Request');
        
        if (!class_exists($controllerClassName)) {
            throw new Exception('Class does not found');
        }

        $controller = new $controllerClassName($request);
        
        $method = $request->getRequest('a').'Action';

        if (!method_exists($controllerClassName, $method)) {
            throw new Exception('Method dose not exist');
        }

        $controller->$method();
    }

    public static function getControllerClassName() {
        $request = \Ccc::objectManager('\Model\Core\Request');
        $controllerClassName = '\Controller '.$request->getControllerName();
        $controllerClassName = str_replace('_', ' ', $controllerClassName);
        $controllerClassName = ucwords($controllerClassName);
        $controllerClassName = str_replace(' ', '\\', $controllerClassName);
        return $controllerClassName;
    }
}