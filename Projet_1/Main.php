<?php
session_start();

//Page 1's variables
if (isset($_POST['pays'])) { $_SESSION['pays'] = $_POST['pays'];}
if (isset($_POST['nombre'])) { $_SESSION['nombre'] = $_POST['nombre'];}
if (isset($_POST['assann'])) { $_SESSION['assann'] = $_POST['assann'];}

//Page 2's variables
if (isset($_POST['nom'])) { $_SESSION['nom'] = $_POST['nom'];}
if (isset($_POST['nom'])) { $_SESSION['age'] = $_POST['age'];}

if (isset($_POST['next'])) 
{
	include("cible.php");
	$_SESSION['next'] = $_POST['next'];
	
}

	else {include("Projet_V1.php");}


//include("cible.php");

?>

