<?php

require_once dirname(__FILE__) . '/IsotopeOrmSchema.php';
require_once dirname(__FILE__) . '/IsotopeOrmModelSchema.php';

class IsotopeOrm {
	// Configuration options. TODO: Provide conventional defaults
	private $_config = array();
	
	// Datasource: PDO or other storage class/interface
	private $_db = NULL;
	
	// Database schema
	private $_dbSchema = NULL;
	
	
	public function __construct($config=false) {
		if ($config) {
			$this->setConfig($config);
		}
	}
	
	/**
		setConfig - updates the current configuration with the provided hash
			Throws an InvalidArgumentException if the passed config isn't an array
			
		@param $config - an associated array of configuration options
	**/
	public function setConfig($config) {
		if (is_array($config)) {
			$this->_config = array_merge($this->_config, $config);
		} else {
			throw new InvalidArgumentException('IsotopeOrm: Invalid Configuration');
		}
	}
	
	/**
		createModelSchema - creates and returns a new ModelSchema object.
			Throws an exception if the ModelSchema already exists
	
		@param $modelName - a model name (must not currently exist)
		@param $schema - an optional schema definition
		
		@returns a new instance of IsotopeOrmModelSchema
	**/
	public function createModelSchema($modelName, $schema=false) {
		if (empty($this->_dbScheme[$modelName])) {
			$modelSchema = new IsotopeOrmModelSchema($modelName);
			// TODO: If the schema exists, process it

			$this->_dbScheme[$modelName] = $modelSchema;
			return $modelSchema;
		} else {
			throw new InvalidArgumentException('IsotopeOrm Model already exists');
		}
	}
	
	
}

?>