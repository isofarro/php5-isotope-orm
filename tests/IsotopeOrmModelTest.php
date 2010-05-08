<?php

require_once dirname(dirname(__FILE__)) . '/IsotopeOrmModel.php';
require_once dirname(dirname(__FILE__)) . '/IsotopeOrmSchema.php';
require_once dirname(dirname(__FILE__)) . '/IsotopeOrmModelSchema.php';

class IsotopeOrmModelTest extends PHPUnit_Framework_TestCase {
	var $model;
	var $schema;
	var $modelName = 'unitTest';
	
	public function setUp() {
		$this->schema = new IsotopeOrmModelSchema($this->modelName);		
		$this->model  = new IsotopeOrmModel($this->modelName);
		$this->model->setSchema($this->schema);
	}
	
	public function tearDown() {
		
	}
	
	function testInitIsotopeOrmModel() {
		$this->assertTrue(class_exists('IsotopeOrmModel'));
		
		$class = new IsotopeOrmModel();
		$this->assertTrue(is_a($class, 'IsotopeOrmModel'));
	}
	
	function testUnknownModelIsReady() {
		$model = new IsotopeOrmModel('unknownModel');
		$ret = $model->isReady();
		$this->assertFalse($ret);
	}
	
	function testModelIsReady() {
		$this->assertTrue($this->model->isReady());
		print_r($this->model);
	}
	
}

?>