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

    $actualite = new actu("Les poules ont maintenant des dents", [
        new actu_section(false, true, "assets/img/actualites/734775-chocolats-de-paques-cluizel-2022-paques-tropicales.jpg", "C'est véridique", "A constructor allows you to initialize an object's properties upon creation of the object.

        If you create a __construct() function, PHP will automatically call this function when you create an object from a class.
        
        Notice that the construct function starts with two underscores (__)!
        
        We see in the example below, that using a constructor saves us from calling the set_name() method which reduces the amount of code:"),
        new actu_section(false, false, "","C'est véridique", "A constructor allows you to initialize an object's properties upon creation of the object.

        If you create a __construct() function, PHP will automatically call this function when you create an object from a class.
        
        Notice that the construct function starts with two underscores (__)!
        
        We see in the example below, that using a constructor saves us from calling the set_name() method which reduces the amount of code:"),
        new actu_section(false, true, "assets/img/actualites/734775-chocolats-de-paques-cluizel-2022-paques-tropicales.jpg", "C'est véridique", "A constructor allows you to initialize an object's properties upon creation of the object.

        If you create a __construct() function, PHP will automatically call this function when you create an object from a class.
        
        Notice that the construct function starts with two underscores (__)!
        
        We see in the example below, that using a constructor saves us from calling the set_name() method which reduces the amount of code:"),
        new actu_section(false, true, "assets/img/actualites/734775-chocolats-de-paques-cluizel-2022-paques-tropicales.jpg", "", ""),
        new actu_section(false, false, "", "", "A constructor allows you to initialize an object's properties upon creation of the object.

        If you create a __construct() function, PHP will automatically call this function when you create an object from a class.
        
        Notice that the construct function starts with two underscores (__)!
        
        We see in the example below, that using a constructor saves us from calling the set_name() method which reduces the amount of code:")
    ], 
    date("Y/m/d"),
    true);

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

    <div class = "box" id="touteslesactualites">
        Liste de toutes les actualités
    </div>
    </div>
    
  <?php include 'assets/includes/footer.php';?>
    
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>