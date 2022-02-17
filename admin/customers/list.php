<?php
session_start();

require_once("../../helper.php");
require_once("../../Models/Customer.php");


redirectIfNotAdmin();

$customers = getCustomersFromDB();
// var_dump($customers);
// die;

?>
<html>

<head>
</head>

<body>
	<h1>Nous sommes sur la liste des Clients</h1>

	<?php
	include('../includes/menu.php');
	?>

	<br />
	<table border="1">
		<tr>
			<th>Prénoms</th>
			<th>Noms</th>
			<th>Email</th>
			<th>Action</th>
		</tr>

		//boucle
		<?php
		foreach ($customers as $customer_key => $customer_info) {
		?>
			<tr>
				<td><?= $customer_info->getFirstname(); ?></td>
				<td><?= $customer_info->getLastname(); ?></td>
				<td><?= $customer_info->getEmail(); ?></td>

				<td>
					<a href="../bookings/list.php?customer_id=<?= $customer_info->getId(); ?>">Voir les réservations</a>
					<a href="../customers/update.php?customer_id=<?= $customer_info->getId(); ?>">Modifier</a>
					<a href="../customers/delete.php?customer_id=<?= $customer_info->getId(); ?>">Supprimer</a>
				</td>
			</tr>
		<?php
		}
		?>
		//fin de boucle
	</table>
</body>

</html>