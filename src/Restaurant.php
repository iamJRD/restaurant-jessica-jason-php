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
			$this->cuisine_id = $cuisine_id;
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





	}
 ?>
