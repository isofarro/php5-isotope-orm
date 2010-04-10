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
	
	function testAddDefaultField() {
		$ret = $this->schema->addField('field1');
		$this->assertTrue($ret);
		//print_r($this->schema->schema);
	}
	
	function testAddPredefinedField() {
		$ret = $this->schema->addField('description', IsotopeOrmSchema::TEXTAREA);
		$this->assertTrue($ret);
		//print_r($this->schema->schema);
	}

	function testAddDuplicateDefaultField() {
		$ret = $this->schema->addField('field1');
		$this->assertTrue($ret);
		$ret = $this->schema->addField('field1');
		$this->assertFalse($ret);
	}

	function testEmptyGetSchema() {
		$schema = $this->schema->getSchema();
		
		$this->assertNotNull($schema);
		//print_r($schema);
		
		$this->assertEquals($this->modelName, $schema->model);
		$this->assertTrue(is_array($schema->fields));
		$this->assertTrue(is_array($schema->indexes));
		$this->assertTrue(is_array($schema->subtables));


		$this->assertEquals(1, count($schema->fields));
		$this->assertEquals(0, count($schema->indexes));
		$this->assertEquals(0, count($schema->subtables));
		
		$this->assertFalse(empty($schema->fields['_id']));
		$definition = $schema->fields['_id'];
		$this->assertNotNull($definition);
		$this->assertTrue(is_string($definition));
		$this->assertEquals('PRIMARY_KEY', $definition);
	}
	
	
}

?>