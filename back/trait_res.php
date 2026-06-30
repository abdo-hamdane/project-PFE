<?php

include_once(__DIR__ . "/../Dashboard/connexion.php");



if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];

    $nb_personnes = $_POST['nb_personnes'];
    $date_activite = $_POST['date_activite'];
    $pickup = $_POST['pickup'];
    
    $id_activite = $_POST['id_activite'];

    $transport_option = $_POST['transport_option'];

    $transport = ($transport_option == 1)
    ? "Avec transport"
    : "Sans transport";
    

$id_activite = $_POST['id_activite'];

$stmt = $pdo->prepare("SELECT prix FROM activity  WHERE id_activite=?");
$stmt->execute([$id_activite]);
$activity = $stmt->fetch(PDO::FETCH_ASSOC);
    $prix_total = $activity['prix'];

    $prix_total = $activity['prix'] * $nb_personnes;

    if ($transport_option == 1) {

    if ($nb_personnes <= 6) {
        $prix_total += 60;
    } else {
        $prix_total += 100;
    }

}

    // insertion client
    $check = $pdo->prepare("SELECT id_client FROM client WHERE email=?");
    $check->execute([$email]);

$client = $check->fetch(PDO::FETCH_ASSOC);

if($client){

    $id_client = $client['id_client'];

}else{

    $sqlClient = $pdo->prepare("
        INSERT INTO client(nom,email,telephone)
        VALUES(?,?,?)
    ");

    $sqlClient->execute([
        $nom,
        $email,
        $telephone
    ]);

    $id_client = $pdo->lastInsertId();
}


    // insertion reservation

    $sqlRes = $pdo->prepare("
        INSERT INTO reservation
        (
            date_reservation,
            nb_personnes,
            pickup,
            id_client,
            id_activite,
            transport,
            id_admin,
            statut,
            date_activite,
            prix_total
        )
        VALUES
        (
            CURDATE(),
            ?,
            ?,
            ?,
            ?,
            ?,
            1,
            'En attente',
            ?,
            ?
        )
    ");

    $sqlRes->execute([
    $nb_personnes,
    $pickup,
    $id_client,
    $id_activite,
    $transport,
    $date_activite,
    $prix_total
    ]);

}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Réservation confirmée</title>
<style>
body{
    font-family:Segoe UI,sans-serif;
    background:#f5f5f5;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.box{
    background:white;
    padding:40px;
    border-radius:20px;
    text-align:center;
    box-shadow:0 10px 30px rgba(0,0,0,.1);
    max-width:500px;
}

.icon{
    font-size:70px;
    color:green;
}

h2{
    margin:20px 0;
}

.btn{
    display:inline-block;
    margin-top:20px;
    padding:12px 25px;
    background:#C9A227;
    color:white;
    text-decoration:none;
    border-radius:10px;
    font-weight:bold;
}
</style>
</head>
<body>

<div class="box">

    <div class="icon">✓</div>

    <h2>Réservation enregistrée avec succès</h2>

    <p>
        Merci pour votre réservation.
        Notre équipe vous contactera bientôt.
    </p>

    <a href="../Activite.php" class="btn">
        Retour à l'activité
    </a>

</div>

</body>
</html>

<?php
exit;