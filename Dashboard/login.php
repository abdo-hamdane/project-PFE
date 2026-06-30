<?php
$message = "";

if (isset($_GET["message"])) {
    $message = htmlspecialchars($_GET["message"]);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Connexion Admin</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(
        rgba(0,0,0,.90),
        rgba(0,0,0,.90)
    ),
    url('../assets/img/img3.jpg');
    background-size:cover;
    background-position:center;
}

.login-box{
    width:420px;
    background:rgba(255,255,255,.95);
    padding:40px;
    border-radius:20px;
    box-shadow:0 15px 40px rgba(0,0,0,.25);
    animation:fadeIn .8s ease;
}

@keyframes fadeIn{
    from{
        opacity:0;
        transform:translateY(40px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}
.logo7{
    text-align:center;
    margin-bottom:20px;
}
.logo7 img{
    
    width: auto;
    height: 120px;
    object-fit: contain;
}

.logo p{
    color:#666;
    font-size:14px;
}

.login-title{
    text-align:center;
    margin-bottom:25px;
    color:#111827;
}

.login-input{
    width:100%;
    padding:14px;
    margin-bottom:15px;
    border:1px solid #ddd;
    border-radius:12px;
    font-size:15px;
    transition:.3s;
}

.login-input:focus{
    outline:none;
    border-color:#C9A227;
    box-shadow:0 0 10px rgba(201,162,39,.3);
}

.login-btn{
    width:100%;
    padding:15px;
    border:none;
    border-radius:12px;
    background:#C9A227;
    color:white;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
    transition:.3s;
}

.login-btn:hover{
    background:#b8931f;
    transform:translateY(-2px);
}

.error-message{
    color:#dc2626;
    text-align:center;
    margin-bottom:15px;
    font-weight:600;
}

.success-message{
    color:#16a34a;
    text-align:center;
    margin-bottom:15px;
    font-weight:600;
}

.footer{
    text-align:center;
    margin-top:20px;
    color:#666;
    font-size:13px;
}

@media(max-width:768px){
    .login-box{
        width:350px;
    }
}


</style>

</head>
<body>

<div class="login-box">

    <div class="logo7">
        <img src="../assets/img/logo7.png" alt="Logo">
        <p>Transport • Quad • Buggy • Dinner Show</p>
    </div>

    <h2 class="login-title">
        Connexion Admin
    </h2>

    <?php if($message != "") { ?>

        <?php if($message == "Compte créé avec succès"){ ?>

            <div class="success-message">
                <?= $message ?>
            </div>

        <?php } else { ?>

            <div class="error-message">
                <?= $message ?>
            </div>

        <?php } ?>

    <?php } ?>

    <form action="traitement_login.php" method="POST" autocomplete="off">

        <input type="email" name="email" class="login-input" autocomplete="off" required >
        <input type="password" name="mot_de_passe" class="login-input" autocomplete="off" required>

        <button
            type="submit"
            class="login-btn">
            Se connecter
        </button>

    </form>

    <div class="footer">
        Dashboard Administration
    </div>

</div>

</body>
</html>