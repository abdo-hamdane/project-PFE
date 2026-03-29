<?php ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/header.css">
</head>
<body>
    <header>
        
        <div class="logo">
            <img src="assets/img/ABTrip.svg" alt="logo">
        </div>
        <div class="navigation" id="navigation">
            <a href="home.php">Home</a>
            <a href="#activite">Activite</a>
            <a href="#cantact">Cantact</a>
            <button type="button">BOOK NEW</button>
        </div>
        <div class="menu-toggle" id="menuToggle">
            ☰
        </div>
    </header>
    <script>
        const toggle = document.getElementById("menuToggle");
        const nav = document.getElementById("navigation");

        toggle.addEventListener("click", () => {
            nav.classList.toggle("active");
        });
    </script>
</body>
</html>
