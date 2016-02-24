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

		public function setName($name) {
			$this->name = $name;
		}
		//getters;
		public function getName() {
			return $this->name;
		}

		public function getId() {
			return $this->id;
		}
	}
 ?>
