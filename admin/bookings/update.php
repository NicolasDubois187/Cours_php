<?php
session_start();

require_once("../../helper.php");
require_once("../../Models/Booking.php");
require_once("../../Models/Schedule.php");
require_once("../../Models/Room.php");

$booking_id = (int)($_GET['booking_id'] ?? 0);
$booking = getBookingById($booking_id);

if ($booking == null) {
    header('Location: list.php');
}
// var_dump($_POST);
// // die;

if ($_POST != null) {

    $booking->setDate($_POST['date']);
    $booking->setScheduleId((int)$_POST['schedule_id']);
    $booking->setNbPlayer((int)$_POST['nb_player']);
    $booking->setTotalPrice((int)$_POST['total_price']);

    $booking->update();
    header('Location: list.php?booking_id=' . $booking_id);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1>Mise à jour des réservations</h1>

    <?php
    include('../includes/menu.php');
    ?>
    <br><br>

    <?php
    $rooms = getRoomsFromDB();


    // var_dump(getRoomsFromDB());
    // die;
    ?>

    <form action="update.php?booking_id=<?= $booking_id ?>" method="POST">

        <label for="roomName">Salle</label>
        <select name="roomName" id="roomName">

            <?php
            foreach ($rooms as $room_key => $room_info) {
                if ((int)$room_key != (int)$booking->getRoomId()) {

                    echo '<option value="">' . $room_info->getName() . '</option>';
                } else {
                    echo '<option value="" selected="selected">' . $room_info->getName() . '</option>';
                }
            }


            ?>

        </select>
        <label for="schedule_id">Heure</label>
        <input type="text" name="schedule_id" id="schedule_id" value=<?= findScheduleById($booking->getSchedule_id())->getHeure(); ?>> <label for="date">Date</label>
        <input type="text" name="date" id="date" value=<?= $booking->getDate(); ?>>
        <label for="nb_player">Nombre de joueurs</label>
        <input type="text" name="nb_player" id="nb_player" value=<?= $booking->getNbPlayer(); ?>>
        <label for="total_price">Montant</label>
        <input type="text" name="total_price" id="total_price" value=<?= $booking->getTotalPrice(); ?>>
        <br><br>
        <input type="submit" value="Mettre à jour">

    </form>

</body>

</html>