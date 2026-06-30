<?php
include_once("Dashboard/connexion.php");

if(!isset($_GET['id'])){
    die("Activité introuvable");
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM activity WHERE id_activite=?");
$stmt->execute([$id]);
$activity = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$activity){
    die("Activité introuvable");
}

$stmtTransport = $pdo->prepare("
    SELECT * FROM transport
    WHERE disponibilite = 1
");
$stmtTransport->execute();
$transports = $stmtTransport->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Réservation</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:#f5f5f5;
    padding:40px;
}

.reservation-container{
    max-width:1400px;
    margin:auto;
    display:grid;
    grid-template-columns:2fr 1fr;
    gap:30px;
}

.reservation-form,
.activity-details{
    background:#fff;
    border-radius:20px;
    padding:35px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.reservation-title{
    font-size:40px;
    margin-bottom:10px;
    color:#111827;
}

.reservation-subtitle{
    color:#6b7280;
    margin-bottom:35px;
}

.form-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
}

.form-group{
    margin-bottom:20px;
}

.form-group-full{
    grid-column:1/3;
}

label{
    display:block;
    margin-bottom:8px;
    font-weight:600;
}

input,
select,
textarea{
    width:100%;
    padding:15px;
    border:1px solid #ddd;
    border-radius:10px;
    font-size:15px;
}

textarea{
    resize:none;
    height:120px;
}

.btn-reserver{
    width:100%;
    padding:16px;
    border:none;
    background:#C9A227;
    color:white;
    font-size:18px;
    font-weight:bold;
    border-radius:10px;
    cursor:pointer;
    transition:.3s;
}

.btn-reserver:hover{
    background:#b38f1d;
}

.activity-image{
    width:100%;
    height:260px;
    object-fit:cover;
    border-radius:15px;
    margin-bottom:20px;
}

.activity-type{
    font-size:32px;
    margin-bottom:10px;
}

.activity-location{
    color:#555;
    margin-bottom:20px;
}

.activity-description{
    line-height:1.8;
    color:#444;
    margin-bottom:25px;
}

.info-item{
    display:flex;
    justify-content:space-between;
    padding:12px 0;
    border-bottom:1px solid #eee;
}

.price{
    font-size:30px;
    font-weight:700;
    color:#C9A227;
    margin-top:20px;
}

@media(max-width:1000px){

    .reservation-container{
        grid-template-columns:1fr;
    }

    .form-grid{
        grid-template-columns:1fr;
    }

    .form-group-full{
        grid-column:auto;
    }
    .transport-choice{
    display:flex;
    gap:20px;
    margin-top:10px;
}

.transport-radio{
    display:flex;
    justify-content: center;
    align-items:center;
    gap:8px;
    cursor:pointer;
    background:#f8f8f8;
    padding:12px 18px;
    border-radius:10px;
    border:1px solid #ddd;
}

.transport-radio input{
    width:auto;
}

.price{
    font-size:32px;
    font-weight:700;
    color:#C9A227;
    margin-top:25px;
}
}

</style>
</head>
<body>

<div class="reservation-container">

    <!-- FORMULAIRE -->

    <div class="reservation-form">

        <h1 class="reservation-title">
            Réservation de votre activité
        </h1>

        <p class="reservation-subtitle">
            Remplissez le formulaire pour réserver votre expérience.
        </p>

        <form action="Back/trait_res.php" method="POST">

            <input type="hidden"
                   name="id_activite"
                   value="<?= $activity['id_activite']; ?>">

            <div class="form-grid">

                <div class="form-group">
                    <label>Nom complet</label>
                    <input type="text" name="nom" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>

                <div class="form-group">
                    <label>Téléphone</label>
                    <input type="text" name="telephone" required>
                </div>

                <div class="form-group">
                    <label>Nombre de personnes</label>
                    <input type="number"
                           name="nb_personnes"
                           id="nb_personne"
                           required>
                </div>

                <div class="form-group">
                    <label>Date activité</label>
                    <input type="date"
                           name="date_activite"
                           required>
                </div>
                <div class="form-group">
                    <label>PickUp </label>
                    <input type="text"
                           name="pickup"
                           placeholder="juste sur Marrakech"
                           required>
                </div>

                <div class="form-group">

    <label>Transport</label>

    <div class="transport-choice">
        <div class="transport-radio">
            <label>Sans transport <input type="radio" name="transport_option" value="0" checked> </label>
            
                
        </div>
        <div class="transport-radio">
            <label class="transport-radio">Avec transport (+60 EUR) <input type="radio" name="transport_option" value="1"></label>
            
                   
        </div>
    </div>

</div>


                <div class="form-group form-group-full">
                    <button type="submit"
                            class="btn-reserver">
                            Réserver maintenant
                    </button>
                </div>

            </div>

        </form>

    </div>

    <!-- DETAILS ACTIVITE -->

    <div class="activity-details">

        <img
        src="Uploads/<?= $activity['image']; ?>"
        class="activity-image">

        <h2 class="activity-type">
            <?= $activity['type_activite']; ?>
        </h2>

        <p class="activity-location">
            📍 <?= $activity['Localisation']; ?>
        </p>

        <p class="activity-description">
            <?= $activity['description']; ?>
        </p>

        <div class="info-item">
            <span>Durée</span>
            <strong><?= $activity['duree']; ?></strong>
        </div>

        <div class="info-item">
            <span>Localisation</span>
            <strong><?= $activity['Localisation']; ?></strong>
        </div>

        <div class="info-item">
            <span>Type activité</span>
            <strong><?= $activity['type_activite']; ?></strong>
        </div>

        <div class="price">
    Total :
    <span id="prixTotal">
        <?= number_format($activity['prix'],2); ?>
    </span>
    EUR
</div>

    </div>

</div>


<script>

        const prixBase = <?= $activity['prix']; ?>;

        const prixTotal = document.getElementById("prixTotal");
        const nbPersonne = document.getElementById("nb_personne");

        function calculerPrix() {

            let nb = parseInt(nbPersonne.value) || 1;

            let total = prixBase * nb;

            let transport = document.querySelector('input[name="transport_option"]:checked').value;

            if (transport == "1") {
                if (nb <= 6) {
                    total += 60;
                } else {
                    total += 100;
                }
            }

            prixTotal.innerHTML = total.toFixed(2);
        }

        nbPersonne.addEventListener("input", calculerPrix);

        document
        .querySelectorAll('input[name="transport_option"]')
        .forEach(radio => {
            radio.addEventListener("change", calculerPrix);
        });

        calculerPrix();

</script>
</body>
</html>