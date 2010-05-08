<?php


class IsotopeOrmSchema {
	
	// Field definition constants
	const TEXTFIELD   = 'TEXTFIELD';
	const TEXTAREA    = 'TEXTAREA';
	const PRIMARY_KEY = 'PRIMARY_KEY';
	const TIMESTAMP   = 'TIMESTAMP';
	const URL         = 'URL';
	
	
	const INDEX       = 'INDEX';
	const UNIQUE      = 'UNIQUE';
	
	// Sugar-constants for field definitions
	const DEFAULT_FIELD = self::TEXTFIELD;
	
	
	// Field-name constants
	const ID_FIELDNAME    = '_id';
	const MODEL_FIELDNAME = '_model';
	
}

?>