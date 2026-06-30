<?php 
include_once("Dashboard/connexion.php"); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- lien pour le fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <!-- lien pour css -->
    <link rel="stylesheet" href="assets/css/avtivite.css">

    <!-- lien pour les icon-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
</head>

<body>
    
    
    <section class="activite_pop">
        <?php
        include_once 'fronts/header.php';
        ?>  
        <header class="agafay-hero">

            <div class="agafay-hero-bg"></div>
            <div class="agafay-hero-overlay"></div>

            <div class="agafay-hero-content">

                <span class="agafay-hero-tag">
                    ✦ Discover Morocco
                </span>

                <h1 class="agafay-hero-title">
                    Desert <br>
                    <span>Experiences</span>
                </h1>

                <p class="agafay-hero-text">
                    Explore unforgettable adventures in Agafay Desert.
                    Enjoy Quad, Buggy, Camel Ride, Luxury Transport,
                    Dinner Shows and magical sunsets under the stars.
                </p>

                <div class="agafay-hero-buttons">

                    <a href="#activity-scroll" class="agafay-btn-primary">
                        Explore Activities
                    </a>

                    <a href="contact.php" class="agafay-btn-secondary">
                        Contact Us
                    </a>

                </div>

            </div>

            <div class="agafay-scroll">
                <span>Scroll</span>
                <div class="agafay-scroll-line"></div>
            </div>

        </header>

      <!-- ░░ ACTIVITIES SECTION ░░ -->
     
        <div class="acth">
            <h1>Explore ABTrip</h1>
        </div>

        <!-- FILTER -->
        <div class="filters">
            <button onclick="filterCards('all')">Tous</button>
            <button onclick="filterCards('Quad')">Quad</button>
            <button onclick="filterCards('Buggy')">Buggy</button>
            <button onclick="filterCards('Camel Ride')">Camel Ride</button>
            <button onclick="filterCards('Dinner & Show')">Dinner & Show</button>
        </div>

        <?php


$stmt = $pdo->prepare("SELECT * FROM activity");
$stmt->execute();

$activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="activity-showcase-section" id="activity-scroll">

    <div class="activity-showcase-header">
        <h2>Nos Activités</h2>
        <p>Découvrez nos meilleures expériences à Agafay</p>
    </div>

    <div class="activity-showcase-grid">

        <?php foreach($activities as $activity){ ?>

        <div class="activity-showcase-card card" data-category="<?= htmlspecialchars($activity['type_activite']); ?>">

            <div class="activity-showcase-image-wrapper">

                <img
                    src="Uploads/<?= htmlspecialchars($activity['image']); ?>"
                    alt="<?= htmlspecialchars($activity['type_activite']); ?>"
                    class="activity-showcase-image">

                <span class="activity-showcase-price">
                    <?= $activity['prix']; ?> EUR
                </span>

            </div>

            <div class="activity-showcase-content">

                <h3 class="activity-showcase-title">
                    <?= htmlspecialchars($activity['type_activite']); ?>
                </h3>

                <p class="activity-showcase-location">
                    📍 <?= htmlspecialchars($activity['Localisation']); ?>
                </p>

                <p class="activity-showcase-duration">
                    ⏳ <?= htmlspecialchars($activity['duree']); ?> H
                </p>

                <p class="activity-showcase-description">
                <?= mb_strlen($activity['description']) > 100
                    ? mb_substr($activity['description'],0,100).'...'
                    : $activity['description']; ?>
                </p>

                <a class="activity-showcase-btn" href="reservation.php?id=<?= $activity['id_activite']; ?> ">
                    Réserver
                </a>

            </div>

        </div>

        <?php } ?>

    </div>

</section>
        

        <!-- ░░ STATS STRIP ░░ -->
        <?php $activities = $pdo->query("SELECT COUNT(*) FROM Activity")->fetchColumn();?>
        <div class="stats">
            <div class="stats__inner">
            <div class="stats__item"><span class="stats__num" data-target="2400">0</span><span class="stats__label">Happy Guests</span></div>
            <div class="stats__item"><span class="stats__num" data-target="<?= $activities; ?>"><?= $activities; ?></span><span class="stats__label">Activities</span></div>
            <div class="stats__item"><span class="stats__num" data-target="8">0</span><span class="stats__label">Years Experience</span></div>
            <div class="stats__item"><span class="stats__num" data-target="98">0</span><span class="stats__label">% Satisfaction</span></div>
            </div>
        </div>
    </section>


  <?php
  include_once "fronts/footer.php";
  ?>
        <script>
      /* FILTER */
      function filterCards(category) {

            const cards = document.querySelectorAll('.card');

            cards.forEach(card => {

                if(category === 'all' || card.dataset.category === category){
                    card.style.display = '';
                }else{
                    card.style.display = 'none';
                }

            });
        }

      /* ANIMATION ON LOAD */
      window.addEventListener('load',()=>{
          let cards=document.querySelectorAll('.card');
          cards.forEach((card,i)=>{
              setTimeout(()=>{
                  card.classList.add('show');
              }, i*150);
          });
      });
      /*Status bar */
      
      const counters = document.querySelectorAll('.stats__num');

      const speed = 200; // كلما نقصتيها غادي تكون أسرع

      const animateCounters = (entries, observer) => {
          entries.forEach(entry => {
              if(entry.isIntersecting){

                  counters.forEach(counter => {
                      const target = +counter.getAttribute('data-target');
                      let count = 0;

                      const updateCount = () => {
                          const increment = target / speed;

                          if(count < target){
                              count += increment;
                              counter.innerText = Math.ceil(count);
                              setTimeout(updateCount, 10);
                          } else {
                              counter.innerText = target;
                          }
                      };

                      updateCount();
                  });

                  observer.disconnect(); // يخدم غير مرة وحدة
              }
          });
      };

      const observer = new IntersectionObserver(animateCounters, {
          threshold: 0.5
      });

      observer.observe(document.querySelector('.stats'));

      </script>

</body>
</html>