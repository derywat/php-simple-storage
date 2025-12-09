<?php

namespace derywat\simpleStorage;

abstract class SimpleLocalStorage implements SimpleLocalStorageInterface {

	protected $values;

	public function setValue($key,$value):void {
		if(!isset($this->values)){
			$this->_load();
		}
		$this->values[$key] = $value;
		$this->_persist();
	}

	public function getValue($key):mixed {
		$values = $this->getValues();
		if(isset($values) && is_array($values) && isset($values[$key])){
			return $values[$key];
		}
		return null;
	}

	public function unsetValue($key):void {
		if(!isset($this->values)){
			$this->_load();
		}
		if(isset($this->values[$key])){
			unset($this->values[$key]);
			$this->_persist();
		}
	}

	public function getValues():null|array {
		if(!isset($this->values)){
			$this->_load();
		}
		return $this->values;
	}

	abstract protected function _persist():void;
	abstract protected function _load():void;

}