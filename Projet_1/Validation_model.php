<?php
	class confirmation
	{
		//declares required variables.
		private $destination;
		private $number_pers;
		private $insurance;
				
		public function __construct($destination, $number_pers, $insurance)
		{
			$this->destination = $destination;
			$this->number_pers = $number_pers;
			$this->insurance = $insurance;
		}
		
		public function save()		
		{
			$_SESSION['Reservation_model']=serialize($this);
		}
		
		public function get_destination()
		{
			return $this->destination;
		}
		
		public function get_nbr_pers()
		{
			return $this->number_pers;
		}
		
		public function get_insurance()
		{
			return $this->insurance;
		}
		
				
	}
?>