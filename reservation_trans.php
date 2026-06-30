<?php

include_once("Dashboard/connexion.php");

if(!isset($_GET['id'])){
    die("Transport introuvable");
}

$id = $_GET['id'];

$stmt = $pdo->prepare("
SELECT *
FROM transport
WHERE Id_transport = ?
");

$stmt->execute([$id]);

$transport = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$transport){
    die("Transport introuvable");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    min-height:100vh;
    background:linear-gradient(135deg,#f8f1e5,#f3dfb0,#e8c27a);
    padding:40px 20px;
}

.abtrip-transport-reservation{
    max-width:1400px;
    margin:auto;
    display:grid;
    grid-template-columns:2fr 1fr;
    gap:30px;
}

.abtrip-form-box,
.abtrip-transport-box{
    background:white;
    border-radius:25px;
    padding:35px;
    box-shadow:0 15px 40px rgba(0,0,0,.08);
    animation:fadeUp .8s ease;
}

@keyframes fadeUp{
    from{
        opacity:0;
        transform:translateY(40px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

.abtrip-title{
    font-size:38px;
    color:#7c2d12;
    margin-bottom:10px;
}

.abtrip-subtitle{
    color:#6b7280;
    margin-bottom:30px;
}

.abtrip-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
}

.abtrip-group{
    display:flex;
    flex-direction:column;
}

.abtrip-group-full{
    grid-column:1/3;
}

.abtrip-group label{
    margin-bottom:8px;
    font-weight:600;
}

.abtrip-group input{
    padding:15px;
    border:1px solid #ddd;
    border-radius:12px;
    transition:.3s;
}

.abtrip-group input:focus{
    border-color:#d97706;
    outline:none;
}

.abtrip-btn{
    border:none;
    padding:16px;
    width:100%;
    border-radius:14px;
    cursor:pointer;
    color:white;
    font-size:17px;
    font-weight:600;
    background:linear-gradient(135deg,#b45309,#f59e0b);
    transition:.3s;
}

.abtrip-btn:hover{
    transform:translateY(-3px);
}

.abtrip-image{
    width:100%;
    height:260px;
    object-fit:cover;
    border-radius:18px;
    margin-bottom:20px;
}

.abtrip-image:hover{
    transform:scale(1.03);
    transition:.4s;
}

.abtrip-transport-name{
    font-size:28px;
    color:#7c2d12;
    margin-bottom:15px;
}

.abtrip-info{
    display:flex;
    justify-content:space-between;
    padding:12px 0;
    border-bottom:1px solid #eee;
}

.abtrip-price{
    margin-top:25px;
    text-align:center;
    font-size:32px;
    font-weight:700;
    color:#d97706;
}

.abtrip-status{
    color:#16a34a;
    font-weight:600;
}

@media(max-width:992px){

    .abtrip-transport-reservation{
        grid-template-columns:1fr;
    }

    .abtrip-grid{
        grid-template-columns:1fr;
    }

    .abtrip-group-full{
        grid-column:auto;
    }

    .abtrip-title{
        font-size:28px;
    }

}
</style>
</head>
<body>
    <div class="abtrip-transport-reservation">

    <div class="abtrip-form-box">

        <h1 class="abtrip-title">
            Réservation Transport
        </h1>

        <p class="abtrip-subtitle">
            Réservez votre trajet rapidement.
        </p>

        <form action="back/trait_res_trans.php" method="POST">

            <input type="hidden"
                   name="Id_transport"
                   value="<?= $transport['Id_transport']; ?>">

            <div class="abtrip-grid">

                <div class="abtrip-group">
                    <label>Nom complet</label>
                    <input type="text" name="nom" required>
                </div>

                <div class="abtrip-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>

                <div class="abtrip-group">
                    <label>Téléphone</label>
                    <input type="text" name="telephone" required>
                </div>

                <div class="abtrip-group">
                    <label>Nombre de personnes</label>
                    <input type="number"
                           id="nb_personnes"
                           name="nb_personnes"
                           min="1"
                           value="1"
                           required>
                </div>

                <div class="abtrip-group">
                    <label>Date Transport</label>
                    <input type="date"
                           name="date_transport"
                           required>
                </div>

                <div class="abtrip-group">
                    <label>Pickup</label>
                    <input type="text"
                           name="pickup"
                           required>
                </div>

                <div class="abtrip-group-full">
                    <button class="abtrip-btn">
                        Réserver Maintenant
                    </button>
                </div>

            </div>

        </form>

    </div>

    <div class="abtrip-transport-box">

        <img
        src="Uploads/<?= $transport['Image_Voiture']; ?>"
        class="abtrip-image">

        <h2 class="abtrip-transport-name">
            <?= $transport['type_transport']; ?>
        </h2>

        <div class="abtrip-info">
            <span>Pickup</span>
            <strong><?= $transport['pickup']; ?></strong>
        </div>

        <div class="abtrip-info">
            <span>Destination</span>
            <strong><?= $transport['Destination']; ?></strong>
        </div>

        <div class="abtrip-info">
            <span>Capacité</span>
            <strong><?= $transport['capacite']; ?> Personnes</strong>
        </div>

        <div class="abtrip-info">
            <span>Disponibilité</span>
            <strong class="abtrip-status">
                Disponible
            </strong>
        </div>

        <div class="abtrip-price">
            <span id="prixTotal">
                <?= number_format($transport['prix_transport'],2); ?>
            </span>
            EUR
        </div>

    </div>
    
</div>
</body>
</html>