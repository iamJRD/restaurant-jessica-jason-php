<?php

	require_once 'src/Restaurant.php';
	require_once 'src/Cuisine.php';

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

	protected function tearDown()
    {
		Cuisine::deleteAll();
		Restaurant::deleteAll();
    }

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

		$cuisine_name = 'Korean';
		$test_cuisine = new Cuisine($cuisine_name);
		$name = 'Restaurant Jason';
		$location = '111 N St.';
		$cuisine_id = $test_cuisine->getId();
		$id = 0;
		$test_restaurant = new Restaurant($name, $location, $cuisine_id, $id);

		//Act;
		$result = $test_restaurant->getCuisineId();

		//Assert;
		$this->assertEquals($cuisine_id, $result);
	}

	function test_getAll() {
		//Arrange;
		$name = 'Restaurant Jason';
		$location = '111 N St.';
		$cuisine_id = 1;
		$id = 0;
		$test_restaurant = new Restaurant($name, $location, $cuisine_id, $id);
		$test_restaurant->save();

		$name2 ='Nongs';
		$location2 = '13 SE Ankeney St.';
		$cuisine_id2 = 2;
		$id2 = 1;
		$test_restaurant2 = new Restaurant($name2, $location2, $cuisine_id2, $id2);
		$test_restaurant2->save();


		//Act;
		$result = Restaurant::getAll();

		//Assert;
		$this->assertEquals([$test_restaurant, $test_restaurant2], $result);
	}

	function test_save()
	{
		//Arrange;
		$name = 'Restaurant Jason';
		$location = '111 N St.';
		$cuisine_id = 1;
		$id = 0;
		$test_restaurant = new Restaurant($name, $location, $cuisine_id, $id);
		$test_restaurant->save();
		//Act;
		$result = Restaurant::getAll();

		//Assert;
		$this->assertEquals($test_restaurant, $result[0]);
	}






	}

?>
