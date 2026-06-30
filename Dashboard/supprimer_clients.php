<?php

include_once("connexion.php");

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM client WHERE id_client=?");
    $stmt->execute([$id]);
}

header("Location: clients_dash.php");
exit();

?>