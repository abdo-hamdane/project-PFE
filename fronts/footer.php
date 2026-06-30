<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

.ab-footer{
    background:#07142d;
    color:white;
    padding-top:60px;
    font-family:'Segoe UI',sans-serif;
}

.ab-footer-container{
    width:90%;
    max-width:1400px;
    margin:auto;

    display:grid;
    grid-template-columns:2fr 1fr 1fr 1fr;
    gap:50px;
}

/* ABOUT */
.ab-footer-about{
    display:flex;
    flex-direction:column;
    align-items:flex-start;
}

.ab-footer-about img{
    width:260px;
    height:auto;
    margin-bottom:25px;
}

.ab-footer-about p{
    color:#cbd5e1;
    max-width:420px;
    line-height:1.9;
}

/* TITLES */

.ab-footer-col h3{
    margin-bottom:25px;
    position:relative;
    font-size:22px;
}

.ab-footer-col h3::after{
    content:"";
    position:absolute;
    left:0;
    bottom:-10px;
    width:50px;
    height:3px;
    background:#d4a017;
}

/* LINKS */

.ab-footer-links a,
.ab-footer-contact a{
    display:block;
    text-decoration:none !important;
    margin-bottom:15px;
    transition:.3s;
    color:#ffffff;
    font-weight: 600;
}

.ab-footer-links a:hover,
.ab-footer-contact a:hover{
    color:#d4a017;
    padding-left:8px;
    font-weight: 600;
}

/* CONTACT */

.ab-footer-contact i{
    width:25px;
    color:#d4a017;
}

/* SOCIAL */

.ab-social{
    display:flex;
    gap:15px;
    margin-top:20px;
}

.ab-social a{
    width:45px;
    height:45px;
    border-radius:50%;
    background:#1f2937;

    display:flex;
    justify-content:center;
    align-items:center;

    color:white;
    text-decoration:none;
    transition:.3s;
}

.ab-social a:hover{
    background:#d4a017;
    transform:translateY(-5px);
}

/* BOTTOM */

.ab-footer-bottom{
    margin-top:50px;
    border-top:1px solid rgba(255,255,255,.1);
    text-align:center;
    padding:25px;
    color:#94a3b8;
}

/* MOBILE */

@media(max-width:992px){

    .ab-footer-container{
        grid-template-columns:1fr 1fr;
    }

}

@media(max-width:768px){

    .ab-footer-container{
        grid-template-columns:1fr;
        text-align:center;
    }

    .ab-footer-col h3::after{
        left:50%;
        transform:translateX(-50%);
    }

    .ab-social{
        justify-content:center;
        align-items: center;
    }
    .ab-footer-about{
        display: flex;
        justify-content: center;
        flex-direction: column;
    }
}

</style>
</head>
<body>

<footer class="ab-footer">

    <div class="ab-footer-container">

        <!-- ABOUT -->
        <div class="ab-footer-about">

            <img src="assets/img/logo7.png" alt="ABTrip">

            <p>
                Découvrez Marrakech autrement avec ABTrip.
                Activités authentiques, excursions uniques,
                transport confortable et expériences inoubliables
                pour tous les voyageurs.
            </p>

            <div class="ab-social">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/abtrip_agence"><i class="fab fa-instagram"></i></a>
                <a href="https://wa.me/212707982282"><i class="fab fa-whatsapp"></i></a>
                <a href="#"><i class="fab fa-tiktok"></i></a>
            </div>

        </div>

        <!-- LINKS -->
        <div class="ab-footer-col">
            <h3>Quick Links</h3>

            <div class="ab-footer-links">
                <a href="home.php">Accueil</a>
                <a href="Activite.php">Activités</a>
                <a href="transport.php">Transport</a>
                <a href="back/verification_email.php">Mes Réservation</a>
                <a href="contact.php">Contact</a>
            </div>
        </div>

        <!-- SERVICES -->
        <div class="ab-footer-col">
            <h3>Services</h3>

            <div class="ab-footer-links">
                <a href="#">Excursions</a>
                <a href="#">Guide Touristique</a>
                <a href="#">Location Véhicules</a>
                <a href="#">Transfert Aéroport</a>
                <a href="#">Voyages Organisés</a>
            </div>
        </div>

        <!-- CONTACT -->
        <div class="ab-footer-col">
            <h3>Contact</h3>

            <div class="ab-footer-contact">

                <a href="#">
                    <i class="fas fa-location-dot"></i>
                    Marrakech, Maroc
                </a>

                <a href="tel:0767591510">
                    <i class="fas fa-phone"></i>
                    0707982282
                </a>

                <a href="mailto:agenceabtrip@gmail.com">
                    <i class="fas fa-envelope"></i>
                    AgenceABTrip@gmail.com
                </a>

            </div>
        </div>

    </div>

    <div class="ab-footer-bottom">
        © <?php echo date('Y'); ?> ABTrip - All Rights Reserved
    </div>

</footer>

</body>
</html>