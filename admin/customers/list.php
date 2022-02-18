<?php
session_start();

require_once("../../helper.php");
require_once("../../Models/Customer.php");
require_once("../../Models/Booking.php");

$customers = getCustomersFromDB();
$customer_id = (int)(($_GET['customer_id']) ?? 0);

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
      <th>Prénom</th>
      <th>Nom</th>
      <th>Email</th>
      <th>Actions</th>
    </tr>

    <?php
    foreach ($customers as $customer_key => $customer_info) {
      $bookingsOfThisCustomer = getBookingsByCustomer($customer_info->getId());
      $hasBookings = (empty($bookingsOfThisCustomer)) ? false : true;
      if ($hasBookings) {
        $message = "alert('Ce client possèdes des résas!'); event.preventDefault();";
      } else {
        $message = "return confirm('Are you sure?')";
      }
    ?>

      <tr>
        <td><?= $customer_info->getFirstname(); ?></td>
        <td><?= $customer_info->getLastname(); ?></td>
        <td><?= $customer_info->getEmail(); ?></td>
        <td>
          <a href="../bookings/list.php?customer_id=<?= $customer_info->getId(); ?>">Voir les réservations</a>
          <a href="../customers/update.php?customer_id=<?= $customer_info->getId(); ?>">Modifier</a>
          <a href="delete.php?customer_id=<?= $customer_info->getId(); ?>" onclick="<?= $message; ?>">Supprimer</a>
        </td>
      </tr>

    <?php
    }

    if ($customer_id != 0) {
      echo '<p style="color: red">L\'utilisateur "' . getCustomersById($customer_id)->getFirstname() . ' ' . getCustomersById($customer_id)->getLastname() . '" a bien été mis à jour. </p>';
    }
    ?>

  </table>

</body>


</html>