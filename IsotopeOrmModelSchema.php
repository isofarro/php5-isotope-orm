<?php

class IsotopeOrmModelSchema {
	// The schema for this model
	var $schema = NULL;
	
	public function __construct($name) {
		// TODO: add in an changed flag - to help with persisting schemas
		$this->schema = (object) array(
			'model'     => $name,
			'fields'    => array(
				IsotopeOrmSchema::ID_FIELDNAME => IsotopeOrmSchema::PRIMARY_KEY
			),
			'indexes'   => array(),
			'subtables' => array()
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
	
	/**
		getSchema - returns the schema definition of the current Model
		
		@returns the model schema data object
	**/
	public function getSchema() {
		return $this->schema;
	}
}

?>