<?php
session_start();
include_once(__DIR__ . "/../Dashboard/connexion.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $email = $_POST['email'];

    $check = $pdo->prepare("SELECT * FROM client WHERE email=?");
    $check->execute([$email]);

    $client = $check->fetch(PDO::FETCH_ASSOC);

    if($client){

        $_SESSION['temp_email'] = $email;

        header("Location: ../Mes_reservation.php");
        exit();

    } else {
        $error = "Email introuvable !";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mes Réservations</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(
        -45deg,
        #D4A017,
        #C68E17,
        #E8D3A1,
        #8B5E34
        );
        background-size:400% 400%;

    animation:gradientBG 12s ease infinite;
    padding:20px;
}

.card{
    width:420px;
    background:rgba(255,255,255,.12);
    backdrop-filter:blur(12px);
    border:1px solid rgba(255,255,255,.2);
    padding:40px;
    border-radius:20px;
    box-shadow:0 15px 35px rgba(0,0,0,.15);
}

.card h1{
    text-align:center;
    color:#0f172a;
    margin-bottom:10px;
}

.card p{
    text-align:center;
    color:#64748b;
    margin-bottom:25px;
}

.input-group{
    margin-bottom:20px;
}

.input-group label{
    display:block;
    margin-bottom:8px;
    font-weight:600;
}

.input-group input{
    width:100%;
    padding:15px;
    border:1px solid #dbe1e8;
    border-radius:10px;
    outline:none;
}

.input-group input:focus{
    border-color:#0ea5e9;
}

.btn{
    width:100%;
    padding:15px;
    border:none;
    border-radius:10px;
    background:#D4A017;
    color:white;
    font-size:16px;
    cursor:pointer;
    transition:.3s;
}

.btn:hover{
    background:#B8860B;
}

@keyframes gradientBG{
    0%{background-position:0% 50%;}
    50%{background-position:100% 50%;}
    100%{background-position:0% 50%;}
}

.card{
    width:100%;
    max-width:450px;
    background:rgba(255,255,255,.15);
    backdrop-filter:blur(15px);
    border:1px solid rgba(255,255,255,.2);
    border-radius:25px;
    padding:40px;
    animation:showCard .8s ease;
}

@keyframes showCard{
    from{
        opacity:0;
        transform:translateY(40px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

.card h1{
    color:#fff;
    text-align:center;
    margin-bottom:15px;
}

.card p{
    color:#f8fafc;
    text-align:center;
    margin-bottom:25px;
}

.input-group input{
    width:100%;
    padding:15px;
    border:none;
    border-radius:12px;
    outline:none;
    font-size:15px;
}

.btn{
    width:100%;
    padding:15px;
    border:none;
    border-radius:12px;
    background:#D4A017;
    color:white;
    font-weight:700;
    cursor:pointer;
    transition:.3s;
}

.btn:hover{
    transform:translateY(-3px);
    box-shadow:0 10px 25px rgba(0,0,0,.2);
}

</style>
</head>
<body>

<div class="card">

    <h1>Mes Réservations</h1>

    <p>Entrez votre email pour consulter vos réservations</p>

    <form method="POST">

        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <button type="submit" class="btn">
            Voir mes réservations
        </button>

    </form>
        <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
</div>


</body>
</html>