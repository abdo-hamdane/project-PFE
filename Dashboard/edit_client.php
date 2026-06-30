<?php

include_once("connexion.php");

if(isset($_GET['id'])){

    $stmt = $pdo->prepare("SELECT * FROM Client WHERE id_client=?");
    $stmt->execute([$_GET['id']]);

    $client = $stmt->fetch(PDO::FETCH_ASSOC);
}

if(isset($_POST['update'])){

    $stmt = $pdo->prepare("UPDATE Client
                           SET nom=?,
                               email=?,
                               telephone=?
                           WHERE id_client=?");

    $stmt->execute([
        $_POST['nom'],
        $_POST['email'],
        $_POST['telephone'],
        $_POST['id_client']
    ]);

    header("Location: Clients_dash.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Clients</title>

    <style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:#f4f6f9;
    padding:20px;
}

.client-form{
    width:100%;
    max-width:700px;
    background:#fff;
    padding:35px;
    border-radius:20px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.client-form h1{
    text-align:center;
    margin-bottom:30px;
    color:#111827;
}

.form-group{
    margin-bottom:18px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    font-weight:600;
    color:#374151;
}

.form-control{
    width:100%;
    padding:14px;
    border:1px solid #d1d5db;
    border-radius:10px;
    font-size:15px;
}

.form-control:focus{
    outline:none;
    border-color:#C9A227;
}

.btn{
    width:100%;
    padding:15px;
    border:none;
    border-radius:10px;
    background:#C9A227;
    color:#fff;
    font-size:16px;
    font-weight:700;
    cursor:pointer;
}

.btn:hover{
    background:#b38f1d;
}

</style>
</head>
<body>
    <?php include_once("sidebar.php"); ?>

    
    <form method="POST" class="client-form">

<h1>Modifier Client</h1>

<input type="hidden"
       name="id_client"
       value="<?= $client['id_client']; ?>">

<div class="form-group">
<label>Nom</label>
<input type="text"
       name="nom"
       class="form-control"
       value="<?= $client['nom']; ?>"
       required>
</div>

<div class="form-group">
<label>Email</label>
<input type="email"
       name="email"
       class="form-control"
       value="<?= $client['email']; ?>"
       required>
</div>

<div class="form-group">
<label>Téléphone</label>
<input type="text"
       name="telephone"
       class="form-control"
       value="<?= $client['telephone']; ?>"
       required>
</div>

<button type="submit"
        name="update"
        class="btn">
    Modifier Client
</button>

</form>
</body>
</html>