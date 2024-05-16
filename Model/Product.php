<?php

// include_once 'Model/Core/Row.php';
namespace Model;
use Model\Core\Row;

class Product extends Row {
    public function __construct($tableName = null , $primaryKey = null)
    {
    	parent::__construct();
        $this->setTableName('product');
        $this->setPrimaryKey('id');
    }

    public function uploadImage($image) {
    	// print_r($image);
    	if (!$image) {
    		throw new \Exception("Image Not Found");
    	}

    	$imageName = $image['name'];
    	$imageExtention = substr($imageName, strpos($imageName, '.')+1);
    	$imageExtention = strtolower($imageExtention);
    	$extensionArray = ['jpeg', 'jpg', 'png'];
    	$tempName = $image['tmp_name'];
    	$imagePath = \Ccc::getBaseDir('Media\Catalogue\Product\\');
    	if (in_array($imageExtention, $extensionArray)) {
    		if (move_uploaded_file($tempName, $imagePath.$imageName)) {
    			return $imageName;
    		} else {
    			echo 'Not Upload';
    		}
    	} else {
    		echo 'File Extention Allowed JPEG,JPG,PNG';
    	}
    }
}