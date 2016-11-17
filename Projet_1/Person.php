<?php
	class person
	{
		private $name;
		private $age;
		
		public function __construct($name, $age)
		{
			$this->name = $name;
			$this->age = $age;
		}
		
		public function GetName()
		{
			return $this->name;
		}
		
		public function GetAge()
		{
			return $this->age;
		}
	}
?>