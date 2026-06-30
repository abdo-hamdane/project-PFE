<?php

session_start();
require_once("connexion.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $email = trim($_POST["email"]);
    $mot_de_passe = trim($_POST["mot_de_passe"]);

    $stmt = $pdo->prepare(
        "SELECT * FROM administrateur WHERE Email = ?"
    );
    

    $stmt->execute([$email]);

    $administrateur = $stmt->fetch(PDO::FETCH_ASSOC);

    if($administrateur){

        if($mot_de_passe == $administrateur["mot_de_passe"]){

            $_SESSION["id_admin"] = $administrateur["id_admin"];
            $_SESSION["email"] = $administrateur["Email"];

            header("Location: index.php");
            exit();

        }else{

            header("Location: login.php?message=Mot de passe incorrect");
            exit();
        }

}else{

    header("Location: login.php?message=Email introuvable");
    exit();
}

}else{

    header("Location: login.php");
    exit();
}
?>