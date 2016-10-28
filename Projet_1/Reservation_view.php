<?php
	//variable declaration
	$dest = '';
	$pax = 0;
	$insurance = false;
	$check = false; 		
	
	if(isset($res)) 
	{	
		//loads values from reservation if it exists
		$destination= $res->get_destination();
		$pax = $res->get_nbr_pers();
		$insurance = $res->get_insurance();
	}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Reservation</title>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="style.css" />
    </head>
	
    
	<body>
		
		<h1> Réservation</h1>
		<p>Le prix de la place est de 10 euros jusqu'à 12 ans et ensuite de 15 euros.</p>
		<p>Le prix de l'assurance annulation est de 20 euros quel que soit le nombre de voyageurs.</p>
		
		
		
        <form method="post" >
		<!-- Different part of the form -->
		
		<p>Destination :
		<input type='text' name='destination' value="" /> 
					
		<p>Nombre de voyageur(s):
		<input type='text' name='nbr_pers' value="" /> 
				
		<p>Assurance annulation
		<input type='checkbox' name='inssurance' id='case' /><label for='case'></label><br><br>

		</p>
		
		<input type='submit' name='next'  value='Suivant'/>
		
		</form> <br>
				
    </body>
</html>

<!-- Autre forme de questionnaire -->
<!--
		<select name="pays">
			<option value="choix1">Italie</option>
			<option value="choix2" selected='selected'>Espagne</option>
			<option value="choix3">Croatie</option>
			<option value="choix4">France</option>
		</select>
		<p/>
-->
<!--
		<select name="nombre">
			<option value="choix1" selected='selected'>1</option>
			<option value="choix2">2</option>
			<option value="choix3">3</option>
			<option value="choix4">4</option>
		</select>
-->