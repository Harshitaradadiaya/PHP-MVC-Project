<?php

session_start();
use Controller\Core\Front;

spl_autoload_register(function($class){
    $class = str_replace('\\', '/', $class);
    require_once Ccc::getBaseDir($class).'.php';
});


class Ccc {

    protected $registry = [];

    public static function getBaseDir($dir = null) {
        if (is_null($dir)) {
            return getcwd();
        }
        return getcwd().DIRECTORY_SEPARATOR.$dir;
    }

    public static function setRegistry($key, $class) {
        if (!$class) {
            throw new \Exception("Invalid Request");
        }
        self::$registry[$key] = $class;
        return self;
    }

    public static function getRegistry($key) {

        if (!array_key_exists($key, self::$registry)) {
            return null;
        }
        return self::$registry[$key];
    }

    public static function objectManager($class , $ton = false) {
        // echo $class."<br>";
        if (!$ton) {
            return new $class();
        }
        if (!$object = self::getRegistry($class)) {
            $object = new $class();
            self::setRegistry($class, $object);
            return $object;
        }
        return $object;
    }

    public function getBaseUrl($url = null) {
        if (is_null($url)) {
            return $_SERVER['PHP_SELF'];
        }
        return $_SERVER['PHP_SELF'].$url;
    }
    
    public function init() {
        Front ::init();
    }
}

Ccc :: init();
