<?php
include_once ("Dashboard/connexion.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>ABTrip Header</title>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Montserrat',sans-serif;
}

body{
    min-height:200vh;
    background:url("assets/img/bg.jpg") center/cover no-repeat;
}

/* HEADER */

.he_ader{
    position:fixed;
    top:0;
    left:0;
    width:100%;

    display:flex;
    justify-content:space-between;
    align-items:center;

    padding:0 50px;
    height:80px;

    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(12px);
    -webkit-backdrop-filter:blur(12px);

    border-bottom:1px solid rgba(255,255,255,.15);

    z-index:1000;
}

/* LOGO */

.logo img{
    height:100px;
    width:auto;
    object-fit:contain;
}

/* NAVIGATION */

.navigation_home{
    display:flex;
    align-items:center;
    gap:30px;
}

.navigation_home a{
    text-decoration:none;
    color:#6B495A;
    font-weight:700;
    position:relative;
    transition:.3s;
}

.navigation_home a::after{
    content:'';
    position:absolute;
    left:0;
    bottom:-6px;
    width:0;
    height:2px;
    background:#7d0600;
    transition:.3s;
}

.navigation_home a:hover::after{
    width:100%;
}

.navigation_home a:hover{
    color:#7d0600;
}

/* CART */

.cart-link{
    position:relative;
    font-size:24px;
}

.cart-count{
    position:absolute;
    top:-8px;
    right:-12px;

    width:20px;
    height:20px;

    border-radius:50%;

    background:#e63946;
    color:white;

    display:flex;
    justify-content:center;
    align-items:center;

    font-size:11px;
    font-weight:bold;
}

/* BUTTON */

#btn_Book{
    border:none;
    outline:none;

    padding:12px 28px;

    border-radius:50px;

    cursor:pointer;

    background-color: #7d0600;
    color:black;
    

    font-weight:700;

    transition:.3s;
}
#btn_book a{
   color:white; 
   text-decoration: none !important;
    
}

#btn_Book:hover{
    background-color: #c30700;
    transform:translateY(-2px);
    box-shadow:0 8px 20px rgba(125,6,0,.4);
    color: white;
}

/* MOBILE MENU */

.menu-toggle{
    display:none;
    font-size:30px;
    cursor:pointer;
    color:#6B495A;
}

/* RESPONSIVE */

@media(max-width:900px){

    .menu-toggle{
        display:block;
    }

    .navigation_home{
        position:absolute;
        top:80px;
        right:20px;

        width:250px;

        flex-direction:column;
        align-items:center;
        gap:20px;

        background:white;

        padding:25px;

        border-radius:15px;

        box-shadow:0 10px 30px rgba(0,0,0,.15);

        display:none;
    }

    .navigation_home.active{
        display:flex;
    }

    .he_ader{
        padding:0 20px;
    }
    .logo img{
        height: 80px;
        width: auto;
        object-fit: contain;
    }
}

</style>
</head>
<body>

<header class="he_ader">

    <div class="logo">
        <img src="assets/img/logo7.png" alt="Logo">
    </div>

    <nav class="navigation_home" id="navigation_home">

        <a href="home.php">Accueil</a>

        <a href="Activite.php">Activities</a>

        <a href="transport.php">Transport</a>

        <a href="contact.php">Contact</a>

        <a href="back/verification_email.php" class="cart-link">
        🛒
        </a>

        <button id="btn_Book">
            <a href="Activite.php" style="color: white;">RESERVER</a>
        </button>

    </nav>

    <div class="menu-toggle" id="menuToggle">
        ☰
    </div>

</header>

<script>

const menuToggle = document.getElementById("menuToggle");
const navigation = document.getElementById("navigation_home");

menuToggle.addEventListener("click", () => {
    navigation.classList.toggle("active");
});

</script>

</body>
</html>