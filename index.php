<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Augustine métro</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="assets/css/footer.css">
</head>
<body>

    <?php include 'assets/includes/navbar.php';?>

  <div id = "bodycontainer">

    <div class = "paralax">
      AUGUSTINE MÉTRO
    </div>

    <div class="slider">
    <ul class="slides">
      <li>
        <img src="assets/img/slider2.jpg"> <!-- random image -->
        <div class="caption left-align">
          <h3>AUGUSTINE MÉTRO</h3>
          <h5 class="light grey-text text-lighten-3">La mode pour P'tit loupiots depuis 1988.</h5>
          <h6 class="light grey-text text-lighten-3">Fabrication artisanale dans l'atelier à Wignicourt Ardennes France 100%.</h6>
          <a href="https://augustine-metro.fr/page/4-augustine-metro-portrait">Découvrir</a>
        </div>
      </li>
      <li>
        <img src="assets/img/slider3.jpg"> <!-- random image -->
        <div class="caption left-align">
          <h3>ARTISAN</h3>
          <h5 class="light grey-text text-lighten-3">Des vêtements rigolos et originaux</h5>
          <h6 class="light grey-text text-lighten-3">Pour les enfants et aussi pour les adultes.</h6>
          <h6 class="light grey-text text-lighten-3">Le style Augustine Métro fabriqué artisanalement dans les Ardennes France, depuis 1988.</h6>
          <a href="https://www.francetvinfo.fr/culture/mode/augustine-metro-la-marque-pour-enfant-totalement-fabriquee-en-france_2372307.html">Voir plus</a>
        </div>
      </li>
      <li>
        <img src="assets/img/slider1.png"> <!-- random image -->
        <div class="caption center-align">
          <h3>+ DE RENSEIGNEMENTS</h3>
          <h5 class="light grey-text text-lighten-3">Vous ne trouvez pas la taille voulue ? Un renseignement ?</h5>
          <h6 class="light grey-text text-lighten-3">Prenez contact avec Philippe LINGLET au 06.11.38.79.51. ou en nous envoyant un message via le formulaire de contact</h6>
          <h6 class="light grey-text text-lighten-3">Le style Augustine Métro fabriqué artisanalement dans les Ardennes France, depuis 1988.</h6>
          <a href="https://augustine-metro.fr/nous-contacter">Nous contacter</a>
        </div>
      </li>
      <li>
        <img src="assets/img/slider2.jpg"> <!-- random image -->
        <div class="caption left-align">
          <h3>NOUVEAUX IMPRIMÉS SOFT SHELL</h3>
          <h5 class="light grey-text text-lighten-3">Nouvel arrivage à l'atelier.</h5>
          <h6 class="light grey-text text-lighten-3">Softshell imprimé 'Paresseux' doublé polaire de couleur bleu marine.</h6>
          <a href="https://augustine-metro.fr/page/14-nouveaux-arrivages-de-tissu">Découvrir</a>
        </div>
      </li>
    </ul>
  </div>

  <h3 class="decouvreznosderniersarticles">Découvrez nos derniers articles</h3>

  <section id="derniers_articles">
    <div id="derniers_articles_leftarrow"></div>
  <div class="horizontal-scroll">

  <?php

for ($i = 1; $i <= 10; $i++) {
    echo "<div class='horizontal-scroll__item'>";
    echo "<img class='article_img' src='assets/img/articleimg.jpg'></img>";
    echo "<p class='p1'>Article ".$i."</p>";
    echo "<p class='p2'>"."48.00"."€</p>";
    echo "<a href='https://augustine-metro.fr/100-poncho-cape-adulte-violet.html' class='horizontal-scroll__itemonclick'>Voir l'article</a>";
    echo "</div>";
}

?>
  </div>
    <div id="derniers_articles_rightarrow"></div>
  </section>

  <h3 class="trouvezvotrebonheur">Trouvez votre bonheur</h3>
  <div class = "zone_bonheur">
  <div class="zone_bonheur_container">
        <div class="bonheur_categorie_title" id="ponchotitle">
        <img src = "assets/img/ponchos.jpg">
        <p>PONCHOS</p>
        </div>
			<ul class="zone_bonheur_wrapper">
				<?php
        
        for ($i = 1; $i <= 9; $i++) {
          echo "<li class='horizontal-scroll__item bonheur'>";
          echo "<img class='article_img' src='assets/img/articleimg.jpg'></img>";
          echo "<p class='p1'>Article ".$i."</p>";
          echo "<p class='p2'>"."48.00"."€</p>";
          echo "<a href='https://augustine-metro.fr/100-poncho-cape-adulte-violet.html' class='horizontal-scroll__itemonclick'>Voir l'article</a>";
          echo "</li>";
      }
        
        ?>
			</ul>

      <div class = "zone_news">
  Dernières actualités
  </div>
      <div class="bonheur_categorie_title second">
        <img src = "assets/img/softshell.jpg">
        <p>SOFTSHELLS</p>
        </div>
			<ul class="zone_bonheur_wrapper">
				<?php
        
        for ($i = 1; $i <= 9; $i++) {
          echo "<li class='horizontal-scroll__item'>";
          echo "<img class='article_img' src='assets/img/articleimg.jpg'></img>";
          echo "<p class='p1'>Article ".$i."</p>";
          echo "<p class='p2'>"."48.00"."€</p>";
          echo "<a href='https://augustine-metro.fr/100-poncho-cape-adulte-violet.html' class='horizontal-scroll__itemonclick'>Voir l'article</a>";
          echo "</li>";
      }
        
        ?>
			</ul>
		</div>
    <a class="voirplus" href="https://augustine-metro.fr/2-accueil">Voir plus</a>
  </div>

  

  
  <?php include 'assets/includes/footer.php';?>

  
  </div>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script>

  $(document).ready(function(){
    $('.slider').slider();
  });

  $( "#derniers_articles" ).mouseenter(function() {
  document.getElementById("derniers_articles_leftarrow").style.opacity = "1";
  document.getElementById("derniers_articles_rightarrow").style.opacity = "1";
  });
  $( "#derniers_articles" ).mouseleave(function() {
    if (window.innerWidth > 900){
  document.getElementById("derniers_articles_leftarrow").style.opacity = "0";
  document.getElementById("derniers_articles_rightarrow").style.opacity = "0";
}
  });

  $('#derniers_articles_rightarrow').click(function(){
    $( ".horizontal-scroll" ).scrollLeft( $( ".horizontal-scroll" ).scrollLeft() + $( ".horizontal-scroll" ).width() );
  });
  $('#derniers_articles_leftarrow').click(function(){
    $( ".horizontal-scroll" ).scrollLeft( $( ".horizontal-scroll" ).scrollLeft() - $( ".horizontal-scroll" ).width() );
  });

  const collection = document.getElementsByClassName("zone_bonheur_wrapper");
  for (let i = 0; i < collection.length; i++) {
  collection[i].style.width = document.getElementById("ponchotitle").offsetWidth+"px";
  }

  window.addEventListener("resize", function(){
    if (window.innerWidth > 900){
      document.getElementById("derniers_articles_leftarrow").style.opacity = "0";
      document.getElementById("derniers_articles_rightarrow").style.opacity = "0";
    }else{
      document.getElementById("derniers_articles_leftarrow").style.opacity = "1";
      document.getElementById("derniers_articles_rightarrow").style.opacity = "1";
    }
    const collection = document.getElementsByClassName("zone_bonheur_wrapper");
  for (let i = 0; i < collection.length; i++) {
  collection[i].style.width = document.getElementById("ponchotitle").offsetWidth+"px";
  }
  });
  </script>

</body>
</html>