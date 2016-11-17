<!DOCTYPE html>
<html>
    <head>
        <title>Détails de la réservation</title>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="style.css" />
		
    </head>
    <body>
	
		<h1>Détails de la réservation</h1>
		
        <form method="post">
			<?php
				//promps name and age for all person
				for ($i = 0 ; $i < $res->get_nbr_pers() ; $i=$i+1)
				{
					$p = $i+1;
					$name = $_SESSION["BackName"][$i];
					$age = $_SESSION["BackAge"][$i];
					
					echo "Passager ".$p."";
					echo "<p>Nom <input type='text' name='name[".$i."]' value='".$name."'/>";
					echo "<b>".$_SESSION["ErreurPerson"][$i]."</b></p>";
					echo "<p>Age <input type='text' name='age[".$i."]' value='".$age."'/>";
					echo "<b>".$_SESSION["ErreurAge"][$i]."</b></p>";
				}
			?>

			<input name="GoValidation" type="submit" value="Suivant"/>
			<input name="backAccueil" type="submit" value="Retour" / > 
			<input name="cancel" type="submit" value="Annuler" / >
			
        </form>
	</body>
</html>

