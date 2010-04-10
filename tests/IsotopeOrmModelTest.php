<?php

require_once dirname(dirname(__FILE__)) . '/IsotopeOrmModel.php';

class IsotopeOrmModelTest extends PHPUnit_Framework_TestCase {

	function testInitIsotopeOrmModel() {
		$this->assertTrue(class_exists('IsotopeOrmModel'));
		
		$class = new IsotopeOrmModel();
		$this->assertTrue(is_a($class, 'IsotopeOrmModel'));
	}
	
}

?>