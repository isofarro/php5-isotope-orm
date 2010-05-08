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
				$definition ? $definition : IsotopeOrmSchema::DEFAULT_FIELD;
			return true;
		}
		return false;
	}
	
	public function addIndex($field, $definition=false) {
		$this->schema->indexes[] = (object)array(
			$definition ? $definition : IsotopeOrmSchema::INDEX => $field
		);
		return true;
	}
	
	/**
		getSchema - returns the schema definition of the current Model
		
		@returns the model schema data object
	**/
	public function getSchema() {
		return $this->schema;
	}
	
	/**
		setSchema - sets up a schema according to the supplied configuration
	**/
	public function setSchema($schemaDefinition) {
		if (is_string($schemaDefinition)) {
			$schemaDefinition = json_decode($schemaDefinition);
		}

		if (is_a($schemaDefinition, 'stdClass')) {
			//echo "Standard class schema\n";
			//print_r($schemaDefinition);
			$this->_processModelDefinition($schemaDefinition);
		} else {
			echo "Received: ", print_r($schemaDefinition);
		}
	}
	
	
	/**
		_processModelDefinition - takes a decoded JSON model and updates the schema with it
		
		@param $modelDefinition - a JSON object containing the model definition
	**/
	protected function _processModelDefinition($modelDefinition) {
		foreach($modelDefinition as $field=>$definition) {
			//echo "{$field}: {$definition}\n";
			$this->_processModelField($field, $definition);
		}
	}
	
	/**
		_processModelField - processes a single field's definition, dealing with
		each token at a time
		
		@param $field - the field name
		@param $definition - a string containing the field definition
	**/
	protected function _processModelField($field, $definition) {
		if (is_string($definition)) {
			$definition = $this->_processFieldDefinition($definition);
		}
		
		foreach($definition as $defToken) {
			switch($defToken) {
				case 'INDEX':
				case 'UNIQUE':
					$this->addIndex($field, $defToken);
					break;
				default:
					$res = $this->addField($field, $defToken);
					if (!$res) {
						echo "WARN: {$field}=>{$defToken} not added.\n";
					}
				break;
			}
		}
	}
	
	/**
		_processFieldDefinition - parses the field definition into an array of attributes
		
		@param $definitionString - the field definition
		@returns an Array of definition tokens
	**/
	protected function _processFieldDefinition($definitionString) {
		return explode(' ', $definitionString);
	}

}

?>