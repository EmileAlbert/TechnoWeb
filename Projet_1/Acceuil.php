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
		<select name="pays">
			<option value="choix1">Italie</option>
			<option value="choix2" selected='selected'>Espagne</option>
			<option value="choix3">Croatie</option>
			<option value="choix4">France</option>
		</select>
		<p/>
		
		<p>Nombre de voyageur(s):
		<select name="nombre">
			<option value="choix1" selected='selected'>1</option>
			<option value="choix2">2</option>
			<option value="choix3">3</option>
			<option value="choix4">4</option>
		</select>
		
		<p>Assurance annulation
		<input type='checkbox' name='AssAnn' id='case' /><label for='case'></label><br><br>
		</p>
		
		<input type='submit' name='next'  value='Details'/>
		
		</form> <br>
		
		-
			
    </body>
</html>