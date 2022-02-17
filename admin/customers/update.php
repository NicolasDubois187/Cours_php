<?php
session_start();

require_once("../../helper.php");
require_once("../../Models/Customer.php");

$customer_id = (int)($_GET['customer_id'] ?? 0);
$customer = getCustomersById($customer_id);

if ($customer == null) {
    header('Location: list.php');
}
// var_dump($_POST);
// // die;

if ($_POST != null) {

    $customer->setLastname($_POST['lastname']);
    $customer->setFirstname($_POST['firstname']);
    $customer->setEmail($_POST['email']);
    $customer->setId($customer_id);

    $customer->update();
    header('Location: list.php?customer_id=' . $customer_id);
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

    <h1>Mise à jour du client</h1>

    <?php
    include('../includes/menu.php');
    ?>
    <br><br>
    <form action="update.php?customer_id=<?= $customer_id ?>" method="POST">

        <label for="lastname">Nom</label>
        <input type="text" name="lastname" id="lastname" value=<?= $customer->getLastname(); ?>>
        <label for="firstname">Prénom</label>
        <input type="text" name="firstname" id="firstname" value=<?= $customer->getFirstname(); ?>>
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value=<?= $customer->getEmail(); ?>>
        <br><br>
        <input type="submit" value="Mettre à jour">

    </form>

</body>

</html>