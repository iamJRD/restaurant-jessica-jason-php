<?php
	 class Restaurant
		{
		private $name;
		private $id;
		private $location;
		private $cuisine_id;

		function __construct($name, $location, $cuisine_id, $id = null) {
			$this->name = $name;
			$this->id = $id;
			$this->location = $location;
			$this->cuisine_id = (integer) $cuisine_id;
		}

		//setters;
		function setLocation($location)
		{
			$this->location = $location;
		}

		function setName($name)
		{
			$this->name = $name;
		}



		//getters;
		function getName()
		{
			return $this->name;
		}

		function getId()
		{
		 	return $this->id;
		}

		function getLocation()
		{
			return $this->location;
		}

		function getCuisineId()
		{
			return $this->cuisine_id;
		}


		static function getAll()
		{
			$returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants;");
			$restaurants = array();
			foreach ($returned_restaurants as $restaurant) {
				$name = $restaurant['name'];
				$location = $restaurant['location'];
				$id = $restaurant['id'];
				$cuisine_id = $restaurant['cuisine_id'];
				$new_restaurant = new Restaurant($name, $location, $cuisine_id, $id);
				array_push($restaurants, $new_restaurant);
			}
			return $restaurants;
		}

		function save()
		{
			$GLOBALS['DB']->exec("INSERT INTO restaurants (name, location, cuisine_id) VALUES ('{$this->getName()}', '{$this->getLocation()}', {$this->getCuisineId()});");
			$this->id = $GLOBALS['DB']->lastInsertId();
		}

		static function deleteAll()
		{
			$GLOBALS['DB']->exec("DELETE FROM restaurants");
		}




	}
 ?>
