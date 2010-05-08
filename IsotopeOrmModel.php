<?php

class IsotopeOrmModel {
	var $schema;
	
	/**
		isReady - returns whether the Model is ready to be used or not.
			Checks there is a schema.
			TODO: Checks whether the schema is valid
			TODO: Checks whether the necessary tables have been created in the datasource
			
		@returns whether the model is ready to be used or not
	**/
	public function isReady() {
		if (!empty($this->schema)) {
			// TODO: Check the schema is valid
			// TODO: Check the data store has created the schema
			return true;
		}
		return false;
	}
	
	/**
		setSchema -- initialises the model with the defined schema. 
			This is a library specific method, and not to be called publicly.
			
		@param $schema - an IsotopeOrmModelSchema
	**/
	public function setSchema($schema) {
		$this->schema = $schema;
	}
	
}

?>