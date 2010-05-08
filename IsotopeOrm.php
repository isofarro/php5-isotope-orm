<?php

require_once dirname(__FILE__) . '/IsotopeOrmSchema.php';
require_once dirname(__FILE__) . '/IsotopeOrmModel.php';
require_once dirname(__FILE__) . '/IsotopeOrmModelSchema.php';

class IsotopeOrm {
	// Configuration options. TODO: Provide conventional defaults
	private $_config = array();
	
	// Datasource: PDO or other storage class/interface
	private $_db = NULL;
	
	// Database schema
	private $_dbSchema = array();
	
	// Database models
	private $_dbModels = array();
	
	
	public function __construct($config=false) {
		if ($config) {
			$this->setConfig($config);
		}
	}
	
	public function __destruct() {
		// TODO: Persist edited schemas
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
			This method caches ModelSchemas. 
			Throws an exception if the ModelSchema already exists
	
		@param $modelName - a model name (must not currently exist)
		@param $schema - an optional schema definition
		
		@returns a new instance of IsotopeOrmModelSchema
	**/
	public function createModelSchema($modelName, $schema=false) {
		if (empty($this->_dbSchema[$modelName])) {
			$modelSchema = new IsotopeOrmModelSchema($modelName);
			// TODO: If the schema parameter is passed in, process it

			$this->_dbSchema[$modelName] = $modelSchema;
			return $modelSchema;
		} else {
			throw new InvalidArgumentException('IsotopeOrm Model already exists');
		}
	}
	
	/**
		getModelSchema - get the Schema for the specified Model. 
			This method caches ModelSchemas.
		
		@param $modelName - the name of the model
		
		@returns an IsotopeOrmModelSchema if the model exists, or false if it doesn't
	**/
	public function getModelSchema($modelName) {
		if (empty($this->_dbSchema[$modelName])) {
			// TODO: Get the model schema from the datasource
		} else {
			return $this->_dbSchema[$modelName];
		}
		return false;
	}
	
	
	/**
		getModel - get the requested model. 
			This method caches Models
		
		@param $modelName - the name of the model
		
		@returns an IsotopeOrmModel if the model exists, or false if it doesn't
	**/
	public function getModel($modelName) {
		if (!empty($this->_dbModels[$modelName])) {
			return $this->_dbModels[$modelName];
		} else {
			$model = new IsotopeOrmModel($modelName);
			
			// Apply the model schema, if there is one defined
			$schema = $this->getModelSchema($modelName);
			if ($schema) {
				$model->setSchema($schema);
			}
			
			$this->_dbModels[$modelName] = $model;
			return $model;
		}
		return false;
	}
	
}

?>