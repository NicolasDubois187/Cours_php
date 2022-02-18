<?php
session_start();

require_once("../../helper.php");
require_once("../../Models/Room.php");

redirectIfNotAdmin();

$rooms = getRoomsFromDB();

?>
<html>

<head>
</head>

<body>
	<h1>Nous sommes sur la liste des Salles</h1>

	<?php
	include('../includes/menu.php');
	?>
	<br />
	<table border="1">
		<tr>
			<th>Name</th>
			<th>Description</th>
			<th>Durée</th>
			<th>Interdiction moins de 18 ans</th>
			<th>Niveau</th>
			<th>Joueurs mini</th>
			<th>Joueurs max</th>
			<th>Age</th>
			<th>nouveau</th>
			<th>Actions</th>
		</tr>

		//boucle
		<?php
		foreach ($rooms as $room_key => $room_info) {
		?>
			<tr>

				<td><?= $room_info->getName(); ?></td>
				<td><?= $room_info->getDescription(); ?></td>
				<td><?= $room_info->getDuration(); ?></td>
				<td><?= $room_info->getForbidden18YearOld(); ?></td>
				<td><?= $room_info->getNiveau(); ?></td>
				<td><?= $room_info->getMinPlayer(); ?></td>
				<td><?= $room_info->getMaxPlayer(); ?></td>
				<td><?= $room_info->getAge(); ?></td>
				<td><?= $room_info->getNew() ? 'nouveauté' : ''; ?></td>



				<td>
					<a href="../bookings/list.php?room_id=<?= $room_info->getId(); ?>">Voir les réservations</a>
					<a href="customers/update.php">Modifier</a>
					<a href="customers/delete.php">Supprimer</a>
				</td>
			</tr>
		<?php
		}
		?>
		//fin de boucle
	</table>
</body>


</html>