<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moja stránka</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/accordion.css">
    <link rel="stylesheet" href="css/banner.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <!-- header -->
<?php include('parts/header.php');?>

  <main>
    <section class="banner">
      <div class="container text-white">
        <h1>Q&A</h1>
      </div>
    </section>
    <section class="container">
      <div class="row">
        <div class="col-100 text-center">
          <p><strong><em>Elit culpa id mollit irure sit. Ex ut et ea esse culpa officia ea incididunt elit velit veniam qui. Mollit deserunt culpa incididunt laborum commodo in culpa.</em></strong></p>
        </div>
      </div>
    </section>
    
    <?php
    // Načítanie triedy a konfigurácie
    require_once 'db/config.php';  // Súbor s konfiguráciou pripojenia k DB
    require_once 'db/classy/QnA.php';     // Zahrnúť triedu QnA
    
    // Inicializácia objektu QnA
    $qnaManager = new QnA($conn);
    
    // Načítanie otázok a odpovedí z databázy
    $qnaData = $qnaManager->citajOtazkyOdpovede();
    
    // Dynamické generovanie sekcie s otázkami a odpoveďami
    if (!empty($qnaData)) {
        echo '<section class="container">';
        foreach ($qnaData as $item) {
            echo '<div class="accordion">';
            echo '<div class="question">' . htmlspecialchars($item['otazka']) . '</div>';
            echo '<div class="answer">' . htmlspecialchars($item['odpoved']) . '</div>';
            echo '</div>';
        }
        echo '</section>';
    } else {
        echo '<section class="container"><div class="row"><div class="col-100 text-center">';
        echo '<p>Zatiaľ nie sú k dispozícii žiadne otázky a odpovede.</p>';
        echo '</div></div></section>';
    }
    ?>

  </main>
  <footer class="container bg-dark text-white">
    <div class="row">
      <div class="col-25">
        <h4>Kto sme</h4>
        <p>Laboris duis ut est fugiat et reprehenderit magna labore aute.</p>
        <p>Laboris duis ut est fugiat et reprehenderit magna labore aute.</p>
        <p>Laboris duis ut est fugiat et reprehenderit magna labore aute.</p>
      </div>
      <div class="col-25 text-left">
        <h4>Kontaktujte nás</h4>
        <p><i class="fa fa-envelope" aria-hidden="true"><a href="mailto:livia.kelebercova@gmail.com"> livia.kelebercova@gmail.com</a></i></p>
        <p><i class="fa fa-phone" aria-hidden="true"><a href="tel:0909500600"> 0909500600</a></i></p>
      </div>
      <div class="col-25">
        <h4>Rýchle odkazy</h4>
        <p><a href="/">Domov</a></p>
        <p><a href="/qna">Q&A</a></p>
        <p><a href="/kontakt">Kontakt</a></p>
      </div>
      <div class="col-25">
        <h4>Nájdete nás</h4>
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10614.839764656655!2d18.0910518!3d48.3084298!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xba2bad032d96b960!2sFakulta%20pr%C3%ADrodn%C3%BDch%20vied%20a%20informatiky!5e0!3m2!1ssk!2ssk!4v1669307792855!5m2!1ssk!2ssk" width="300" height="150" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> 
       </div>
    </div>
    <div class="row">
      Created and designed by Lívia
    </div>
  </footer>
<script src="js/accordion.js"></script>
<script src="js/menu.js"></script>
</body>
</html>