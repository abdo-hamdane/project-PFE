<!-- activities.php -->

<?php

session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

include_once("connexion.php");

$sql = "SELECT * FROM Activity";

$stmt = $pdo->prepare($sql);

$stmt->execute();

$activities = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Activities Dashboard</title>

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

/* ================= SIDEBAR ================= */

.sidebar{
    width:260px;
    height:100vh;
    background:#111827;
    position:fixed;
    left:0;
    top:0;
    padding:25px;
}

.logo{
    text-align:center;
    margin-bottom:50px;
}

.logo img{
    width:80px;
    margin-bottom:10px;
}

.logo h2{
    color:#C9A227;
    font-size:28px;
}

.menu{
    list-style:none;
}

.menu li{
    margin:20px 0;
}

.menu li a{
    text-decoration:none;
    color:white;
    font-size:18px;
    display:block;
    padding:12px 15px;
    border-radius:10px;
    transition:0.3s;
}

.menu li a:hover{
    background:#C9A227;
}

.active a{
    background:#C9A227;
}

/* ================= CONTENT ================= */

.container{
    margin-left:280px;
    width:calc(100% - 280px);
    padding:40px;
}

.title{
    font-size:32px;
    margin-bottom:25px;
    color:#222;
    font-weight:bold;
}

/* ================= TABLE ================= */

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:12px;
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

.activity-img{
    width:90px;
    height:60px;
    object-fit:cover;
    border-radius:8px;
}

/* ================= BUTTONS ================= */

.btn-edit{
    padding:8px 16px;
    border:none;
    background:#2563eb;
    color:white;
    border-radius:8px;
    cursor:pointer;
    margin-right:5px;
}

.btn-delete{
    padding:8px 16px;
    border:none;
    background:#dc2626;
    color:white;
    border-radius:8px;
    cursor:pointer;
}

.btn-add{
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

</style>
</head>
<body>
    
<!-- ================= SIDEBAR ================= -->

<?php include_once ("sidebar.php"); ?>



<!-- ================= CONTENT ================= -->

<div class="container">

<h1 class="title">Activities Dashboard</h1>

<a href="Ajouter_activiter.php">
    <button class="btn-add">
        + Add Activity
    </button>
</a>

<table>

<thead>
<tr>
    <th>ID</th>
    <th>Activity</th>
    <th>Price</th>
    <th>Localisation</th>
    <th>Duration</th>
    <th>Image</th>
    <th>Description</th>
    <th>Actions</th>
</tr>
</thead>

<tbody>

<?php foreach($activities as $row) { ?>

<tr>

<td><?= $row['id_activite']; ?></td>

<td><?= $row['type_activite']; ?></td>

<td><?= $row['prix']; ?> DH</td>

<td><?= $row['Localisation']; ?></td>

<td><?= $row['duree']; ?></td>

<td>
    <img 
    src="../Uploads/<?= $row['image']; ?>" 
    class="activity-img">
</td>

<td><?= $row['description']; ?></td>

<td>

<a href="edit_activite.php?id=<?= $row['id_activite']; ?>">

<button class="btn-edit">
    Edit
</button>

</a>

<a href="supprimer_act.php?id=<?php echo $row['id_activite']; ?>"
       onclick="return confirm('Voulez-vous supprimer cette activité ?');">
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