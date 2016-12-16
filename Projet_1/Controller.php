<?php

//ToDo 
//     : Assainir les entrées & Css 
//     : Retour Details -> Set value   
//     : Retrouver la liste des personne pour sauver dans la bdd
// 	   : BackName -> LIGNE 208 ? CA marche avant !


	session_start();
	
	include "ReservationAccueil_model.php";
	include "Person.php";
	
	$ErreurPerson = array();
	$ErreurAge = array();
	$BackName = array();
	$BackAge = array();
	
	// actions if first validate button is pressed or not --> DETAILS ( Name & age )
	if(isset($_POST["GoDetails"]))
	{	
		$_SESSION["res"] = handleReservation();
		
		// checks if fields are correctly filled otherwise, displays error
		if(($_POST["destination"] != "") && !is_numeric($_POST["destination"]) && ($_POST["nbr_pers"] != 0))
		{
			$res = $_SESSION["res"];
			for ($i = 0 ; $i < $res->get_nbr_pers() ; $i=$i+1)
			{
				$ErreurPerson[$i] = '';
				$ErreurAge[$i] = '';
				$BackName[$i] = '';
				$BackAge[$i] = '';
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
		// Gestion des entrée de details_view
		$pers = array();
		$var = 0;
		$res = handleReservation();
		
		for($i=0 ; $i < $res->get_nbr_pers()  ;$i++)
		{	
			$pers[$i] = new person($_POST['name'][$i],$_POST['age'][$i]);
			
			$ErreurAge[$i] = '';
			$ErreurPerson[$i] = '';
			$BackName[$i] = '';
			$BackAge[$i] = '';
						
			if ($_POST['name'][$i] == '')
			{
				$var = 1;
				$ErreurPerson[$i] = 'Entrez un nom';
			}
			else {$BackName[$i] = $_POST['name'][$i];}
			
			if ($_POST['age'][$i] == '')
			{	
				$var = 1;
				$ErreurAge[$i] = 'Entrez un age';
			}
			else {$BackAge[$i] = $_POST['age'][$i];}
			
			
		}	
		
		$_SESSION["pers"] = serialize($pers);
		
		// checks if fields are correctly filled otherwise, displays error
		if ($var == 1)
		{
			include "ReservationDetails_view.php";
		}
		
		if ($var == 0)
		{			
			$price = totalprice();						
			include "Validation_view.php";
		}
	}
	
	elseif(isset($_POST['save']))
	{
		SaveInDBB();		
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
		$pers = $_SESSION["pers"];
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
	
	//HOME PAGE --> Destination, Number of person & assurance 
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
				$pers[] = new person("",0);
			}
			return $pers;
		}
		
	}
	
	function GoBack($var)
	{
		$res = handleReservation();
		
		if($var == 1)
		{
			$backdest = $res->get_destination();
			$backpers = $res->get_nbr_pers();
		
			if ($res->get_insurance() == 1){$backinsu = "<input type='checkbox' name='insurance' id='case' checked='checked' /><label for='case'></label><br><br>";}
			else {$backinsu = "<input type='checkbox' name='insurance' id='case' /><label for='case'></label><br><br>";}

			include "ReservationAccueil_view.php";
		}
		
		if($var == 2)
		{
			$pers = retreivePers();
									
			for ($i = 0 ; $i < $res->get_nbr_pers() ; $i=$i+1)
			{		
				$BackName[$i] = $pers[$i]->GetName() ;
				$BackAge[$i] = $pers[$i]->GetAge();
				$ErreurPerson [$i] = '';
				$ErreurAge[$i] = '';
			}
			
			include "ReservationDetails_view.php";
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
	
	function SaveInDBB()
	{
		$res = handleReservation();
		$pers = retreivePers();
		
		if ( $res->get_insurance() == 1) { $insurance = 1;}
		else { $insurance = 0;}
		
		$traveller = '';
		// Display travellers
		for($i=0 ; $i < $res->get_nbr_pers();$i++)
		{	
			$name = $pers[$i]->GetName();
			$age = $pers[$i]->GetAge();
			$traveller = $traveller . $name . '_' . $age;
		}
					
		// Connexion à la base de données
		$bdd = new mysqli("localhost", "root", "","reservation_data") or
		
		die("Could not select database");

		if ($bdd->connect_errno) 
		{
			echo "Echec lors de la connexion à MySQL : (" . $bdd->connect_errno . ")
			" . $bdd->connect_error;
		}

		else { echo "Saved in DataBase"; }
		
		// Modification de la BDD 
		// Ajout dans la base de données 
		$queryAdd = "INSERT INTO `reservation`(`Destination`, `Assurance`, `Voyageur(s)`, `PrixTot`) 
					 VALUES ( '".$res->get_destination()."' , ".$insurance." , '".$traveller."' , ".totalprice()." )";
			
		$result = $bdd->query($queryAdd);
		
	}
?>

