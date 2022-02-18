<?php
session_start();
require_once("../../helper.php");
require_once("../../Models/Customer.php");
require_once("../../Models/Booking.php");

$customer_id = (int)$_GET['customer_id'];
// $bookingsOfThisCustomer = getBookingsByCustomer($customer_id);
// var_dump($bookingsOfThisCustomer);
// die;
$customer = getCustomersById($customer_id);
// $customerCompleteName = '' . $customer->getFirstname() . ' ' . $customer->getLastname() . '';
// $hasBookings = (empty($bookingsOfThisCustomer)) ? false : true;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Suppression</title>
</head>

<body>

  <h1>Suppression d'utilisateur</h1>

  <?php
  include('../includes/menu.php');
  ?>

</body>

</html>



<?php $customer->delete(); ?>