<!-- transport.php -->

<?php

session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

include_once("connexion.php");

/* =========================
   SELECT TRANSPORT
========================= */

$sql = "SELECT * FROM transport";

$stmt = $pdo->prepare($sql);

$stmt->execute();

$transports = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Transport Dashboard</title>

<link rel="stylesheet" href="sidebar.css">

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

/* ================= TRANSPORT PAGE ================= */

.transport-container{
    margin-left:280px;
    width:calc(100% - 280px);
    padding:40px;
}

.transport-title{
    font-size:32px;
    margin-bottom:25px;
    color:#222;
    font-weight:bold;
}

/* ================= TABLE ================= */

.transport-table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 5px 20px rgba(0,0,0,0.1);
}

.transport-table thead{
    background:#C9A227;
    color:white;
}

.transport-table th,
.transport-table td{
    padding:15px;
    text-align:center;
}

.transport-table td{
    font-weight: 600;
    
}

.transport-table tbody tr{
    border-bottom:1px solid #eee;
    transition:0.3s;
}

.transport-table tbody tr:hover{
    background:#f9f9f9;
}

/* ================= STATUS ================= */

.transport-status{
    padding:6px 14px;
    border-radius:20px;
    color:white;
    font-size:14px;
    font-weight:bold;
}

.transport-available{
    background:green;
}

.transport-unavailable{
    background:red;
}

/* ================= TYPE ================= */

.transport-type{
    padding:6px 14px;
    border-radius:20px;
    color:white;
    font-size:14px;
    font-weight:bold;
}

.transport-location{
    background:#2563eb;
}

.transport-touristique{
    background:#C9A227;
}

/* ================= BUTTONS ================= */

.transport-btn-edit{
    padding:8px 16px;
    border:none;
    background:#2563eb;
    color:white;
    border-radius:8px;
    cursor:pointer;
    margin-right:5px;
    transition:0.3s;
}

.transport-btn-edit:hover{
    background:#1d4ed8;
}

.transport-btn-delete{
    padding:8px 16px;
    border:none;
    background:#dc2626;
    color:white;
    border-radius:8px;
    cursor:pointer;
    transition:0.3s;
}

.transport-btn-delete:hover{
    background:#b91c1c;
}

.transport-btn-add{
    padding:12px 20px;
    border:none;
    background:#16a34a;
    color:white;
    border-radius:10px;
    cursor:pointer;
    margin-bottom:20px;
    font-size:16px;
    font-weight:bold;
}

a{
    text-decoration:none;
}

/* ================= RESPONSIVE ================= */

@media(max-width:900px){

    .transport-container{
        margin-left:0;
        width:100%;
        padding:90px 20px 20px;
    }

    .transport-table{
        font-size:14px;
    }

    .transport-table th,
    .transport-table td{
        padding:10px;
    }

}

</style>
</head>
<body>

<!-- ================= SIDEBAR ================= -->

<?php include_once("sidebar.php"); ?>

<!-- ================= CONTENT ================= -->

<div class="transport-container">

<h1 class="transport-title">
    Transport Dashboard
</h1>

<a href="Ajouter_Trans.php">

<button class="transport-btn-add">
    + Add Transport
</button>

</a>

<table class="transport-table">

<thead>
<tr>
    <th>ID</th>
    <th>Type Transport</th>
    <th>Capacité</th>
    <th>Prix</th>
    <th>Pickup</th>
    <th>Destination</th>
    <th>Image</th>
    <th>Disponibilité</th>
    <th>Actions</th>
</tr>
</thead>

<tbody>

<?php foreach($transports as $row){ ?>

<tr>

<td><?= $row['Id_transport']; ?></td>

<!-- TYPE SERVICE -->

<td>
    <?= $row['type_transport']; ?>
</td>

<!-- CAPACITE -->

<td><?= $row['capacite']; ?></td>

<!-- PRIX -->

<td><?= $row['prix_transport']; ?> DH</td>

<!-- PICKUP -->

<td>

<?= $row['pickup'] ; ?>

</td>

<!-- DESTINATION -->

<td>

<?= $row['Destination'] ; ?>

</td>

<!-- l'image -->
<td>
    <img src="../Uploads/<?= $row['Image_Voiture']; ?>"
        width="120"
        height="70"
        style="object-fit:cover;border-radius:10px;">
</td>
<!-- DISPONIBILITE -->

<td>

<?php if($row['disponibilite'] == 1){ ?>

<span class="transport-status transport-available">
    Disponible
</span>

<?php } else { ?>

<span class="transport-status transport-unavailable">
    Indisponible
</span>

<?php } ?>

</td>

<!-- ACTIONS -->

<td>

<a href="edit_transport.php?id=<?= $row['Id_transport']; ?>">

<button class="transport-btn-edit">
    Modifier
</button>

</a>

<a href="Supprimer_Trans.php?id=<?php echo $row['Id_transport']; ?>"
       onclick="return confirm('Supprimer ce transport ?');">
        Delete
    </a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</body>
</html>