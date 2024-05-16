<?php

// include_once 'Model/Core/Row.php';
namespace Model;
use Model\Core\Row;

class Category extends Row {

	const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;
    const STATUS_ENABLE_LABEL = "Enable";           
    const STATUS_DISABLE_LABEL = "Disable";
    protected $status = [
    	self::STATUS_ENABLE => self::STATUS_ENABLE_LABEL,
    	self::STATUS_DISABLE => self::STATUS_DISABLE_LABEL
    ];

    public function __construct($tableName = null , $primaryKey = null)
    {
    	parent::__construct();
        $this->setTableName('category');
        $this->setPrimaryKey('id');
    }

    public function getStatusOption() {
    	return $this->status;
    }

    public function getParentPath($id, $updatedCategoryId = null) {
    	if ($updatedCategoryId) {
    		$parentId = $updatedCategoryId;
    	} else {
    		$parentId = $id;
    	}
    	$parent = new $this();
    	$parent->fetchOne("SELECT `path` FROM `category` WHERE `id` = {$parentId}");
    	$categories = $parent->getAdapter()
    		->fetchPair("SELECT `id`,`path` 
			FROM `category` 
			ORDER BY `path` 
			ASC ;");

    	$path = $parent->path.'_'.$id;
    	$this->updateChild($categories);
    	return $path;
    }

    public function updateChild($categories) {
    	
    }

    
}