<?php

class IsotopeOrmModelSchema {
	var $name;
	var $schema = array();
	
	public function __construct($name) {
		$this->name = $name;
		$this->schema = (object) array(
			'fields'  => array(),
			'indexes' => array()
		);
	}
	
	/**
		addField - adds a new field to the existing model
		
		@param $name - name of the new field
		@param $definition - definition of the new field (defaults to
		 IsotopeOrmSchema::TEXTFIELD if invalid or not supplied)
		
		@returns whether the field was added to the schema model or not
	**/
	public function addField($name, $definition=false) {
		if (empty($this->schema->fields[$name])) {
			$this->schema->fields[$name] = 
				$definition ? $definition : IsotopeOrmSchema::TEXTFIELD;
			return true;
		}
		return false;
	}
	
	
}

?>