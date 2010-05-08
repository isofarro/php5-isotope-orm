<?php


class IsotopeOrmSchema {
	
	// Field definition constants
	const TEXTFIELD   = 'TEXTFIELD';
	const TEXTAREA    = 'TEXTAREA';
	const PRIMARY_KEY = 'PRIMARY_KEY';
	const TIMESTAMP   = 'TIMESTAMP';
	const DATETIME    = 'DATETIME';
	const URL         = 'URL';
	const EMAIL       = 'EMAIL';
	
	const INDEX       = 'INDEX';
	const UNIQUE      = 'UNIQUE';
	
	// Sugar-constants for field definitions
	const DEFAULT_FIELD = self::TEXTFIELD;
	
	
	// Field-name constants
	const ID_FIELDNAME    = '_id';
	const MODEL_FIELDNAME = '_model';
	
	
	static function generateCreateTableSql($table, $definition) {
		$sqlDefinitions = array();
		foreach($definition as $field=>$definition) {
			$sqlDefinitions[] = self::createFieldDefinitions($field, $definition);
		}
		$sqlDefinitions = implode(",\n\t", $sqlDefinitions);
		
		
		$sql = <<<SQL
CREATE TABLE IF NOT EXISTS `{$table}` (
	{$sqlDefinitions}
);
SQL;

		return $sql;
	}
	
	static function createFieldDefinitions($field, $definition) {
		//echo "{$field}: {$definition}\n";
		
		$sql = array(
			'type'      => '',
			'modifiers' => array()
		);
		
		$tokens = explode(' ', $definition);
		foreach($tokens as $token) {
			switch($token) {
				case self::TEXTFIELD:
				case self::URL:
				case self::EMAIL:
					$sql['type'] = 'VARCHAR(255)';
					break;
				case self::PRIMARY_KEY:
					$sql['type'] = 'INTEGER';
					$sql['modifiers'][] = 'PRIMARY KEY AUTOINCREMENT';
					break;
				//case self::INDEX:
				case self::UNIQUE:
					$sql['modifiers'][] = $token;
					break;
				case self::TIMESTAMP:
				case self::DATETIME:
					$sql['type'] = $token;
					break;
				case self::TEXTAREA:
					$sql['type'] = 'TEXT';
					break;
				case self::INDEX:
					break;
				default:
					echo "WARN: Unrecognised token: {$token}\n",
						"In definition: {$field} => {$definition}\n";
			}
		}
		
		$sql['modifiers'] = trim(implode(' ', $sql['modifiers']));
		return str_pad("`{$field}`", 15) . ' ' . trim(implode(' ', $sql));
	}
	
}

?>