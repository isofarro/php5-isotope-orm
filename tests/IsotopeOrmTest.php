<?php

require_once dirname(dirname(__FILE__)) . '/IsotopeOrm.php';

class IsotopeOrmTest extends PHPUnit_Framework_TestCase {
	var $orm;
	var $sqliteFile = '/tmp/tmp-isotope-orm-tests.db';
	var $config = array(
		'datasource' => 'sqlite:/tmp/tmp-isotope-orm-tests.db'
	);
	
	public function setUp() {
		if (file_exists($this->sqliteFile)) {
			unlink($this->sqliteFile);
		}

		$this->orm = new IsotopeOrm($this->config);
	}
	
	public function tearDown() {
		if (file_exists($this->sqliteFile)) {
			unlink($this->sqliteFile);
		}
	}
	
	function testInitIsotopeOrm() {
		$this->assertTrue(class_exists('IsotopeOrm'));
		
		$class = new IsotopeOrm($this->config);
		$this->assertTrue(is_a($class, 'IsotopeOrm'));
	}
	
	public function testIsotopeOrmSetInvalidConfig() {
		$orm = new IsotopeOrm();
		
		$this->setExpectedException('InvalidArgumentException');
		$orm->setConfig(false);
	}

	public function testIsotopeOrmSetConfig() {
		$orm = new IsotopeOrm();
		$orm->setConfig($this->config);
	}
	
	
	public function testProceduralCreateModelSchema() {
		$schema = $this->orm->createModelSchema('testModel');
		$this->assertNotNull($schema);
		$this->assertTrue(is_a($schema, 'IsotopeOrmModelSchema'));
	}
	
	public function testCreateExistingModelSchema() {
		$schema = $this->orm->createModelSchema('testModel');
		$this->assertNotNull($schema);
		$this->assertTrue(is_a($schema, 'IsotopeOrmModelSchema'));

		$this->setExpectedException('InvalidArgumentException');
		$schema = $this->orm->createModelSchema('testModel');
	}
	
	public function testUnknownGetSchema() {
		$schema = $this->orm->getModelSchema('unknownModel');
		$this->assertFalse($schema);
	}
	
	public function testGetModel() {
		$model = $this->orm->getModel('testModel');
		$this->assertNotNull($model);
		$this->assertTrue(is_a($model, 'IsotopeOrmModel'));
		
	}
	
}

?>