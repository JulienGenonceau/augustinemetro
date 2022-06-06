<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/actualites.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <title>Actualités</title>
</head>
<body>

<?php
    include 'configuration_page_accueil.php';
    include 'assets/php/connecttodb.php';
    include 'assets/includes/navbar.php';
    include 'assets/php/actuobj.php';
    ?>

    <div class="bodycontainer">
    <h4 class="firsttitle">LES ACTUALITÉS D'AUGUSTINE MÉTRO</h2>
    <div class="box" id="actualite">
        <?php


$stmt = $db->query("SELECT * FROM actu ORDER BY actu_id DESC LIMIT 1");
if (isset($_GET['actuid'])){
    $stmt = $db->query("SELECT * FROM actu WHERE actu_id =".$_GET['actuid']);
}
$lastactu = $stmt->fetch();
    
$name = $lastactu['actu_nom'];
$date_de_sortie = $lastactu['actu_date'];
$show_date = true;
if($lastactu['actu_showdate']==0){$show_date = false;}
$lastactu_ID = $lastactu['actu_id'];

$stmt = $db->query("SELECT * FROM actusection WHERE actusection_actuid =".$lastactu_ID);

$liste_de_sections = [];
while ($row = $stmt->fetch()) {
    $row_isvideo = false;
    $row_isimage = false;
    if ($row['actusection_is_video']=='1'){$row_isvideo = true;}
    if ($row['actusection_is_image']=='1'){$row_isimage = true;}

    $row_filepath = $row['actusection_filepath'];
    $row_title = $row['actusection_title'];
    $row_desc = $row['actusection_desc'];

    $liste_de_sections[] = new actu_section($row_isvideo, $row_isimage, $row_filepath,  $row_title, $row_desc);
}

$actualite = new actu($name, $liste_de_sections, $date_de_sortie, $show_date);

    echo "<p class='actu_title'>".$actualite->get_name()."</p>";

    $sections = $actualite->get_sections();

    $image_first = true;

    for ($i = 0; $i < count($sections); $i++){

        echo "<div class='actu_section_container'>";

        $section = $sections[$i];

        if ($image_first){
            show_image_or_video($section);
            show_title_and_text($section);
        }else{
            show_title_and_text($section);
            show_image_or_video($section);
        }
    
        if ($section->contains_image() || $section->contains_video()){
        $image_first = !$image_first;}

        echo "</div>";

    }
    
    if ($actualite->show_date()){
        echo "<p class='actu_date'>Article paru le ".$actualite->get_date()."</p>";
    }


    function show_image_or_video($section){
        if ($section->contains_image()){
            
            echo "<div class='actu_section_item'>";
            
            if (strlen($section->get_title())==0 && strlen($section->get_text())==0){echo"<div class='imgsmaller'>";};
    
                echo "<img class='actu_img' src='".$section->get_image_path()."'>";

            if (strlen($section->get_title())==0 && strlen($section->get_text())==0){echo"</div>";};
                
            echo "</div>";
    
            }
            if ($section->contains_video()){
                //afficher video !
            }
    }

    function show_title_and_text($section){
        if (strlen($section->get_title())>0 || strlen($section->get_text())>0){

            echo "<div class='actu_section_item'>";

            if (strlen($section->get_title())>0){
                echo "<p class='actu_section_title'>".$section->get_title()."</p>";
            }

            if (strlen($section->get_text())>0){
                echo "<p class='actu_section_text'>".$section->get_text()."</p>";
            }
            
            echo "</div>";
                
        }
    }

        ?>
    </div>

    <h4>RETROUVEZ TOUTES LES ACTUALITÉS</h4>

    <div class = "box" id="touteslesactualites">
        <?php

        $stmt = $db->query("SELECT * FROM actu ORDER BY actu_id DESC LIMIT 100");
        $found_image = false;
        while ($row = $stmt->fetch()) {
            echo "<a class='a_actulist' href='actualites?actuid=".$row['actu_id']."'>";
            
        $stmt1 = $db->query("SELECT * FROM actusection WHERE actusection_actuid =".$row['actu_id']);
            while ($row1 = $stmt1->fetch()) {
                if ($row1['actusection_is_image']==1){
                  $found_image = true;
                  echo "<img class='actu_miniature' src='assets/php/actualites_files/".$row1['actusection_filepath']."'>";
                  break;
                }
              }
            echo ("<p class='actu_nomlist'>".$row['actu_nom']."</p>");
            echo "</a>";
        }

        ?>
    </div>
    </div>
    
  <?php include 'assets/includes/footer.php';?>
    
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>