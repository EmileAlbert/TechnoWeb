<?php

//ToDo : Assainir les entrées & Css 
//     : Retour Details -> Set value   


	session_start();
	include "ReservationAccueil_model.php";
	include "Person.php";
	
	$error = "";
	$_SESSION["res"] = null; 
	$_SESSION["pers"] = "a";
	$_SESSION["ErreurPerson"] = array();
	$_SESSION["ErreurAge"] = array();
	$_SESSION["BackName"] = array();
	$_SESSION["BackAge"] = array();
	
	// actions if first validate button is pressed or not --> Details ( Name & age )
	if(isset($_POST["GoDetails"]))
	{	
		$_SESSION["res"] = handleReservation();
		
		// checks if fields are correctly filled otherwise, displays error
		if(($_POST["destination"] != "") && !is_numeric($_POST["destination"]) && ($_POST["nbr_pers"] != 0))
		{
			$res = $_SESSION["res"];
			for ($i = 0 ; $i < $res->get_nbr_pers() ; $i=$i+1)
			{
				$_SESSION["ErreurPerson"][$i] = '';
				$_SESSION["ErreurAge"][$i] = '';
				$_SESSION["BackName"][$i] = '';
				$_SESSION["BackAge"][$i] = '';
			}
			include "ReservationDetails_view.php";
			//creates an array objects person and saves it in session.		
		}
		
		else
		{
			$error = "Veuillez entrer une destination et un nombre de passagers !";
			$backdest = "";
			$backpers = "";
			$backinsu = "<input type='checkbox' name='insurance' id='case' /><label for='case'></label><br><br>";
			GoBack(1);
			echo $error;						
		}
	}
	// actions if second validate button is pressed or not --> Confirmation ( resume )
	elseif(isset($_POST["GoValidation"]))
	{	
		$pers = array();
		$var = 0;
		$res = handleReservation();
		
		for($i=0 ; $i < $res->get_nbr_pers()  ;$i++)
		{	
			$pers[] = new person($_POST['name'][$i],$_POST['age'][$i]);
			
			$_SESSION["ErreurAge"][$i] = '';
			$_SESSION["ErreurPerson"][$i] = '';
			$_SESSION["BackName"][$i] = '';
			$_SESSION["BackAge"][$i] = '';
			
			
			if ($_POST['name'][$i] == '')
			{
				$var = 1;
				$_SESSION["ErreurPerson"][$i] = 'Entrez un nom';
			}
			else {$_SESSION["BackName"][$i] = $_POST['name'][$i];}
			
			if ($_POST['age'][$i] == '')
			{
				$var = 1;
				$_SESSION["ErreurAge"][$i] = 'Entrez un age';
			}
			else {$_SESSION["BackAge"][$i] = $_POST['age'][$i];}
		}	
		
		$_SESSION["pers"] = $pers;
		echo $_SESSION["pers"];
		
		// checks if fields are correctly filled otherwise, displays error
		if ($var == 1)
		{
			$list = retreivePers();
			include "ReservationDetails_view.php";
		}
		
		else 
		{
			$_SESSION["pers"] = serialize($pers);
			$price = totalprice();
			include "Validation_view.php";
		}
	
	}
	// action if cancel button is pushed 
	elseif(isset($_POST["cancel"]))
	{
		session_unset();  
		session_destroy();
		$backdest = "";
		$backpers = "";
		$backinsu = "<input type='checkbox' name='insurance' id='case' /><label for='case'></label><br><br>";
		include "ReservationAccueil_view.php"; 
	}
	// action if button back is pushed on ReservationDetails's Page
	elseif(isset($_POST["backAccueil"]))
	{
		GoBack(1);
	}
	
	// action if button back is pushed on Validation's Page
	elseif(isset($_POST["backDetails"]))
	{
		GoBack(2);
	}
	
	// Home Page --> Destination, Number of person & assurance 
	else 
	{
		$backdest = "";
		$backpers = "";
		$backinsu = "<input type='checkbox' name='insurance' id='case' /><label for='case'></label><br><br>";
		include "ReservationAccueil_view.php";
	}
	// FUNCTIONS
	function handleReservation(){	
		if(isset($_POST["insurance"]))
		{
			$insurance = true;
		}
		else
		{
			$insurance = false;
		}
				
		if(isset($_POST["destination"]) && isset($_POST["nbr_pers"]))
			{	
				$res = new reservation($_POST["destination"], $_POST["nbr_pers"], $insurance);
				$res->save();
				
				return $res;
			}
		elseif(isset($_SESSION["Reservation_model"]))
			{	 
				return unserialize($_SESSION["Reservation_model"]);
			}
	}
		
	function retreivePers()
	{	
		//checks if pers object exists in session 
		if(isset($_SESSION["pers"]))
		{	
			// if it does, returns it
			return unserialize($_SESSION["pers"]);		
		}
		else 
		{
			//if it doesn't, creates an empty array and returns it
			$pers = array();
			$res = handleReservation();
			for($i=0; $i<$res->get_nbr_pers();$i++)
			{
				$pers[] = new person("ab",1);
			}
			return $pers;
		}
	}
	
	function totalprice()
	{	
		$price = 0;
		
		$res = handleReservation();
		$pers = retreivePers();
		
		if ($res->get_insurance() == 1)
		{
			$price += 20;
		}

		for($i=0 ; $i < $res->get_nbr_pers() ;$i++)
		{	
			if ($pers[$i]->GetAge() < 12){$price += 10;}			
			else { $price += 15;}
		}
		
		return $price;	

	}	
	function GoBack($var)
	{
		$res = handleReservation();
		$backdest = $res->get_destination();
		$backpers = $res->get_nbr_pers();
		if ($res->get_insurance() == 1){$backinsu = "<input type='checkbox' name='insurance' id='case' checked='checked' /><label for='case'></label><br><br>";}
		else {$backinsu = "<input type='checkbox' name='insurance' id='case' /><label for='case'></label><br><br>";}
		
		if($var == 1)
		{
			include "ReservationAccueil_view.php";
		}
		
		if($var == 2)
		{
			//$_SESSION["pers"] prend la valeur de $pers dans le elseif(GoValidation) mais c'est la valeur initialisée qui apparait ici
			for ($i = 0 ; $i < $res->get_nbr_pers() ; $i=$i+1)
			{
				$_SESSION["BackName"][$i] = '';
				$_SESSION["BackAge"][$i] = '';
			}
			
			include "ReservationDetails_view.php";
		}
	}
	
?>

