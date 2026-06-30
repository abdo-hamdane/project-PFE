<?php
include_once("connexion.php");

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT Image_Voiture FROM transport WHERE id_transport=?");
    $stmt->execute([$id]);
    $transport = $stmt->fetch(PDO::FETCH_ASSOC);

    if($transport){

        if(!empty($transport['Image_Voiture']) && file_exists("../Uploads/".$transport['Image_Voiture'])){
            unlink("../Uploads/".$transport['Image_Voiture']);
        }

        $stmt = $pdo->prepare("DELETE FROM transport WHERE id_transport=?");
        $stmt->execute([$id]);
    }
}

header("Location: transport_dash.php");
exit();
?>