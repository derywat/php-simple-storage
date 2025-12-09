# Simple PHP library for storing key => value data. 

> [!CAUTION]  
> Interface and classes methods are NOT STABLE until anounced.

# Overview

Library allows persisting data in key => value format using predefined or custom storage classes.

# Included storage classes

## JSON file storage (SimpleLocalStorageJSONFile class)

Class SimpleLocalStorageJSONFile uses JSON file for permanent storage.

### Creating storage object:
```php
$ps = new SimpleLocalStorageJSONFile();
$ps->setStorageFileName('storage/json_persisted_file.txt');
```
Created object contains values read from file.

### Accessing values:

Accessing value by key:  
```php
$value = $ps->getValue('keyname');
```

Getting all stored values:  
```php
$allValues = $ps->getValues();
```

### Persisting values:  
Setting value automatically persist all values to file.  
Value must be serializable in JSON format.

```php
$ps->setValue('keyname',$value);
```

Unsetting value also persists all values to file.  
```php
$ps->unsetValue('keyname');
```

# Implementing custom storage classes

Custom storage can be implemented by extending SimpleLocalStorage abstract class.  

```php

class NewSimpleStorageClass extends SimpleLocalStorage implements SimpleLocalStorageInterface {

	protected function _persist():void {
		//prepare $this->values for persistent storage
		//write or send data to storage or update changed data in storage
	}

	protected function _load():void {
		//load persisted data here
		$this->values = $loadedDataArray;
	}

}
```
