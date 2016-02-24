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
		protected function tearDown() {
			Cuisine::deleteAll();
		}

		function test_getName() {
			//Arrange;
			$name = 'Japanese';
			$test_cuisine = new Cuisine($name);

			//Act;
			$result = $test_cuisine->getName();

			//Assert;
			$this->assertEquals($name, $result);
		}

		function test_getId() {
			//Arrange;
			$name = 'Japanese';
			$id = 1;
			$test_cuisine = new Cuisine($name, $id);

			//Act;
			$result = $test_cuisine->getId();

			//Assert;
			$this->assertEquals($id, $result);
		}

		function test_getAll() {
			//Arrange;
			$name = 'Japanese';
			$test_cuisine = new Cuisine($name);
			$test_cuisine->save();

			$name2 = 'Korean';
			$test_cuisine2 = new Cuisine($name2);
			$test_cuisine2->save();

			//Act;
			$result = Cuisine::getAll();

			//Assert;
			$this->assertEquals([$test_cuisine, $test_cuisine2], $result);
		}

		function test_save() {
			//Arrange;
			$name = 'Japanese';
			$id = null;
			$test_cuisine = new Cuisine($name, $id);
			$test_cuisine->save();

			//Act;
			$result = Cuisine::getAll();

			//Assert;
			$this->assertEquals($test_cuisine, $result[0]);

		}



	}

?>
