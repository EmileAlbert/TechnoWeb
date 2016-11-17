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
		$pers = $res->get_nbr_pers();
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
		<input type='text' name='destination' value="<?php echo $backdest ?>" /> 
					
		<p>Nombre de voyageur(s):
		<input type='text' name='nbr_pers' value="<?php echo $backpers ?>" /> 
				
		<p>Assurance annulation
		<?php echo $backinsu ?>
	
		</p>
		
		<input type='submit' name='GoDetails'  value='Suivant'/>
		
		</form> <br>
				
    </body>
</html>


