<!-- clients.php -->

<?php
session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

include_once("connexion.php");

/* =========================
   SELECT CLIENTS
========================= */

$sql = "SELECT * FROM Client";

$stmt = $pdo->prepare($sql);

$stmt->execute();

$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Clients Dashboard</title>

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

/* ================= CLIENTS PAGE ================= */

.clients-container{
    margin-left:280px;
    width:calc(100% - 280px);
    padding:40px;
}

.clients-title{
    font-size:32px;
    margin-bottom:25px;
    color:#222;
    font-weight:bold;
}

/* ================= TABLE ================= */

.clients-table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 5px 20px rgba(0,0,0,0.1);
}

.clients-table thead{
    background:#C9A227;
    color:white;
}

.clients-table th,
.clients-table td{
    padding:15px;
    text-align:center;
}

.clients-table tbody tr{
    border-bottom:1px solid #eee;
    transition:0.3s;
}

.clients-table tbody tr:hover{
    background:#f9f9f9;
}

/* ================= BUTTONS ================= */

.clients-btn-edit{
    padding:8px 16px;
    border:none;
    background:#2563eb;
    color:white;
    border-radius:8px;
    cursor:pointer;
    margin-right:5px;
    transition:0.3s;
}

.clients-btn-edit:hover{
    background:#1d4ed8;
}

.clients-btn-delete{
    padding:8px 16px;
    border:none;
    background:#dc2626;
    color:white;
    border-radius:8px;
    cursor:pointer;
    transition:0.3s;
}

.clients-btn-delete:hover{
    background:#b91c1c;
}

.clients-btn-add{
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

    .clients-container{
        margin-left:0;
        width:100%;
        padding:90px 20px 20px;
    }

    .clients-table{
        font-size:14px;
    }

    .clients-table th,
    .clients-table td{
        padding:10px;
    }

}

</style>
</head>
<body>

<!-- ================= SIDEBAR ================= -->

<?php include_once("sidebar.php"); ?>

<!-- ================= CONTENT ================= -->

<div class="clients-container">

<h1 class="clients-title">
    Clients Dashboard
</h1>

<a href="Ajouter_client.php">
    <button class="clients-btn-add">
        + Add Client
    </button>
</a>

<table class="clients-table">

<thead>
<tr>
    <th>ID</th>
    <th>Nom</th>
    <th>Email</th>
    <th>Téléphone</th>
    <th>Actions</th>
</tr>
</thead>

<tbody>

<?php foreach($clients as $row){ ?>

<tr>

<td><?= $row['id_client']; ?></td>

<td><?= $row['nom']; ?></td>

<td><?= $row['email']; ?></td>

<td><?= $row['telephone']; ?></td>

<td>

<a href="edit_client.php?id=<?= $row['id_client']; ?>">

<button class="clients-btn-edit">
    Modifier
</button>

</a>

<a href="supprimer_Client.php?id=<?= $row['id_client']; ?>"
   onclick="return confirm('Supprimer ce client ?');">

    Supprimer

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</body>
</html>