<?php

namespace derywat\simpleStorage;

use DateTime;
use Exception;

class SimpleLocalStorageJSONFile extends SimpleLocalStorage implements SimpleLocalStorageInterface {

	protected $fileName;

	public function setStorageFileName($fileName):void {
		$this->fileName = $fileName;
	}

	protected function _persist():void {
		$this->_check_storage_file();
		file_put_contents($this->fileName.'.tmp',json_encode($this->getValues()),LOCK_EX);
		chmod($this->fileName.'.tmp',0666);
		if(file_exists($this->fileName)){
			rename($this->fileName,$this->fileName.'.bak.'.((new DateTime())->format('Y-m-d_H.i.s.u')));
		}
		rename($this->fileName.'.tmp',$this->fileName);		
	}

	protected function _load():void {
		$this->_check_storage_file();
		if(file_exists($this->fileName)){
			$fileData = file_get_contents($this->fileName);
			$data = json_decode($fileData,true);
			$this->values = $data;
		} else {
			$this->values = array();
		}
	}

	protected function _check_storage_file():void {
		if(!isset($this->fileName)){
			throw new Exception('Storage file name not set.');
		}
		$path = dirname($this->fileName);
		if(!is_writable($path)){
			throw new Exception("Storage directory \"{$path}\" is not writable.");
		} else if(file_exists($this->fileName) && !is_writable($this->fileName)){
			throw new Exception("Storage file \"{$this->fileName}\" is not writable.");
		}
	}

}