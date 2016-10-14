<!DOCTYPE html>
<html>
    <head>
        <title>Exercice 2</title>
        <meta charset="utf-8" />
 
	<script>
		function Result(res) {
		alert("La réponse est " + res);
		}
	</script>

	</head>
    <body>
	
		<h2>Exercice 2 </h2>
		
		<p>Créer un script permettant une page d'additions à compléter. Un bouton doit permettre d'afficher
			la solution ( utiliser JS pour afficher le résultat). </p>
		
		<h3>Additions à compléter</h3>
		
		<?php
			//$i = 0;
			for ($i = 1; $i <= 10; $i++)
			{
				$a = rand(0, 99);
				$b = rand(0, 100);
				$result = $a + $b;
				$button = "<input type='button' value='Solution' onclick='Result($b)'>";
				
				echo "<p><b>$i.</b> : $a + _______ = $result    $button </p> ";
		
			}
		?>
        
		
    </body>
</html>