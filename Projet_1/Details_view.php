<!DOCTYPE html>
<html>
    <head>
        <title>Détails de la réservation</title>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="style.css" />
		
    </head>
    <body>
	
		<h1>Détails de la réservation</h1>
		
        <form method="post" >
		<table>
			<?php
				for ($i = 0; $i < $res->get_nbr_pers(); $i ++ )
				{		
						$passenger = $i+1;
						echo "Passenger ".$passenger."<br>"; 
						echo "<p>Name
							  <input type='text' name='nom'/>
							  <p/>
							  
							  <p>Age
							  <input type='text' name='age'/>
						      </p>";
				}
			?>
			
			<input name="validation" type="submit" value="Confirmation" / >
			<!-- <input name="reservation" type="submit" value="retour" / > -->
			<!-- <input name="cancel" type="submit" value="annuler" / > -->
        </form>
    
	</body>
</html>

<html>
