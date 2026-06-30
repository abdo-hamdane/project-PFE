<?php
include_once("connexion.php");

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM activity WHERE id_activite=?");
$stmt->execute([$id]);
$activity = $stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['update'])){

    $type_activite = $_POST['type_activite'];
    $prix = $_POST['prix'];
    $duree = $_POST['duree'];
    $description = $_POST['description'];
    $Localisation = $_POST['Localisation'];

    $image = $activity['image'];

    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){

        if(!empty($activity['image']) && file_exists("../uploads/".$activity['image'])){
            unlink("../uploads/".$activity['image']);
        }

        $image = time().'_'.$_FILES['image']['name'];

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "../uploads/".$image
        );
    }

    $sql = "UPDATE activity SET
            type_activite=?,
            prix=?,
            duree=?,
            Localisation=?,
            description=?,
            image=?
            WHERE id_activite=?";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $type_activite,
        $prix,
        $duree,
        $description,
        $image,
        $id,
        $Localisation,
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
<title>Update Activity</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:#f4f6f9;
}

.container{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:40px;
}

.activity-form{
    width:100%;
    max-width:800px;
    background:#fff;
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
    color:#374151;
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
    min-height:120px;
    resize:none;
}

.image-preview{
    text-align:center;
    margin:25px 0;
}

.image-preview img{
    width:280px;
    height:180px;
    object-fit:cover;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,.15);
}

.btn-update{
    width:100%;
    padding:15px;
    border:none;
    border-radius:10px;
    background:#C9A227;
    color:white;
    font-size:16px;
    font-weight:700;
    cursor:pointer;
    transition:.3s;
}

.btn-update:hover{
    background:#b08b18;
}

</style>
</head>

<body>

<?php include_once("sidebar.php"); ?>

<div class="container">

<form method="POST" enctype="multipart/form-data" class="activity-form">

    <h1>Update Activity</h1>

    <div class="form-group">
        <label>Activity Type</label>
        <input type="text"
               name="type_activite"
               class="form-control"
               value="<?php echo $activity['type_activite']; ?>"
               required>
    </div>

    <div class="form-group">
        <label>Price (€)</label>
        <input type="number"
               step="0.01"
               name="prix"
               class="form-control"
               value="<?php echo $activity['prix']; ?>"
               required>
    </div>

    <div class="form-group">
        <label>Duration</label>
        <input type="text"
               name="duree"
               class="form-control"
               value="<?php echo $activity['duree']; ?>"
               required>
    </div>

    <div class="form-group">
        <label>Localisation</label>
        <input type="text"
               name="Localisation"
               class="form-control"
               value="<?php echo $activity['Localisation']; ?>"
               required>
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea name="description"
                  class="form-control"
                  required><?php echo $activity['description']; ?></textarea>
    </div>

    <div class="image-preview">
        <img src="../uploads/<?php echo $activity['image']; ?>" alt="">
    </div>

    <div class="form-group">
        <label>Change Image (Optional)</label>
        <input type="file"
               name="image"
               class="form-control"
               accept="image/*">
    </div>

    <button type="submit" name="update" class="btn-update">
        Update Activity
    </button>

</form>

</div>

</body>
</html>