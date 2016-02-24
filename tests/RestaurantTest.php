<?php

	require_once 'src/Restaurant.php';

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    $server = 'mysql:host=localhost;dbname=food_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

	class RestaurantTest extends PHPUnit_Framework_TestCase
	{

	// protected function tearDown()
    // {
    //   Restaurant::deleteAll();
    // }

    function test_getName() {
		//Arrange;
		$name = 'Restaurant Jason';
		$location = '111 N St.';
		$cuisine_id = 1;
		$test_restaurant = new Restaurant($name, $location, $cuisine_id);

		//Act;
		$result = $test_restaurant->getName();

		//Assert;
		$this->assertEquals($name, $result);
	}

	function test_getLocation() {
		//Arrange;
		$name = 'Restaurant Jason';
		$location = '111 N St.';
		$cuisine_id = 1;
		$test_restaurant = new Restaurant($name, $location, $cuisine_id);

		//Act;
		$result = $test_restaurant->getLocation();

		//Assert;
		$this->assertEquals($location, $result);
	}

	function test_getId() {
		//Arrange;
		$name = 'Restaurant Jason';
		$location = '111 N St.';
		$cuisine_id = 1;
		$id = 0;
		$test_restaurant = new Restaurant($name, $location, $cuisine_id, $id);

		//Act;
		$result = $test_restaurant->getId();

		//Assert;
		$this->assertEquals($id, $result);
	}

	function test_getCuisineId() {
		//Arrange;
		$name = 'Restaurant Jason';
		$location = '111 N St.';
		$cuisine_id = 1;
		$id = 0;
		$test_restaurant = new Restaurant($name, $location, $cuisine_id, $id);

		//Act;
		$result = $test_restaurant->getCuisineId();

		//Assert;
		$this->assertEquals($cuisine_id, $result);
	}




	}

?>
