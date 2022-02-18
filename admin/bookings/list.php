<?php
session_start();

require_once("../../helper.php");
require_once("../../Models/Booking.php");
require_once("../../Models/Room.php");
require_once("../../Models/Customer.php");
require_once("../../Models/Schedule.php");




redirectIfNotAdmin();

$customer_id = (int)($_GET['customer_id'] ?? 0);
$room_id = (int)($_GET['room_id'] ?? 0);
if ($customer_id != 0) {
	$bookings = getBookingsByCustomer($customer_id);
} else if ($room_id != 0) {
	$bookings = getBookingsByRoomId($room_id);
} else {
	$bookings = getBookingsFromDB();
}

// var_dump($bookings);
// die;

?>
<html>

<head>
</head>

<body>
	<h1>Nous sommes sur la liste des Réservations</h1>

	<?php
	include('../includes/menu.php');
	?>



	<br />
	<table border="1">
		<tr>
			<th>Salle</th>
			<th>Prénom</th>
			<th>Nom</th>
			<th>Date</th>
			<th>Heure</th>
			<th>Nb joueurs</th>
			<th>Montant</th>
			<th>Actions</th>
		</tr>

		//boucle
		<?php
		foreach ($bookings as $booking_key => $booking_info) {
		?>
			<tr>
				<td><?= findRoomById($booking_info->getRoomId())->getName(); ?></td>
				<td><?= findCustomerById($booking_info->getCustomerId())->getFirstname(); ?></td>
				<td><?= findCustomerById($booking_info->getCustomerId())->getLastname(); ?></td>
				<td><?= $booking_info->getDate(); ?></td>
				<td><?= findScheduleById($booking_info->getSchedule_id())->getHeure(); ?></td>
				<td><?= $booking_info->getNbPlayer(); ?></td>
				<td><?= $booking_info->getTotalPrice(); ?></td>


				<td>

					<a href="../bookings/update.php?booking_id=<?= $booking_info->getId(); ?>">Modifier</a>
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