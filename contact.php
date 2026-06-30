<?php

if(isset($_POST['envoyer'])){

    $nom = urlencode($_POST['nom']);
    $email = urlencode($_POST['email']);
    $telephone = urlencode($_POST['telephone']);
    $service = urlencode($_POST['service']);
    $message = urlencode($_POST['message']);

    $texte = "🌍 Nouvelle demande ABTrip%0A%0A".
             "👤 Nom : ".$nom."%0A".
             "📧 Email : ".$email."%0A".
             "📞 Téléphone : ".$telephone."%0A".
             "🎯 Service : ".$service."%0A%0A".
             "📝 Message : ".$message;

    header("Location: https://wa.me/212767591510?text=".$texte);
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - ABTrip</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #F9F9F9;
            font-family: 'Poppins', sans-serif;
            max-height: fit-content;
            min-height: 100vh;
            margin: 0px;
            padding: 0%;
        }
        .contact-section {
            padding: 60px 0;
            margin-top: 50px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .btn-orange {
            background-color: #FF7A00;
            color: white;
            border: none;
        }
        .btn-orange:hover {
            background-color: #F4A261;
        }
        .title {
            font-weight: bold;
        }
        .card p-4>input{
            width: 300px;
        }
    </style>
</head>
<body>

<div class="container contact-section">
    <?php
        include_once 'fronts/header.php';
    ?>  
    <div class="text-center mb-5">
        <h1 class="title">Contactez-nous</h1>
        <p>Une question ou envie de réserver ? Notre équipe est à votre écoute.</p>
    </div>

    <div class="row">
        <!-- Formulaire -->
        <div class="col-md-6 mb-4">
            <div class="card p-4">
                <form method="POST">

            <div class="mb-3">
                <label>Nom complet</label>
                <input type="text" name="nom" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Téléphone</label>
                <input type="text" name="telephone" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Service souhaité</label>

                <select name="service" class="form-control">

                    <option>Balade à dos de chameau</option>
                    <option>Quad</option>
                    <option>Buggy</option>
                    <option>Dîner & Spectacle</option>
                    <option>Transport</option>

                </select>
            </div>

            <div class="mb-3">
                <label>Message</label>

                <textarea
                name="message"
                class="form-control"
                rows="4"
                required></textarea>
            </div>

            <button
            type="submit"
            name="envoyer"
            class="btn btn-orange w-100">

                Envoyer la demande

            </button>

        </form>
            </div>
        </div>

        

        <!-- Infos -->
        <div class="col-md-6">
            <div class="card p-4 mb-4">
                <h5>Informations de contact</h5>
                <p><strong>📍 Adresse :</strong> Marrakech, Maroc</p>
                <p><strong>📞 Téléphone :</strong> +212 7 07 98 22 82</p>
                <p><strong>📧 Email :</strong> AgenceABTrip@gmail.com</p>
                <p><strong>🕒 Horaires :</strong> 09h00 – 20h00</p>
            </div>

            <!-- Map -->
            <div class="card">
                 
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1445.766998280367!2d-8.189600452472954!3d31.464152337762958!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sen!2sma!4v1782835504741!5m2!1sen!2sma"
                         width="600" height="300" style="border:0; border-radius: 10px;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
                
            </div>
        </div>
    </div>
</div>
<?php
  include_once "fronts/footer.php";
  ?>
</body>
</html>