<?php

require_once dirname(__FILE__) . '/IsotopeOrm.php';


/**
	1.) Initialise the ORM
**/

$config = (object) array(
	'datasource' => 'sqlite:/tmp/tmp-feed-aggregator.db';
);

$datasource = new IsotopeOrm($config);


/**
	1.) Query an existing single-table model
**/

$modelName = 'users';
$users = $datasource->getModel($modelName);
print_r($users->getUserById(1));


/**
	2.) Create a new single table model using a schema
	    and store an object
**/
$schema = $datasource->createModelSchema(
	'model_name',
	/* 
		Something declarative, like a JSON-object, 
		an array, an object structure, YAML or INI file.
	*/
);
$newTable = $datasource->createDataModel($schema);
$newTable->store($newItem);

/**
	3.) Set up a model schema procedurally
**/

$schema = $datasource->createModelSchema('model_name');
$schema->addField('name', 'textField');
$schema->createIndex('name');


/**
	4.) On the fly data-model creation (using introspection)
**/

$newSubscriber = (object) array(
	'name'  => "Anon-e-mouse",
	'email' => "amouse@example.com"
);

$datasource->storeData('subscriber', $newSubscriber);

?>