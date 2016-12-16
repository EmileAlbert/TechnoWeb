<!DOCTYPE html>
<html>
    <head>
        <title>Gestion de la base de données</title>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="style_admin.css" />
	</head>

	<body>
	
		<h1>Réservations éffectuées</h1>
		<table>

			<tr>
				<th>iD</th>
				<th>Destination</th>
				<th>Assurance</th>
				<th>Voyageurs</th>
				<th>Prix</th>
			</tr> 
		
			<?php echo $table; ?>
			
		</table>

	</body>
		
</html>