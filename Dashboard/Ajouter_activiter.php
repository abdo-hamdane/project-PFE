<?php
include_once("connexion.php");

if(isset($_POST['add'])){

    $type_activite = $_POST['type_activite'];
    $prix = $_POST['prix'];
    $Localisation = $_POST['Localisation'];
    $duree = $_POST['duree'];
    $description = $_POST['description'];
    
    

    $image = "";

    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){

        $image = time().'_'.$_FILES['image']['name'];

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "../uploads/".$image
        );
    }

    $sql = "INSERT INTO activity
            (type_activite, prix,Localisation, duree, description, image)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $type_activite,
        $prix,
        $Localisation,
        $duree,
        $description,
        $image,
        
    ]);

    header("Location: Activites_dash.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Activity</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    min-height:100vh;
    background:#f4f6f9;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:30px;
}

.activity-form{
    width:100%;
    max-width:800px;
    background:white;
    padding:35px;
    border-radius:20px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.activity-form h1{
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
}

.form-control{
    width:100%;
    padding:14px;
    border:1px solid #ddd;
    border-radius:10px;
    font-size:15px;
}

.form-control:focus{
    outline:none;
    border-color:#C9A227;
}

textarea.form-control{
    resize:none;
    height:120px;
}

.btn{
    width:100%;
    padding:15px;
    border:none;
    border-radius:10px;
    background:#C9A227;
    color:white;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
}

.btn:hover{
    background:#af8b18;
}

</style>
</head>
<body>
    <?php include_once ("sidebar.php"); ?>

<form method="POST" enctype="multipart/form-data" class="activity-form">

    <h1>Add Activity</h1>

    <div class="form-group">
        <label>Activity Type</label>
        <input type="text"
               name="type_activite"
               class="form-control"
               placeholder="Quad / Buggy / Camel / Dinner Show"
               required>
    </div>

    <div class="form-group">
        <label>Price (€)</label>
        <input type="number"
               step="0.01"
               name="prix"
               class="form-control"
               required>
    </div>

    <div class="form-group">
        <label>Duration</label>
        <input type="text"
               name="duree"
               class="form-control"
               placeholder="2 Hours"
               required>
    </div>
    
    <div class="form-group">
        <label>Localisation</label>
        <input type="text"
               name="Localisation"
               class="form-control"
               placeholder="Localisation"
               required>
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea name="description"
                  class="form-control"
                  required></textarea>
    </div>

    <div class="form-group">
        <label>Activity Image</label>
        <input type="file"
               name="image"
               class="form-control"
               accept="image/*"
               required>
    </div>


    <button type="submit" name="add" class="btn">
        Add Activity
    </button>

</form>

</body>
</html>