<?php
	
	session_start();
	include "Reservation_model.php";
	//include "Reservation_view.php";
	$error = "";
	
	//var_dump($_POST);
	
	// actions if first validate button is pressed or not 
	if(isset($_POST["next"]))
	{	
		
		$res = handleReservation();
				
		// checks if fields are correctly filled otherwise, displays error
		if(($_POST["destination"] != "") && !is_numeric($_POST["destination"]) && ($_POST["nbr_pers"] != 0))
		{
			include "Details_view.php";		
		}
		else
		{
			$error = "Veuillez entrer une destination et un nombre de passagers !";
			include "Reservation_view.php";
			echo $error;
						
		}
	}

	elseif(isset($_POST["validation"]))
	{
		echo 'hello';
	}
	
		else 
	{
		include "Reservation_view.php";
	}
	
	
*/
// FUNCTIONS
	
	function handleReservation()
	{
		if(isset($_POST["insurance"])){
			$insurance = true;
		} else {
			$insurance = false;
		}
			
		if(isset($_POST["destination"]) && isset($_POST["nbr_pers"]))
			{
				$res = new reservation($_POST["destination"], $_POST["nbr_pers"], $insurance);
				$res->save();
				
				return $res;
			}
		elseif(isset($_SESSION["reservation_model"]))
			{
				return unserialize($_SESSION["reservation_model"]);
			}
	}
	
		
	function retreiveRes()
	{
		if(isset($_SESSION["reservation_model"]))
		{
			// if reservation existis in session, returns it
			return unserialize($_SESSION["reservation_model"]);
		}
		else
		{
			// otherwise returns a new instance of reservation
			return new reservation("",0,false);
		}
	}
	
	function retreivePers()
	{	
		//checks if paxs object exists in session 
		if(isset($_SESSION["pers"]))
		{	
			// if it does, returns it
			return unserialize($_SESSION["pers"]);		
		}
		else 
		{
			//if it doesn't, creates an empty array and returns it
			$pers = array();
			$res = retreiveRes();
			for($i=0; $i<$res->get_nbr_pers();$i++)
			{
				$pers[] = new pers("",0);
			}
			return $pers;
		}
	}
	
	

?>

