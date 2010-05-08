<?php

require_once dirname(dirname(__FILE__)) . '/IsotopeOrm.php';

class BlogOrmTest extends PHPUnit_Framework_TestCase {
	var $orm;
	var $sqliteFile = '/tmp/tmp-isotope-blog-orm-tests.db';
	var $config     = array(
		'datasource' => 'sqlite:/tmp/tmp-isotope-blog-orm-tests.db'
	);
	
	public function setUp() {
		if (file_exists($this->sqliteFile)) {
			unlink($this->sqliteFile);
		}

		$this->orm = new IsotopeOrm($this->config);
	}
	
	public function tearDown() {
		if (file_exists($this->sqliteFile)) {
			//unlink($this->sqliteFile);
		}
	}
	
	public function testCreateModelSchema() {
		$schemaDef = $this->_getBlogSchemaConfig();
		//print_r($schemaDef);
		
		$schema = $this->orm->createModelSchema('simpleBlog', $schemaDef);
		$this->assertNotNull($schema);
		$this->assertTrue(is_a($schema, 'IsotopeOrmModelSchema'));
		
		$schema = $schema->getSchema();
		//print_r($schema);
		
		$this->assertNotNull($schema->model);
		$this->assertNotNull($schema->fields);
		$this->assertNotNull($schema->indexes);
		$this->assertNotNull($schema->subtables);
		
		$this->assertEquals('simpleBlog', $schema->model);
		$this->assertEquals(6, count($schema->fields));
		$this->assertEquals(2, count($schema->indexes));
		$this->assertEquals(0, count($schema->subtables));
		
		$this->assertNotNull($schema->fields['_id']);
		$this->assertEquals('PRIMARY_KEY', $schema->fields['_id']);
		$this->assertNotNull($schema->fields['title']);
		$this->assertEquals('TEXTFIELD', $schema->fields['title']);
		$this->assertNotNull($schema->fields['published']);
		$this->assertEquals('DATETIME INDEX', $schema->fields['published']);
		$this->assertNotNull($schema->fields['link']);
		$this->assertEquals('URL', $schema->fields['link']);
		$this->assertNotNull($schema->fields['atomid']);
		$this->assertEquals('TEXTFIELD UNIQUE', $schema->fields['atomid']);
		$this->assertNotNull($schema->fields['content']);
		$this->assertEquals('TEXTAREA', $schema->fields['content']);
		
		$this->assertNotNull($schema->indexes[0]);
		$this->assertTrue(!empty($schema->indexes[0]->INDEX));
		$this->assertEquals('published', $schema->indexes[0]->INDEX);
		$this->assertTrue(!empty($schema->indexes[1]->UNIQUE));
		$this->assertEquals('atomid', $schema->indexes[1]->UNIQUE);
		
	}
	
	

	protected function _getBlogSchemaConfig() {

		$schema = <<<JSON
{
	"title":      "TEXTFIELD",
	"published" : "DATETIME INDEX",
	"link":       "URL",
	"atomid":     "TEXTFIELD UNIQUE",
	"content":    "TEXTAREA"
}
JSON;
		
		return json_decode($schema);
	}

}

?>