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
	}
 ?>
