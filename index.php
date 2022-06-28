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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <?php
    include 'configuration_page_accueil.php';
    include 'assets/php/connecttodb.php';
    include 'assets/includes/navbar.php';
    ?>

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

$sql = 'SELECT SQL_CALC_FOUND_ROWS p.`id_product` AS `id_product`,
 p.`reference`  AS `reference`,
 sa.`price`  AS `price`,
 p.`id_shop_default`  AS `id_shop_default`,
 p.`is_virtual`  AS `is_virtual`,
 pl.`name`  AS `name`,
 pl.`link_rewrite`  AS `link_rewrite`,
 sa.`active`  AS `active`,
 shop.`name`  AS `shopname`,
 image_shop.`id_image`  AS `id_image`,
 cl.name  AS name_category,
 0 AS `price_final`,
 pd.`nb_downloadable`  AS `nb_downloadable`,
 sav.`quantity`  AS `sav_quantity`,
 IF(sav.`quantity`<=0, 1, 0) AS `badge_danger`,
 cp.`position`  AS `position` 
FROM  `psec_product` p 
 LEFT JOIN `psec_product_lang` pl ON (pl.`id_product` = p.`id_product` AND pl.`id_lang` = 2 AND pl.`id_shop` = 1) 
 LEFT JOIN `psec_stock_available` sav ON (sav.`id_product` = p.`id_product` AND sav.`id_product_attribute` = 0 AND sav.id_shop = 1  AND sav.id_shop_group = 0 ) 
 JOIN `psec_product_shop` sa ON (p.`id_product` = sa.`id_product` AND sa.id_shop = 1) 
 LEFT JOIN `psec_category_lang` cl ON (sa.`id_category_default` = cl.`id_category` AND cl.`id_lang` = 2 AND cl.id_shop = 1) 
 LEFT JOIN `psec_category` c ON (c.`id_category` = cl.`id_category`) 
 LEFT JOIN `psec_shop` shop ON (shop.id_shop = 1) 
 LEFT JOIN `psec_image_shop` image_shop ON (image_shop.`id_product` = p.`id_product` AND image_shop.`cover` = 1 AND image_shop.id_shop = 1) 
 LEFT JOIN `psec_image` i ON (i.`id_image` = image_shop.`id_image`) 
 LEFT JOIN `psec_product_download` pd ON (pd.`id_product` = p.`id_product`) 
 INNER JOIN `psec_category_product` cp ON (cp.`id_product` = p.`id_product` AND cp.`id_category` = 2)
 WHERE (1 AND state = 1)
 
ORDER BY  `position` asc,  `id_product` asc
 
LIMIT 0, '.$nombre_de_derniers_articles_a_afficher;

$stmt = $db->query($sql);
$products = $stmt->fetchAll();

