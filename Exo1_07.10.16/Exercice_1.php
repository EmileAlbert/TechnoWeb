<!DOCTYPE html>
<html>
    <head>
        <title>Exercice 1</title>
        <meta charset="utf-8" />
    </head>
    <body>
        <h2>Exercice 1</h2>
		
		<p> Créer un script permettant d'afficher dans l'ordre décroissant les chiffres impairs entre 100 et 0. </p> 
		<!-- Comments -->
		
		<?php 
		
		$i = 0;
		
		echo "<p> Chiffres impairs décroissants de 100 à 0. </p>" ; 
				
		for ($i = 100; $i >= 0; $i--)
		{
			if ($i%2 != 0)
			{
				echo $i .'<br />';
			}
			
		}
		?>
		
    </body>
</html>

