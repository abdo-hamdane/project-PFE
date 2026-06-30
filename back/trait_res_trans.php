<?php
include_once("../Dashboard/connexion.php");


if($_SERVER["REQUEST_METHOD"] === "POST"){

    $Id_transport = $_POST['Id_transport'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $nb_personnes = $_POST['nb_personnes'];
    $date_transport = $_POST['date_transport'];
    $pickup = $_POST['pickup'];
    
    

    $stmtPrice = $pdo->prepare("SELECT prix_transport FROM transport WHERE Id_transport=?");
    $stmtPrice->execute([$Id_transport]);
    $row = $stmtPrice->fetch(PDO::FETCH_ASSOC);
    $prix_total = $row['prix_transport'];
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

    $stmt = $pdo->prepare("
    INSERT INTO reservation_transport
    (Id_transport,id_client, nb_personnes, date_transport, pickup, prix_total, statut)
    VALUES (?, ?, ?, ?, ?, ?, 'En Attente')
    ");

    $stmt->execute([
    $Id_transport,
    $id_client,
    $nb_personnes,
    $date_transport,
    $pickup,
    $prix_total,
    
]);

    
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Success</title>

<style>
body{
    font-family:Segoe UI, sans-serif;
    background: linear-gradient(135deg,#f5f5f5,#e9f7ef);
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
    margin:0;
    padding:20px;
}

.box{
    background:white;
    padding:40px;
    border-radius:20px;
    text-align:center;
    box-shadow:0 10px 30px rgba(0,0,0,.1);
    max-width:500px;
    width:100%;
    animation: fadeIn .5s ease;
}

.icon{
    font-size:70px;
    color:#16a34a;
    margin-bottom:10px;
}

h2{
    margin:10px 0;
    font-size:24px;
}

p{
    color:#555;
    line-height:1.6;
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
    transition:0.3s;
}

.btn:hover{
    background:#a8841d;
    transform:translateY(-2px);
}

/* animation popup */
@keyframes fadeIn{
    from{
        opacity:0;
        transform:scale(0.9);
    }
    to{
        opacity:1;
        transform:scale(1);
    }
}

/* RESPONSIVE */
@media (max-width:600px){
    .box{
        padding:25px;
        border-radius:15px;
    }

    .icon{
        font-size:55px;
    }

    h2{
        font-size:20px;
    }

    p{
        font-size:14px;
    }

    .btn{
        width:100%;
        padding:12px 5px;
        
    }
}
</style>
</head>

<body>

<div class="box">

    <div class="icon">✓</div>

    <h2>Réservation enregistrée avec succès 🎉</h2>

    <p>
        Merci pour votre réservation.<br>
        Notre équipe vous contactera bientôt.
    </p>

    <a href="../transport.php" class="btn">
        Retour aux transports
    </a>

</div>

</body>
</html>
<?php
exit;