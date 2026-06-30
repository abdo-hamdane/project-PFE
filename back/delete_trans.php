<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . "/PFE/Dashboard/connexion.php");

if(!isset($_SESSION['temp_email'])){
    header("Location: verification_email.php");
    exit();
}

$id = $_GET['id'];
$email = $_SESSION['temp_email'];

$getClient = $pdo->prepare("SELECT id_client FROM client WHERE email=?");
$getClient->execute([$email]);
$client = $getClient->fetch(PDO::FETCH_ASSOC);

$client_id = $client['id_client'];

$delete = $pdo->prepare("
DELETE FROM reservation_transport
WHERE id_reservation_transport = ? AND id_client = ?
");

$delete->execute([$id, $client_id]);

header("Location: ../Mes_reservation.php");
exit();
?>