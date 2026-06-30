<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Side Bar</title>
    <link rel="stylesheet" href="../assets/css/sidebar.css">
</head>
<body>
    <button class="menu-toggle" id="menuToggle">
☰
</button>
<! ======================================
    aside bar pour la navigation 
    =====================================!>


<?php

$current_page = basename($_SERVER['PHP_SELF']);

?>

<div class="sidebar">

    <div class="logoside">
        <img src="../assets/img/logo7.png" alt="">
        <h2>ABTrip</h2>
    </div>

    <ul class="menu-side">

        <li class="<?= ($current_page == 'index.php') ? 'active' : ''; ?>">
            <a href="index.php">Dashboard</a>
        </li>

        <li class="<?= ($current_page == 'res_trans.php') ? 'active' : ''; ?>">
            <a href="res_trans.php">Reservation Transport</a>
        </li>

        <li class="<?= ($current_page == 'activites_dash.php') ? 'active' : ''; ?>">
            <a href="activites_dash.php">Activities</a>
        </li>

        <li class="<?= ($current_page == 'clients_dash.php') ? 'active' : ''; ?>">
            <a href="clients_dash.php">Clients</a>
        </li>

        <li class="<?= ($current_page == 'transport_dash.php') ? 'active' : ''; ?>">
            <a href="transport_dash.php">Transport</a>
        </li>

        <li class="<?= ($current_page == 'logout.php') ? 'logout' : ''; ?>">
            <a href="logout.php">Logout</a>
        </li>
    </ul>

</div>

<script>

const menuToggle = document.getElementById("menuToggle");
const sidebar = document.querySelector(".sidebar");

menuToggle.addEventListener("click", ()=>{

    sidebar.classList.toggle("active");

});

</script>
</body>
</html>