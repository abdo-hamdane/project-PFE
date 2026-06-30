<?php
include_once("connexion.php");

if(isset($_POST['add'])){

    $type_transport = $_POST['type_transport'];
    $capacite = $_POST['capacite'];
    $prix_transport = $_POST['prix_transport'];
    $pickup = $_POST['pickup'];
    $Destination = $_POST['Destination'];
    $disponibilite = $_POST['disponibilite'];

    $image = "";

    if(isset($_FILES['Image_Voiture']) && $_FILES['Image_Voiture']['error'] == 0){

        $image = time().'_'.$_FILES['Image_Voiture']['name'];

        move_uploaded_file(
            $_FILES['Image_Voiture']['tmp_name'],
            "../Uploads/".$image
        );
    }

    $sql = "INSERT INTO transport
            (type_transport, capacite, prix_transport,
             disponibilite, pickup, Destination, Image_Voiture)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $type_transport,
        $capacite,
        $prix_transport,
        $disponibilite,
        $pickup,
        $Destination,
        $image
    ]);

    header("Location: transport_dash.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Transport</title>

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
    transition:.3s;
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
    transition:.3s;
}

.btn:hover{
    background:#b38f1d;
}

</style>
</head>
<body>
<?php include_once ("sidebar.php"); ?>

<form method="POST" enctype="multipart/form-data" class="transport-form">

    <h1>Add New Transport</h1>

   <div class="form-group">
    <label>Type Transport</label>

    <select name="type_transport" class="form-control">

        <option value="Minibus">Minibus</option>

        <option value="Van">Van</option>

        <option value="Bus">Bus</option>

        <option value="4x4">4x4</option>

        <option value="Taxi">Taxi</option>

        <option value="Luxury Car">Luxury Car</option>

    </select>
    </div>

    <div class="form-group">
        <label>Capacité</label>
        <input type="number"
               name="capacite"
               class="form-control"
               placeholder="Ex : 15"
               required>
    </div>

    <div class="form-group">
        <label>Prix Transport</label>
        <input type="number"
               step="0.01"
               name="prix_transport"
               class="form-control"
               placeholder="Ex : 250"
               required>
    </div>

    <div class="form-group">
        <label>Pickup</label>
        <input type="text"
               name="pickup"
               class="form-control"
               placeholder="Ex : Marrakech"
               required>
    </div>

    <div class="form-group">
        <label>Destination</label>
        <input type="text"
               name="Destination"
               class="form-control"
               placeholder="Ex : Agafay"
               required>
    </div>

    <div class="form-group">
        <label>Disponibilité</label>
        <select name="disponibilite" class="form-control">
            <option value="1">Disponible</option>
            <option value="0">Indisponible</option>
        </select>
    </div>

    <div class="form-group">
    <label>Image Transport</label>
    <input type="file"
           name="Image_Voiture"
           class="form-control"
           accept="image/*"
           required>
    </div>

    <button type="submit" name="add" class="btn">
        Ajouter Transport
    </button>

</form>

</body>
</html>