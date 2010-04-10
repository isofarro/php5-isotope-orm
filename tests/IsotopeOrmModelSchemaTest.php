<?php

require_once dirname(dirname(__FILE__)) . '/IsotopeOrmSchema.php';
require_once dirname(dirname(__FILE__)) . '/IsotopeOrmModelSchema.php';

class IsotopeOrmModelSchemaTest extends PHPUnit_Framework_TestCase {
	var $modelName = 'testModel';
	var $schema;
	
	public function setUp() {
		$this->schema = new IsotopeOrmModelSchema($this->modelName);
	}
	
	public function tearDown() {
	}
	
	function testInitIsotopeOrm() {
		$this->assertTrue(class_exists('IsotopeOrmModelSchema'));
		
		$class = new IsotopeOrmModelSchema($this->modelName);
		$this->assertTrue(is_a($class, 'IsotopeOrmModelSchema'));
	}
	
	function testModelSchemaName() {
		$this->assertEquals($this->schema->name, $this->modelName);
	}
	
	function testAddDefaultField() {
		$ret = $this->schema->addField('field1');
		$this->assertTrue($ret);
		//print_r($this->schema->schema);
	}

	function testAddDuplicateDefaultField() {
		$ret = $this->schema->addField('field1');
		$this->assertTrue($ret);
		$ret = $this->schema->addField('field1');
		$this->assertFalse($ret);
	}

}

?>