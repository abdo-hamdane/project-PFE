```php
<?php
include_once("Dashboard/connexion.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ABTrip Transport</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

.abtrip-transport-page{
    background:#f8f8f8;
    overflow-x:hidden;
}

/* HERO */

.abtrip-transport-hero{
    height:80vh;
    position:relative;
    display:flex;
    justify-content:center;
    align-items:center;
    text-align:center;
    overflow:hidden;
}

.abtrip-transport-hero::before{
    content:'';
    position:absolute;
    inset:0;
    background:url('assets/images/transport-banner.jpg') center center/cover;
    animation:abtripHeroZoom 15s infinite alternate;
}

.abtrip-transport-hero::after{
    content:'';
    position:absolute;
    inset:0;
    background:rgba(0,0,0,.55);
}

@keyframes abtripHeroZoom{
    from{
        transform:scale(1);
    }
    to{
        transform:scale(1.1);
    }
}

.abtrip-transport-hero-content{
    position:relative;
    z-index:2;
    color:white;
    max-width:850px;
    padding:20px;
    animation:abtripFadeUp 1.2s ease;
}

@keyframes abtripFadeUp{
    from{
        opacity:0;
        transform:translateY(50px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

.abtrip-transport-title{
    font-size:72px;
    font-weight:700;
    margin-bottom:15px;
}

.abtrip-transport-title span{
    color:#f59e0b;
}

.abtrip-transport-text{
    font-size:18px;
    line-height:1.8;
    margin-bottom:25px;
}

.abtrip-transport-btn{
    display:inline-block;
    text-decoration:none;
    color:white;
    padding:14px 30px;
    border-radius:50px;
    background:linear-gradient(135deg,#f59e0b,#b45309);
    transition:.4s;
}

.abtrip-transport-btn:hover{
    transform:translateY(-4px);
    box-shadow:0 15px 35px rgba(245,158,11,.4);
}

/* FILTER */

.abtrip-transport-filters{
    display:flex;
    justify-content:center;
    flex-wrap:wrap;
    gap:15px;
    margin:50px 20px;
}

.abtrip-transport-filters button{
    border:none;
    cursor:pointer;
    padding:12px 25px;
    border-radius:50px;
    color:white;
    background:#b45309;
    transition:.3s;
}

.abtrip-transport-filters button:hover{
    background:#f59e0b;
    transform:translateY(-3px);
}

/* SECTION */

.abtrip-transport-section{
    width:100%;
    max-width:1400px;
    margin:auto;
    padding-bottom:70px;
}

.abtrip-transport-header{
    text-align:center;
    margin-bottom:50px;
}

.abtrip-transport-header h2{
    font-size:42px;
    color:#7c2d12;
}

.abtrip-transport-header p{
    color:#666;
    margin-top:10px;
}

.abtrip-transport-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:25px;
   
}

/* CARD */

.abtrip-transport-card{
    display: flex;
    flex-direction: column;
    background:white;
    border-radius:22px;
    height: 560px;
    width:360px;
    max-width:500px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
    transition:.4s;
    opacity:0;
    animation:abtripCardShow .8s ease forwards;
}

@keyframes abtripCardShow{
    from{
        opacity:0;
        transform:translateY(40px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

.abtrip-transport-card:hover{
    transform:translateY(-10px);
    box-shadow:0 20px 45px rgba(0,0,0,.15);
}

.abtrip-transport-image-box{
    position:relative;
    overflow:hidden;
}

.abtrip-transport-image{
    width:100%;
    height:260px;
    object-fit:cover;
    transition:.6s;
}

.abtrip-transport-card:hover .abtrip-transport-image{
    transform:scale(1.1);
}

.abtrip-transport-price{
    position:absolute;
    top:15px;
    right:15px;
    background:#f59e0b;
    color:white;
    padding:10px 18px;
    border-radius:30px;
    font-weight:600;
}

.abtrip-transport-content{
    padding:25px;
    display:flex;
    flex-direction:column;
    flex:1;
    margin-bottom: 15px;
}

.abtrip-transport-name{
    color:#7c2d12;
    margin-bottom:15px;
}

.abtrip-transport-content p{
    margin-bottom:12px;
    color:#444;
}

.abtrip-transport-available{
    color:#16a34a;
    font-weight:600;
}

.abtrip-transport-unavailable{
    color:#dc2626;
    font-weight:600;
}

.abtrip-transport-book{
    display:inline-block;
    margin-top:20px;
    text-decoration:none;
    color:white;
    padding:12px 40px;
    border-radius:12px;
    background:linear-gradient(135deg,#f59e0b,#b45309);
    transition:.4s;
    text-align: center;
}

.abtrip-transport-book:hover{
    transform:translateY(-3px);
    box-shadow:0 10px 25px rgba(245,158,11,.4);
}

/* RESPONSIVE */

@media(max-width:768px){

    .abtrip-transport-title{
        font-size:42px;
    }

    .abtrip-transport-text{
        font-size:15px;
    }

    .abtrip-transport-hero{
        height:65vh;
    }

    .abtrip-transport-header h2{
        font-size:30px;
    }
    .abtrip-transport-grid{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
}

</style>
</head>

<body class="abtrip-transport-page">

<?php include_once("fronts/header.php"); ?>

<header class="abtrip-transport-hero">

    <div class="abtrip-transport-hero-content">

        <h1 class="abtrip-transport-title">
            Luxury <span>Transport</span>
        </h1>

        <p class="abtrip-transport-text">
            Travel comfortably from Marrakech to Agafay Desert with our premium transport services.
        </p>

        <a href="#abtrip-transport-scroll" class="abtrip-transport-btn">
            Explore Transport
        </a>

    </div>

</header>

<div class="abtrip-transport-filters">

    <button onclick="abtripFilterCards('all')">Tous</button>
    <button onclick="abtripFilterCards('Van')">Van</button>
    <button onclick="abtripFilterCards('Minibus')">Minibus</button>
    <button onclick="abtripFilterCards('4x4')">4x4</button>

</div>

<?php

$stmt = $pdo->prepare("SELECT * FROM transport");
$stmt->execute();
$transports = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<section class="abtrip-transport-section" id="abtrip-transport-scroll">

    <div class="abtrip-transport-header">
        <h2>Nos Transports</h2>
        <p>Découvrez nos véhicules disponibles</p>
    </div>

    <div class="abtrip-transport-grid">

        <?php foreach($transports as $transport){ ?>
 

        <div class="abtrip-transport-card abtrip-card-item"
             data-category="<?= htmlspecialchars($transport['type_transport']); ?>">

            <div class="abtrip-transport-image-box">

                <img src="Uploads/<?= htmlspecialchars($transport['Image_Voiture']); ?>"
                     class="abtrip-transport-image">

                <span class="abtrip-transport-price">
                    <?= $transport['prix_transport']; ?> €
                </span>

            </div>

            <div class="abtrip-transport-content">

                <h3 class="abtrip-transport-name">
                    <?= htmlspecialchars($transport['type_transport']); ?>
                </h3>

                <p>
                    📍 <strong>Pickup :</strong>
                    <?= htmlspecialchars($transport['pickup']); ?>
                </p>

                <p>
                    🎯 <strong>Destination :</strong>
                    <?= htmlspecialchars($transport['Destination']); ?>
                </p>

                <p>
                    👥 <strong>Capacité :</strong>
                    <?= htmlspecialchars($transport['capacite']); ?> personnes
                </p>

                <?php if($transport['disponibilite']){ ?>

                    <p class="abtrip-transport-available">
                        ✔ Disponible
                    </p>

                <?php } else { ?>

                    <p class="abtrip-transport-unavailable">
                        ✖ Indisponible
                    </p>

                <?php } ?>

                <a href="reservation_trans.php?id=<?= $transport['Id_transport']; ?>"
                   class="abtrip-transport-book">
                    Réserver
                </a>

            </div>

        </div>

        <?php } ?>

    </div>

</section>

<?php include_once("fronts/footer.php"); ?>

<script>

function abtripFilterCards(category){

    let cards = document.querySelectorAll('.abtrip-card-item');

    cards.forEach(card => {

        if(category === 'all' || card.dataset.category === category){

            card.style.display = "block";

        }else{

            card.style.display = "none";

        }

    });

}

</script>

</body>
</html>
```
