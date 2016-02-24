<?php
	class Cuisine
	{
		private $name;
		private $id;

		function __construct($name, $id = null) {
			$this->name = $name;
			$this->id = $id;
		}

		//setters;

		public function setName($new_name) {
			$this->name = $new_name;
		}
		//getters;
		public function getName() {
			return $this->name;
		}

		public function getId() {
			return $this->id;
		}

		static function getAll() {
			$returned_cuisines = $GLOBALS['DB']->query("SELECT * FROM cuisine;");
			$cuisines = array();
			foreach ($returned_cuisines as $cuisine) {
				$name = $cuisine['name'];
				$id = $cuisine['id'];
				$new_cuisine = new Cuisine($name, $id);
				array_push($cuisines, $new_cuisine);
			}
			return $cuisines;
		}


        function save() {
            $GLOBALS['DB']->exec("INSERT INTO cuisine (name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

		static function deleteAll() {
			$GLOBALS['DB']->exec("DELETE FROM cuisine");
		}

		static function find($search_id)
		{
		   $found_cuisine = null;
		   $cuisines = Cuisine::getAll();
		   foreach($cuisines as $cuisine) {
			   $cuisine_id = $cuisine->getId();
			   if ($cuisine_id == $search_id) {
				 $found_cuisine = $cuisine;
			   }
		   }
		   return $found_cuisine;
		}

		function getRestaurants() {
			$returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants WHERE cuisine_id = {$this->getId()};");
			$restaurants = array();
			foreach ($returned_restaurants as $restaurant) {
				$name = $restaurant['name'];
				$location = $restaurant['location'];
				$cuisine_id = $restaurant['cuisine_id'];
				$id = $restaurant['id'];
				$new_restaurant = new Restaurant($name, $location, $cuisine_id, $id);
				array_push($restaurants, $new_restaurant);
			}
			return $restaurants;
		}

		function update($updated_cuisine_name) {
			$GLOBALS['DB']->exec("UPDATE cuisine SET name = '{$updated_cuisine_name}' WHERE id = {$this->getId()};");
			$this->setName($updated_cuisine_name);
		}

		function delete() {
			$GLOBALS['DB']->exec("DELETE FROM cuisine WHERE id = {$this->getId()};");
		}
	}
 ?>
