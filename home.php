<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php include 'fronts/header.php'; ?>
    <section class="hero">
        <h1>Explorez les merveilles  <br> DE <span id="kech">Marrakeche</span> </h1>
        <p> Vivez des expériences uniques et des aventures inoubliables au <br> cœur du désert avec ABTrip</p>
        <p>Excursions • Aventures • Dîners-spectacles</p>
        <button class="bt">Réserver</button>
    </section>
    <section class="presentation" >
        <div class="content">
            <h2>Explore <span style="color: #C9A227;">Marrakech</span><br>With <span style="color: #0b0051;">ABTrip</span></h2>
            <p>We create unforgettable desert experiences around Marrakech — from thrilling quad bike rides
        to authentic cultural adventures.</p>
            <li><i class="fa-solid fa-square-check fa-2xl" style="color: rgb(217, 87, 2);"></i> Local expert guides</li>
            <li><i class="fa-solid fa-medal fa-2xl" style="color: rgb(217, 87, 2);"></i> Premium equipment</li>
            <li><i class="fa-solid fa-people-group fa-2xl" style="color: rgb(217, 87, 2);"></i> Groups & Private tours</li>
            <li><i class="fa-solid fa-compass fa-2xl" style="color: rgb(217, 87, 2);"></i> Authentic experiences</li>
        </div>
        <div class="img_content">
            <img src="assets/img/pre_2.jpg" alt="pre_2" class="pre_2" >
            <img src="assets/img/pre_1.jpg" alt="pre_1" class="pre_1">
            <img src="assets/img/pre_3.jpg" alt="pre_3" class="pre_3">
        </div>
    </section>

    <section class="act">
        <h2 >Les activite</h2>
        <div class="activite">
        <div class="card_camel">
            <img src="assets/img/camel.jpg" alt="">
            <div class="card_body">
                <h3>Balade à dos de chameau</h3>
                <p>Vivez une balade à dos de chameau dans le désert et admirez la beauté naturelle des paysages.</p>
            </div>
            <div class="btn_cards">
                <button id="show_more">Show More →</button>
            </div>
            
        </div>
        <div class="card_camel">
            <img src="assets/img/Quad 1.jpg" alt="">
            <div class="card_body">
                <h3>Randonnée en quad</h3>
                <p>Partez à la découverte du désert en quad et profitez d’une expérience riche en sensations fortes .</p>
            </div>
            <div class="btn_cards">
                <button id="show_more">Show More →</button>
            </div>
            
        </div>
        <div class="card_camel">
            <img src="assets/img/buggy.jpg" alt="">
            <div class="card_body">
                <h3>Balade en buggy</h3>
                <p>Profitez d’une balade en buggy et découvrez de magnifiques paysages désertiques en toute sécurité.</p>
            </div>
            <div class="btn_cards">
                <button id="show_more">Show More →</button>
            </div>
            
        </div>
        <div class="card_camel">
            <img src="assets/img/dinner.jpg" alt="">
            <div class="card_body">
                <h3>Dîner & spectacle</h3>
                <p>Profitez d’une soirée inoubliable où la gastronomie raffinée rencontre des spectacles captivants, dans une ambiance élégante et chaleureuse.</p>
            </div>
            <div class="btn_cards">
                <button id="show_more">Show More →</button>
            </div>
            
        </div>
    </div>
    </section>
    <section class="pic">
        <h2 style="text-decoration: underline;">About Us</h2>
        <div class="carousel">

            <div class="slides">
                <img src="assets/img/img1.jpg" >
                <img src="assets/img/img2.jpg" >
                <img src="assets/img/img3.jpg" >
                <img src="assets/img/img4.jpg" >
                <img src="assets/img/img5.jpg" >
                <img src="assets/img/img6.jpg" >
                <img src="assets/img/img7.jpg" >
                <img src="assets/img/img8.jpg" >
                <img src="assets/img/img9.jpg" >
                <img src="assets/img/img10.jpg" >
            </div>

            

        </div>
    </section>
    
    <?php include_once 'fronts/footer.php'; ?>
</body>
</html>
