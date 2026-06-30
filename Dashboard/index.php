<!-- reservation.php -->

<?php

session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

include_once("connexion.php");

/* =========================
   CONFIRMATION RESERVATION
========================= */

if(isset($_GET['confirm'])){

    $id = $_GET['confirm'];

    // update status
    $update = "UPDATE Reservation 
               SET statut='Confirmée'
               WHERE id_reservation=$id";

    if($pdo->query($update)){

        // récupérer email client
        $sqlEmail = "SELECT c.email, c.nom
                     FROM Reservation r
                     JOIN Client c 
                     ON r.id_client = c.id_client
                     WHERE r.id_reservation = $id";

        $resultEmail = $pdo->query($sqlEmail);
        $client = $resultEmail->fetch(PDO::FETCH_ASSOC);

        $to = $client['email'];
        $subject = "Reservation Confirmée";

        $message = "
Bonjour ".$client['nom'].",

Votre réservation a été confirmée avec succès.

Merci de choisir ABTrip.
";

        $headers = "From: abtrip@gmail.com";

        // envoyer email
        mail($to, $subject, $message, $headers);
    }

    header("Location: reservation.php");
}


/* =========================
   AFFICHAGE RESERVATIONS
========================= */

$sql = "SELECT 
            r.id_reservation,
            r.date_reservation,
            r.nb_personnes,
            r.pickup,
            r.transport,
            r.statut,
            c.nom,
            a.type_activite,
            r.prix_total
            
        FROM Reservation r
        JOIN Client c ON r.id_client = c.id_client
        JOIN Activity a ON r.id_activite = a.id_activite
        order by r.id_reservation desc ";

$result = $pdo->query($sql);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reservations Dashboard</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, Helvetica, sans-serif;
}

body{
    background:#f5f5f5;
    padding:40px;
}

.container{
    width:100%;
    width:calc(100% - 280px);
    
}

.title{
    font-size:32px;
    margin:50px 0px;
    color:#222;
    font-weight:bold;

}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0 5px 20px rgba(0,0,0,0.1);
}

table thead{
    background:#C9A227;
    color:white;
}

table th,
table td{
    padding:15px;
    text-align:center;
}

table tbody tr{
    border-bottom:1px solid #eee;
    transition:0.3s;
}

table tbody tr:hover{
    background:#f9f9f9;
}

.status{
    padding:6px 14px;
    border-radius:20px;
    font-size:14px;
    font-weight:bold;
    color:white;
}

.pending{
    background:orange;
}

.confirmed{
    background:green;
}

.cancel{
    background:red;
}

.btn-confirm{
    padding:10px 18px;
    border:none;
    background:#C9A227;
    color:white;
    border-radius:8px;
    cursor:pointer;
    font-weight:bold;
    transition:0.3s;
}

.btn-confirm:hover{
    background:#a88412;
}

.btn-done{
    padding:10px 18px;
    border:none;
    background:green;
    color:white;
    border-radius:8px;
    font-weight:bold;
}

a{
    text-decoration:none;
}

/* ================= DASHBOARD CARDS ================= */

.dashboard-cards{
    display:grid;
    grid-template-columns:repeat(auto-fit, minmax(220px,1fr));
    gap:25px;
    margin-top:30px;
}

.dashboard-card{
    background:white;
    border-radius:18px;
    padding:25px;
    display:flex;
    align-items:center;
    gap:20px;
    box-shadow:0 5px 20px rgba(0,0,0,0.08);
    transition:0.3s;
}

.dashboard-card:hover{
    transform:translateY(-5px);
}

.dashboard-card-icon{
    width:70px;
    height:70px;
    background:#C9A227;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:30px;
    color:white;
}

.dashboard-card-info h3{
    font-size:30px;
    color:#111827;
    margin-bottom:5px;
}

.dashboard-card-info p{
    color:gray;
    font-size:16px;
}

</style>
</head>
<body>
<?php include_once("sidebar.php"); ?>
<!  =================== =============== 
    tableau pour les reservation 
=================================== !>





<div class="container">
    <?php

/* =========================
   STATISTICS
========================= */

// Nombre activités
$activities = $pdo->query("SELECT COUNT(*) FROM Activity")->fetchColumn();

// Nombre clients
$clients = $pdo->query("SELECT COUNT(*) FROM Client")->fetchColumn();

// Argent total
$money = $pdo->query("
SELECT SUM(a.prix)
FROM Reservation r
JOIN Activity a
ON r.id_activite = a.id_activite
")->fetchColumn();

// Nombre réservations
$reservations = $pdo->query("
SELECT COUNT(*) FROM Reservation
")->fetchColumn();

?>

<!-- =========================
   DASHBOARD CARDS
========================= -->

<div class="dashboard-cards">

    <!-- CARD 1 -->
    <div class="dashboard-card">

        <div class="dashboard-card-icon">
            🎯
        </div>

        <div class="dashboard-card-info">
            <h3>
                <?= $activities; ?>
            </h3>

            <p>
                Activities
            </p>
        </div>

    </div>

    <!-- CARD 2 -->
    <div class="dashboard-card">

        <div class="dashboard-card-icon">
            👥
        </div>

        <div class="dashboard-card-info">
            <h3>
                <?= $clients; ?>
            </h3>

            <p>
                Clients
            </p>
        </div>

    </div>

    <!-- CARD 3 -->
    <div class="dashboard-card">

        <div class="dashboard-card-icon">
            💰
        </div>

        <div class="dashboard-card-info">
            <h3>
                <?= $money ? $money : 0; ?> DH
            </h3>

            <p>
                Total Revenue
            </p>
        </div>

    </div>

    <!-- CARD 4 -->
    <div class="dashboard-card">

        <div class="dashboard-card-icon">
            📅
        </div>

        <div class="dashboard-card-info">
            <h3>
                <?= $reservations; ?>
            </h3>

            <p>
                Reservations
            </p>
        </div>

    </div>

</div>

<!  =========  dashborad =========== !>

<h1 class="title">Reservations Dashboard</h1>

<table>

<thead>
<tr>
    <th>ID</th>
    <th>Client</th>
    <th>Activité</th>
    <th>Transport</th>
    <th>Date</th>
    <th>Personnes</th>
    <th>PickUP</th>
    <th>Prix Total</th>
    <th>Status</th>
    <th>Action</th>
</tr>
</thead>

<tbody>

<?php while($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>

<tr>

<td><?= $row['id_reservation']; ?></td>

<td><?= $row['nom']; ?></td>

<td><?= $row['type_activite']; ?></td>


<td>
<?= $row['transport'] ? $row['transport'] : 'Aucun'; ?>
</td>

<td><?= $row['date_reservation']; ?></td>

<td><?= $row['nb_personnes']; ?></td>
<td><?= $row['pickup']; ?></td>
<td><?= $row['prix_total']; ?></td>
<td>

<?php
$status = $row['statut'];

if($status == "En attente"){
    echo "<span class='status pending'>En attente</span>";
}
elseif($status == "Confirmée"){
    echo "<span class='status confirmed'>Confirmée</span>";
}
else{
    echo "<span class='status cancel'>Annulée</span>";
}
?>

</td>

<td>

<?php if($row['statut'] == "En attente"){ ?>

<a href="?confirm=<?= $row['id_reservation']; ?>">

<button class="btn-confirm">
    Confirmer
</button>

</a>

<?php } else { ?>

<button class="btn-done">
    Confirmée
</button>

<?php } ?>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</body>
</html>