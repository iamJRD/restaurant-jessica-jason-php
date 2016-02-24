<?php

	require_once 'src/Cuisine.php';

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    $server = 'mysql:host=localhost;dbname=food_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

	class CuisineTest extends PHPUnit_Framework_TestCase
	{

		function test_getName() {
			//Arrange;
			$name = 'Japanese';
			$test_cuisine = new Cuisine($name);

			//Act;
			$result = $test_cuisine->getName();

			//Assert;
			$this->assertEquals($name, $result);
		}


	}

?>
