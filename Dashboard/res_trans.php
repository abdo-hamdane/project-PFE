<?php

session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

include_once("connexion.php");

/* =========================
   CONFIRMATION RESERVATION
========================= */

if(isset($_GET['confirm'])){

    $id = intval($_GET['confirm']);

    $update = $pdo->prepare("
        UPDATE reservation_transport
        SET statut='Confirmée'
        WHERE id_reservation_transport=?
    ");

    $update->execute([$id]);

    header("Location: reservation_transport.php");
    exit();
}

/* =========================
   AFFICHAGE RESERVATIONS
========================= */

$sql = "
SELECT
    rt.id_reservation_transport,
    rt.date_transport,
    rt.nb_personnes,
    rt.pickup,
    rt.prix_total,
    rt.statut,

    c.nom,

    t.type_transport,
    t.destination

FROM reservation_transport rt

JOIN client c
ON rt.id_client = c.id_client

JOIN transport t
ON rt.Id_transport = t.Id_transport

ORDER BY rt.id_reservation_transport DESC
";

$result = $pdo->query($sql);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Réservations Transport</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, Helvetica, sans-serif;
}

body{
    background:#f5f5f5;
    padding:40px;
}

.container{
    width: 100%;
    width:calc(100% - 280px);
}

.title{
    font-size:32px;
    margin:50px 0;
    color:#222;
    font-weight:bold;
}

table{
    width:100%;
    border-collapse:collapse;
    border-radius: 10px;
    background:white;
    
    overflow:hidden;
    box-shadow:0 5px 20px rgba(0,0,0,0.1);
}

table thead{
    background:#C9A227;
    color:white;
}

table th,
table td{
    padding:15px;
    text-align:center;
}

table tbody tr{
    border-bottom:1px solid #eee;
    transition:0.3s;
}

table tbody tr:hover{
    background:#f9f9f9;
}

.status{
    padding:6px 14px;
    border-radius:20px;
    color:white;
    font-size:14px;
    font-weight:bold;
}

.pending{
    background:orange;
}

.confirmed{
    background:green;
}

.cancel{
    background:red;
}

.btn-confirm{
    padding:10px 18px;
    border:none;
    background:#C9A227;
    color:white;
    border-radius:8px;
    cursor:pointer;
    font-weight:bold;
    transition:0.3s;
}

.btn-confirm:hover{
    background:#a88412;
}

.btn-done{
    padding:10px 18px;
    border:none;
    background:green;
    color:white;
    border-radius:8px;
    font-weight:bold;
}

a{
    text-decoration:none;
}



</style>

</head>
<body>

<?php include_once("sidebar.php"); ?>

<div class="container">

    <h1 class="title">
        Réservations Transport
    </h1>

    <table>

        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Transport</th>
                <th>Destination</th>
                <th>Date</th>
                <th>Personnes</th>
                <th>Pick Up</th>
                <th>Prix Total</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

        <?php while($row = $result->fetch(PDO::FETCH_ASSOC)){ ?>

            <tr>

                <td><?= $row['id_reservation_transport']; ?></td>

                <td><?= htmlspecialchars($row['nom']); ?></td>

                <td><?= htmlspecialchars($row['type_transport']); ?></td>

                <td><?= htmlspecialchars($row['destination']); ?></td>

                <td><?= $row['date_transport']; ?></td>

                <td><?= $row['nb_personnes']; ?></td>

                <td><?= htmlspecialchars($row['pickup']); ?></td>

                <td><?= $row['prix_total']; ?> DH</td>

                <td>

                    <?php

                    if($row['statut'] == "En Attente"){
                        echo "<span class='status pending'>En Attente</span>";
                    }
                    elseif($row['statut'] == "Confirmée"){
                        echo "<span class='status confirmed'>Confirmée</span>";
                    }
                    else{
                        echo "<span class='status cancel'>Annulée</span>";
                    }

                    ?>

                </td>

                <td>

                    <?php if($row['statut'] == "En Attente"){ ?>

                    <a href="?confirm=<?= $row['id_reservation_transport']; ?>">

                    <button class="btn-confirm">
                        Confirmer
                    </button>

                    </a>

                    <?php } else { ?>

                    <button class="btn-done">
                        Confirmée
                    </button>

                    <?php } ?>

                    </td>

            </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

</body>
</html>