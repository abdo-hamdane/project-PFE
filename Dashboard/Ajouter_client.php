<?php

include_once("connexion.php");

if(isset($_POST['add'])){

    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];

    $stmt = $pdo->prepare("INSERT INTO Client
                           (nom, email, telephone)
                           VALUES (?, ?, ?, ?)");

    $stmt->execute([
        $nom,
        $email,
        $telephone
    ]);

    header("Location: Clients_dash.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ajouter Client</title>

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

.add-client-form{
    width:100%;
    max-width:700px;
    background:#fff;
    padding:35px;
    border-radius:20px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.add-client-title{
    text-align:center;
    margin-bottom:30px;
    color:#111827;
}

.add-client-group{
    margin-bottom:18px;
}

.add-client-group label{
    display:block;
    margin-bottom:8px;
    font-weight:600;
    color:#374151;
}

.add-client-input{
    width:100%;
    padding:14px;
    border:1px solid #d1d5db;
    border-radius:10px;
    font-size:15px;
}

.add-client-input:focus{
    outline:none;
    border-color:#C9A227;
}

.add-client-btn{
    width:100%;
    padding:15px;
    border:none;
    border-radius:10px;
    background:#C9A227;
    color:white;
    font-size:16px;
    font-weight:700;
    cursor:pointer;
}

.add-client-btn:hover{
    background:#b38f1d;
}

</style>

</head>
<body>

<?php include_once("sidebar.php"); ?>

<form method="POST" class="add-client-form">

<h1 class="add-client-title">
    Ajouter Client
</h1>

<div class="add-client-group">
    <label>Nom</label>
    <input type="text"
           name="nom"
           class="add-client-input">
</div>


<div class="add-client-group">
    <label>Email</label>
    <input type="email"
           name="email"
           class="add-client-input">
</div>

<div class="add-client-group">
    <label>Téléphone</label>
    <input type="text"
           name="telephone"
           class="add-client-input">
</div>

<button type="submit"
        name="add"
        class="add-client-btn">
    Ajouter Client
</button>

</form>

</body>
</html>