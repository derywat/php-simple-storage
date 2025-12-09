<?php

namespace derywat\simpleStorage;

interface SimpleLocalStorageInterface {

	public function setValue($key,$value): void;

	public function getValue($key):mixed;

	public function unsetValue($key):void;

	public function getValues():null|array;

}