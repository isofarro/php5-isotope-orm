<?php

class IsotopeOrm {
	private $_config = array();
	
	public function __construct($config=false) {
		if ($config) {
			$this->setConfig($config);
		}
	}
	
	public function setConfig($config) {
		if (is_array($config)) {
			$this->_config = array_merge($this->_config, $config);
		} else {
			throw new InvalidArgumentException('IsotopeOrm: Invalid Configuration');
		}
	}
	
}

?>