<?php

session_start();


if(!isset($_SESSION['temp_email'])){
    header("Location: verification_email.php");
    exit();
}
include_once($_SERVER['DOCUMENT_ROOT'] . "/PFE/Dashboard/connexion.php");
$email = $_SESSION['temp_email'];

/* get client id (IMPORTANT SECURITY FIX) */
$getClient = $pdo->prepare("SELECT id_client FROM client WHERE email=?");
$getClient->execute([$email]);
$client = $getClient->fetch(PDO::FETCH_ASSOC);

if(!$client){
    header("Location: verification_email.php");
    exit();
}

$client_id = $client['id_client'];

/* reservations */
$sql = $pdo->prepare("
SELECT r.*, a.type_activite, a.image
FROM reservation r
INNER JOIN activity a ON r.id_activite = a.id_activite
WHERE r.id_client = ?
ORDER BY r.id_reservation DESC
");

$sql->execute([$client_id]);
$reservations = $sql->fetchAll(PDO::FETCH_ASSOC);

/*reservation transport */
$sqlTransport = $pdo->prepare("
SELECT rt.*, t.type_transport, t.image_voiture
FROM reservation_transport rt
INNER JOIN transport t ON rt.id_transport = t.id_transport
WHERE rt.id_client = ?
ORDER BY rt.id_reservation_transport DESC
");

$sqlTransport->execute([$client_id]);
$reservationsTransport = $sqlTransport->fetchAll(PDO::FETCH_ASSOC);



?>


<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mes Réservations</title>

<style>
/* RESET */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    background: linear-gradient(135deg, #f7e7c6, #f2d19c, #e7b66b);
    min-height:100vh;
    overflow-x:hidden;
}

/* HEADER */
.header-1{
    background: linear-gradient(135deg, #b45309, #d97706, #f59e0b);
    color:white;
    padding:30px 20px;
    text-align:center;
    box-shadow:0 10px 30px rgba(0,0,0,0.2);
    position:relative;
    padding-top: 100px;
}

.header-1 h1{
    font-size:32px;
    letter-spacing:1px;
}

/* CONTAINER */
.container-1{
    width:95%;
    max-width:1200px;
    margin:40px auto;
    animation:fadeUp .8s ease;
}

/* CARD / TABLE BOX STYLE */
.table-box{
    background:rgba(255,255,255,0.85);
    backdrop-filter: blur(10px);
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 15px 40px rgba(0,0,0,0.15);
    border:1px solid rgba(255,255,255,0.3);
}

.container-1{
    width:95%;
    max-width:1200px;
    margin:40px auto;
    display:flex;
    flex-direction: column;
    gap:20px;
}

.card{
    display: flex;
    align-items: center;
    justify-content: space-around;
    background:rgba(255,255,255,0.9);
    backdrop-filter:blur(10px);
    border-radius:20px;
    padding:20px 10px;
    box-shadow:0 10px 30px rgba(0,0,0,0.1);
    border-left:5px solid #b45309;
    transition:0.3s;
    
}

.card:hover{
    transform:translateY(-5px);
}

.top{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    flex-direction: column;
    margin-bottom:15px;
    gap: 10px;
}

.card h3{
    margin:0;
    color:#7c2d12;
}

.body p{
    margin:8px 0;
    color:#374151;
    font-size:14px;
}

.status{
    padding:12px 20px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
    text-align: center;
}

.pending{
    background:#fef3c7;
    color:#92400e;
}

.accepted{
    background:#dcfce7;
    color:#166534;
}

.refused{
    background:#fee2e2;
    color:#991b1b;
}

.pending{
    background:#fef3c7;
    color:#92400e;
}

.accepted{
    background:#dcfce7;
    color:#166534;
}

.refused{
    background:#fee2e2;
    color:#991b1b;
}

/* EMPTY STATE */
.empty{
    background:rgba(255,255,255,0.9);
    padding:60px;
    border-radius:20px;
    text-align:center;
    box-shadow:0 10px 30px rgba(0,0,0,0.1);
}

/* BACK BUTTON */
.back-btn{
    display:inline-block;
    margin:30px 30px;
    padding:12px 22px;
    border-radius:12px;
    text-decoration:none;
    background:linear-gradient(135deg,#b45309,#f59e0b);
    color:white;
    transition:0.3s;
    font-weight:500;
    width: 140px;
}

.back-btn:hover{
    transform:translateY(-3px);
    box-shadow:0 10px 20px rgba(180,83,9,0.3);
}

.activity-img{
    width:500px;
    height:200px;
    object-fit:cover;
    border-radius:15px;
    
    transition:0.3s;
}

.card:hover .activity-img{
    transform:scale(1.05);
}
/* ANIMATION */
@keyframes fadeUp{
    from{
        opacity:0;
        transform:translateY(30px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

/* MOBILE */
@media(max-width:768px){
    .card{
        flex-direction: column;
    }
    .table-box{
        overflow-x:auto;
    }

    table{
        min-width:900px;
    }

    .header h1{
        font-size:22px;
    }

    .container{
        width:98%;
    }
    .container-1{
        grid-template-columns:1fr;
    }
    .activity-img{
        width: 100%;
        height: 250px;
        margin-bottom: 15px;
    }
}
@media(max-width:992px){
    .container-1{
        grid-template-columns:repeat(2, 1fr);
    }
}
.btn_action{
    display:flex;
    gap:10px;
    margin-top:10px;
}

.btn_delete{
    padding:12px 20px;
    border-radius:10px;
    text-decoration:none;
    font-size:13px;
    font-weight:600;
    transition:0.3s;
    display:inline-block;

}
.btn_delete{
    background:rgba(255, 218, 218, 0.9);
    color:red;
}

.btn_delete:hover{
    background:#dc2626;
    color:white;
    transform:translateY(-2px);
}


</style>

</head>
<body>
<?php include_once("fronts/header.php");?>

<div class="header-1">
    <h1>Mes Réservations</h1>
</div>
<a href="back/verification_email.php" class="back-btn">
← Retour
</a>
<div class="container-1">



<?php if(count($reservations)>0){ ?>
<h1 style="margin:30px 0 10px;">Réservations Activités</h1>

    <?php foreach($reservations as $r){ 

    $class = "pending";
    if($r['statut']=="Acceptée") $class="accepted";
    if($r['statut']=="Refusée") $class="refused";
    ?>

    <div class="card">

        <img src="Uploads/<?= $r['image']; ?>" alt="activity image" class="activity-img">

        <div class="top">
            <h3><?= $r['type_activite']; ?></h3>
            <p>📅 Date: <strong><?= $r['date_activite']; ?></strong></p>
            <p>👥 Personnes: <strong><?= $r['nb_personnes']; ?></strong></p>
            <p>📍 Pickup: <strong><?= $r['pickup']; ?></strong></p>
            <p>🚗 Transport: <strong><?= $r['transport']; ?></strong></p>
            <p>💰 Prix: <strong><?= $r['prix_total']; ?> EUR</strong></p>
        </div>
        <div class="btn_action">
            <span class="status <?= $class ?>">
                        <?= $r['statut']; ?>
            </span>
            <a href="back/delete_res.php?id=<?= $r['id_reservation']; ?>" 
                class="btn_delete"
                onclick="return confirm('Voulez-vous supprimer cette réservation ?');">
            Supprimer
        </a>
        </div>
    </div>
<?php } ?>
<?php } ?>




<?php if(count($reservationsTransport)>0){ ?>
<h1 style="margin:30px 0 10px;">Mes Réservations Transport</h1>
    <?php foreach($reservationsTransport as $t){

        $class = "pending";
        if($t['statut']=="Acceptée") $class="accepted";
        if($t['statut']=="Refusée") $class="refused";
    ?>

    <div class="card">

        <img src="Uploads/<?= $t['image_voiture']; ?>"
             alt="transport"
             class="activity-img">

        <div class="top">
            <h3><?= $t['type_transport']; ?></h3>

            <p>📅 Date: <strong><?= $t['date_transport']; ?></strong></p>

            <p>👥 Personnes:
                <strong><?= $t['nb_personnes']; ?></strong>
            </p>

            <p>📍 Pickup:
                <strong><?= $t['pickup']; ?></strong>
            </p>

            <p>💰 Prix:
                <strong><?= $t['prix_total']; ?> EUR</strong>
            </p>
        </div>

        <div class="btn_action">

            <span class="status <?= $class ?>">
                <?= $t['statut']; ?>
            </span>

            <a href="back/delete_trans.php?id=<?= $t['id_reservation_transport']; ?>"
               class="btn_delete"
               onclick="return confirm('Voulez-vous supprimer cette réservation ?');">
               Supprimer
            </a>

        </div>

    </div>

    <?php } ?>

<?php } ?>

<?php if(count($reservations)==0 && count($reservationsTransport)==0){ ?>

<div class="empty">
    <h2>Aucune réservation trouvée</h2>
    <p>Aucune réservation n'est associée à cet email.</p>
</div>

<?php } ?>



</div>

</body>
</html>