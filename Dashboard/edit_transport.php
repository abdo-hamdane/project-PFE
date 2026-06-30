<?php
include_once("connexion.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM transport WHERE Id_transport=?");
    $stmt->execute([$id]);
    $transport = $stmt->fetch(PDO::FETCH_ASSOC);
}

if(isset($_POST['update'])){

    $id = $_POST['Id_transport'];
    $type_transport = $_POST['type_transport'];
    $capacite = $_POST['capacite'];
    $prix_transport = $_POST['prix_transport'];
    $pickup = $_POST['pickup'];
    $Destination = $_POST['Destination'];
    $disponibilite = $_POST['disponibilite'];

    $image = $_POST['ancienne_image'];

    if(isset($_FILES['image']) && $_FILES['image']['error']==0){

        if(!empty($image) && file_exists("../Uploads/".$image)){
            unlink("../Uploads/".$image);
        }

        $image = time()."_".$_FILES['image']['name'];

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "../Uploads/".$image
        );
    }

    $sql = "UPDATE transport SET
            type_transport=?,
            capacite=?,
            prix_transport=?,
            pickup=?,
            Destination=?,
            disponibilite=?,
            Image_Voiture=?
            WHERE id_transport=?";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $type_transport,
        $capacite,
        $prix_transport,
        $pickup,
        $Destination,
        $disponibilite,
        $image,
        $id
    ]);

    header("Location: transport_dash.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Modifier Transport</title>

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

.transport-form{
    width:100%;
    max-width:700px;
    background:#fff;
    padding:35px;
    border-radius:20px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.transport-form h1{
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

.preview{
    width:220px;
    height:150px;
    object-fit:cover;
    border-radius:10px;
    margin-top:10px;
}
</style>

</head>
<body>

<?php include_once("sidebar.php"); ?>

<form method="POST" enctype="multipart/form-data" class="transport-form">

<h1>Modifier Transport</h1>

<input type="hidden"
       name="id_transport"
       value="<?= $transport['Id_transport']; ?>">

<input type="hidden"
       name="ancienne_image"
       value="<?= $transport['Image_Voiture']; ?>">

<div class="form-group">
<label>Type Transport</label>

<select name="type_transport" class="form-control">

<option value="Minibus" <?=($transport['type_transport']=="Minibus")?"selected":"";?>>Minibus</option>

<option value="Van" <?=($transport['type_transport']=="Van")?"selected":"";?>>Van</option>

<option value="Bus" <?=($transport['type_transport']=="Bus")?"selected":"";?>>Bus</option>

<option value="4x4" <?=($transport['type_transport']=="4x4")?"selected":"";?>>4x4</option>

<option value="Taxi" <?=($transport['type_transport']=="Taxi")?"selected":"";?>>Taxi</option>

<option value="Luxury Car" <?=($transport['type_transport']=="Luxury Car")?"selected":"";?>>Luxury Car</option>

</select>
</div>

<div class="form-group">
<label>Capacité</label>
<input type="number"
       name="capacite"
       class="form-control"
       value="<?= $transport['capacite']; ?>">
</div>

<div class="form-group">
<label>Prix Transport</label>
<input type="number"
       name="prix_transport"
       class="form-control"
       value="<?= $transport['prix_transport']; ?>">
</div>

<div class="form-group">
<label>Pickup</label>
<input type="text"
       name="pickup"
       class="form-control"
       value="<?= $transport['pickup']; ?>">
</div>

<div class="form-group">
<label>Destination</label>
<input type="text"
       name="Destination"
       class="form-control"
       value="<?= $transport['Destination']; ?>">
</div>

<div class="form-group">
<label>Disponibilité</label>

<select name="disponibilite" class="form-control">
<option value="1" <?=($transport['disponibilite']==1)?"selected":"";?>>Disponible</option>
<option value="0" <?=($transport['disponibilite']==0)?"selected":"";?>>Indisponible</option>
</select>

</div>

<div class="form-group">
<label>Image actuelle</label><br>

<img src="../Uploads/<?= $transport['Image_Voiture']; ?>"
     class="preview">

</div>

<div class="form-group">
<label>Nouvelle Image</label>
<input type="file"
       name="image"
       class="form-control">
</div>

<button type="submit"
        name="update"
        class="btn">
    Modifier Transport
</button>

</form>

</body>
</html>