for ($i = 0; $i <= $nombre_de_derniers_articles_a_afficher-1; $i++) {

  if ($products[$i] != null){

    echo "<div class='horizontal-scroll__item'>";
    echo "<img class='article_img' src='https://augustine-metro.fr/".$products[$i][9]."-medium_default/".$products[$i][6].".jpg'></img>";
    echo "<p class='p1'>".$products[$i][1]."</p>";
    echo "<p class='p2'>".round($products[$i][2]*(1+$taxe_sur_articles/100), 2)."€</p>";
    echo "<a href='https://augustine-metro.fr/".$products[$i][0]."-".$products[$i][6].".html' class='horizontal-scroll__itemonclick'>Voir l'article</a>";
    echo "</div>";

  }

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

$sql = 'SELECT SQL_CALC_FOUND_ROWS p.`id_product` AS `id_product`,
p.`reference`  AS `reference`,
sa.`price`  AS `price`,
p.`id_shop_default`  AS `id_shop_default`,
p.`is_virtual`  AS `is_virtual`,
pl.`name`  AS `name`,
pl.`link_rewrite`  AS `link_rewrite`,
sa.`active`  AS `active`,
shop.`name`  AS `shopname`,
image_shop.`id_image`  AS `id_image`,
cl.name  AS name_category,
0 AS `price_final`,
pd.`nb_downloadable`  AS `nb_downloadable`,
sav.`quantity`  AS `sav_quantity`,
IF(sav.`quantity`<=0, 1, 0) AS `badge_danger`,
cp.`position`  AS `position` 
FROM  `psec_product` p 
LEFT JOIN `psec_product_lang` pl ON (pl.`id_product` = p.`id_product` AND pl.`id_lang` = 2 AND pl.`id_shop` = 1) 
LEFT JOIN `psec_stock_available` sav ON (sav.`id_product` = p.`id_product` AND sav.`id_product_attribute` = 0 AND sav.id_shop = 1  AND sav.id_shop_group = 0 ) 
JOIN `psec_product_shop` sa ON (p.`id_product` = sa.`id_product` AND sa.id_shop = 1) 
LEFT JOIN `psec_category_lang` cl ON (sa.`id_category_default` = cl.`id_category` AND cl.`id_lang` = 2 AND cl.id_shop = 1) 
LEFT JOIN `psec_category` c ON (c.`id_category` = cl.`id_category`) 
LEFT JOIN `psec_shop` shop ON (shop.id_shop = 1) 
LEFT JOIN `psec_image_shop` image_shop ON (image_shop.`id_product` = p.`id_product` AND image_shop.`cover` = 1 AND image_shop.id_shop = 1) 
LEFT JOIN `psec_image` i ON (i.`id_image` = image_shop.`id_image`) 
LEFT JOIN `psec_product_download` pd ON (pd.`id_product` = p.`id_product`) 
INNER JOIN `psec_category_product` cp ON (cp.`id_product` = p.`id_product` AND cp.`id_category` = 2)
WHERE (1 AND state = 1) AND (cl.name = "Ponchos-Capes")

ORDER BY  `position` asc,  `id_product` asc

LIMIT 0, '.$nombre_de_derniers_articles_a_afficher_categorie;

$stmt = $db->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll();
        
        for ($i = 0; $i <= $nombre_de_derniers_articles_a_afficher_categorie-1; $i++) {

          if ($products[$i] != null){

          echo "<li class='horizontal-scroll__item bonheur'>";
          echo "<img class='article_img' src='https://augustine-metro.fr/".$products[$i][9]."-medium_default/".$products[$i][6].".jpg'></img>";
          echo "<p class='p1'>".$products[$i][1]."</p>";
          echo "<p class='p2'>".round($products[$i][2]*(1+$taxe_sur_articles/100), 2)."€</p>";
          echo "<a href='https://augustine-metro.fr/".$products[$i][0]."-".$products[$i][6].".html' class='horizontal-scroll__itemonclick'>Voir l'article</a>";
          echo "</li>";

          }
      }
        
        ?>
			</ul>

      <?php

$sql = "SELECT count(*) FROM actu"; 
$result = $db->prepare($sql); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 

if ($number_of_rows > 0){

  ?>

      <div id="zone_newscontainer">
         <div id="actus_leftarrow"></div>
      <div class = "zone_news">
        <?php

        $stmt = $db->query("SELECT * FROM actu ORDER BY actu_id DESC LIMIT 1");
        while ($row = $stmt->fetch()) {
            echo "<a class='actu_box' href='actualites.php?actuid=".$row['actu_id']."'>";

            
        $stmt1 = $db->query("SELECT * FROM actusection WHERE actusection_actuid =".$row['actu_id']);
        $found_image = false;
        while ($row1 = $stmt1->fetch()) {
          if ($row1['actusection_is_image']==1){
            $found_image = true;
            echo "<img class='actu_miniature' src='assets/php/actualites_files/".$row1['actusection_filepath']."'>";
            break;
          }
        }

            echo '<div class="actu_text">';
            echo "<h4>".$row['actu_nom']."</h4>";
            
            $stmt1 = $db->query("SELECT * FROM actusection WHERE actusection_actuid =".$row['actu_id']);
            while ($row1 = $stmt1->fetch()) {
              if (strlen($row1['actusection_desc'])>0){
                echo "<p>".$row1['actusection_desc']."</p>";
                break;
              }
            }
            echo '</div>';

            echo "</a>";

            
        if (!$found_image){
         echo "
         <script>
         $('.actu_text').width('100%');
         $('.actu_text').css('margin-bottom','20px');
         </script>
         ";
        }
        }

        ?>
  </div>
         <div id="actus_rightarrow"></div>
  </div>

  
  
  <a class="voirplus" href="actualites.php">Voir toutes les actualités d'Augustine Métro</a>
  <?php
}
  ?>

      <div class="bonheur_categorie_title second">
        <img src = "assets/img/softshell.jpg">
        <p>SOFTSHELLS</p>
        </div>
			<ul class="zone_bonheur_wrapper">
				<?php

$sql = 'SELECT SQL_CALC_FOUND_ROWS p.`id_product` AS `id_product`,
p.`reference`  AS `reference`,
sa.`price`  AS `price`,
p.`id_shop_default`  AS `id_shop_default`,
p.`is_virtual`  AS `is_virtual`,
pl.`name`  AS `name`,
pl.`link_rewrite`  AS `link_rewrite`,
sa.`active`  AS `active`,
shop.`name`  AS `shopname`,
image_shop.`id_image`  AS `id_image`,
cl.name  AS name_category,
0 AS `price_final`,
pd.`nb_downloadable`  AS `nb_downloadable`,
sav.`quantity`  AS `sav_quantity`,
IF(sav.`quantity`<=0, 1, 0) AS `badge_danger`,
cp.`position`  AS `position` 
FROM  `psec_product` p 
LEFT JOIN `psec_product_lang` pl ON (pl.`id_product` = p.`id_product` AND pl.`id_lang` = 2 AND pl.`id_shop` = 1) 
LEFT JOIN `psec_stock_available` sav ON (sav.`id_product` = p.`id_product` AND sav.`id_product_attribute` = 0 AND sav.id_shop = 1  AND sav.id_shop_group = 0 ) 
JOIN `psec_product_shop` sa ON (p.`id_product` = sa.`id_product` AND sa.id_shop = 1) 
LEFT JOIN `psec_category_lang` cl ON (sa.`id_category_default` = cl.`id_category` AND cl.`id_lang` = 2 AND cl.id_shop = 1) 
LEFT JOIN `psec_category` c ON (c.`id_category` = cl.`id_category`) 
LEFT JOIN `psec_shop` shop ON (shop.id_shop = 1) 
LEFT JOIN `psec_image_shop` image_shop ON (image_shop.`id_product` = p.`id_product` AND image_shop.`cover` = 1 AND image_shop.id_shop = 1) 
LEFT JOIN `psec_image` i ON (i.`id_image` = image_shop.`id_image`) 
LEFT JOIN `psec_product_download` pd ON (pd.`id_product` = p.`id_product`) 
INNER JOIN `psec_category_product` cp ON (cp.`id_product` = p.`id_product` AND cp.`id_category` = 2)
WHERE (1 AND state = 1) AND (p.`reference` LIKE "%SOFTSHELL%")

ORDER BY  `position` asc,  `id_product` asc

LIMIT 0, '.$nombre_de_derniers_articles_a_afficher_categorie;

$stmt = $db->query($sql);
$products = $stmt->fetchAll();
        
    for ($i = 0; $i <= $nombre_de_derniers_articles_a_afficher_categorie-1; $i++) {

          if ($products[$i] != null){

          echo "<li class='horizontal-scroll__item bonheur'>";
          echo "<img class='article_img' src='https://augustine-metro.fr/".$products[$i][9]."-medium_default/".$products[$i][6].".jpg'></img>";
          echo "<p class='p1'>".$products[$i][1]."</p>";
          echo "<p class='p2'>".round($products[$i][2]*(1+$taxe_sur_articles/100), 2)."€</p>";
          echo "<a href='https://augustine-metro.fr/".$products[$i][0]."-".$products[$i][6].".html' class='horizontal-scroll__itemonclick'>Voir l'article</a>";
          echo "</li>";

          }
      }
        
        ?>
			</ul>
		</div>
    <a class="voirplus" href="https://augustine-metro.fr/2-accueil">Voir plus</a>
  </div>

  

  
  <?php include 'assets/includes/footer.php';?>

  
  </div>
  
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
  $( "#zone_newscontainer" ).mouseenter(function() {
  document.getElementById("actus_leftarrow").style.opacity = "1";
  document.getElementById("actus_rightarrow").style.opacity = "1";
  });
  $( "#zone_newscontainer" ).mouseleave(function() {
    if (window.innerWidth > 900){
  document.getElementById("actus_leftarrow").style.opacity = "0";
  document.getElementById("actus_rightarrow").style.opacity = "0";
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

  var actu_id_offset = 0;

  document.getElementById("actus_rightarrow").onclick = function(){
    actu_id_offset += 1;
    $.post("assets/php/get_actupreview.php",
  {
    offset: actu_id_offset
  },
  function(data){
    if (data.length>0){
      $('.zone_news').html(data);
    }else{
      actu_id_offset = 0;
      $.post("assets/php/get_actupreview.php",
  {
    offset: actu_id_offset
  },
  function(data){
     $('.zone_news').html(data);
  });
    }
  });
  }

  document.getElementById("actus_leftarrow").onclick = function(){
    actu_id_offset -= 1;
    if (actu_id_offset < 0){
      actu_id_offset += 2;
    }
    $.post("assets/php/get_actupreview.php",
  {
    offset: actu_id_offset
  },
  function(data){
      $('.zone_news').html(data);
  });
  }

  </script>

</body>
</html>