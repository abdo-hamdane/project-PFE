<?php
include_once("connexion.php");

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT image FROM activity WHERE id_activite=?");
    $stmt->execute([$id]);
    $activite = $stmt->fetch(PDO::FETCH_ASSOC);


    

    if($activite){

        if(!empty($activite['image']) && file_exists("../Uploads/".$activite['image'])){
            unlink("../Uploads/".$activite['image']);
        }

        $stmt = $pdo->prepare("DELETE FROM activity WHERE id_activite = ?");
        $stmt->execute([$id]);
    }
}

header("Location: Activites_dash.php");
exit();
?>