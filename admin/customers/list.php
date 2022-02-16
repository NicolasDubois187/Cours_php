<?php 
session_start();

require_once("../../helper.php");

redirectIfNotAdmin();

$customers = getCustomersFromDB();

?>
<html>
	<head>
	</head>
	<body>
		<h1>Nous sommes sur la liste des Clients</h1>
		
		<?php
			include('../includes/menu.php');
		?>
		
		<br/>
		<table border="1">
			<tr>
				<th>Firstname</th>
				<th>Lastname</th>
				<th>Email</th>
				<th>Action</th>
			</tr>
			
			//boucle
			<tr>
				<td>Yann</td>
				<td>Serinet</td>
				<td>yann.srt@gmail.com</td>
				<td>
					<a href="customers/bookings.php">Voir les réservations</a>
					<a href="customers/update.php">Modifier</a>
					<a href="customers/delete.php">Supprimer</a>
				</td>
			</tr>
			//fin de boucle
		</table>
	</body>
</html>