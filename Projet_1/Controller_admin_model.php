<?php
    $mysqli = new mysqli('localhost', 'root', '', 'reservation_data');
    
	if ($mysqli->connect_errno) {
      echo 'ERROR: Connection mysqli failed'.$mysqli->connect_error;
    }
    
	$query = 'SELECT * FROM reservation';
    $result = $mysqli->query($query);
	
	$table = '';
	
	while ($row = $result->fetch_assoc()) {
    
	$table = $table.'<tr><td>'.$row['ID'].'</td>';
	$table = $table.'<td>'.$row['Destination'].'</td>';
	$table = $table.'<td>'.$row['Assurance'].'</td>';
	$table = $table.'<td>'.$row['Voyageur(s)'].'</td>';
	$table = $table.'<td>'.$row['PrixTot'].'</td>';
	$table = $table.'<td><a href="http://localhost/Projet_1/Controller_admin_model.php?action=edit&id='.$row['ID'].'"> <input type="button" value="Editer" /></a></td>';
	$table = $table.'<td><a href="http://localhost/Projet_1/Controller_admin_model.php?action=delete&id='.$row['ID'].'"> <input type="button" value="Supprimer" /></a></td>';

	}
	

	
	if (!isset($_GET["action"])){ include "Controller_admin_view.php";}

	else 
	{
		if($_GET["action"] == 'edit')
		{
			header('Location: http://localhost/Projet_1/Controller.php?action=edit&id='.$_GET['id'].'');
		}
		
		if($_GET["action"] == 'delete')
		{
			$queryDEL = 'DELETE FROM `reservation` WHERE ID='.$_GET["id"];
			$result = $mysqli->query($queryDEL);
			 
			include "Controller_admin_view.php";
			echo "<br>L'entrée de la base de donnée a été supprimée, veuillez recharger pour voir les changements<br>";
			echo '<br><a href="http://localhost/Projet_1/Controller_admin_model.php"> <input type="button" value="Recharger" /></a>';
			
			
		}
	}
	
	$mysqli->close();
	?>
