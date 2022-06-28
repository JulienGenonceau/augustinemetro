<?php

include '../../configuration_page_accueil.php';
include '../../assets/php/connecttodb.php';

if (!empty(mysqli_real_escape_string($link, $_POST["inputvalue"]))) {

    $inputvalue = mysqli_real_escape_string($link, $_POST["inputvalue"]);

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
    WHERE (1 AND state = 1) AND (p.`reference` LIKE "%'.$inputvalue.'%")
    
    ORDER BY  `position` asc,  `id_product` asc
    
    LIMIT 0, '.$recherche_max_articles;

    $stmt = $db->prepare($sql);
    $stmt->execute(); 
    $products = $stmt->fetchAll();

    if (count($products)>0){

        echo '<p class="p_resultatspour">Résultats pour " '.$inputvalue.' "</p>';
        echo '<div class="container">
  
        <div class="feature">';

        for ($i = 0; $i <= count($products)-1; $i++) {

            if ($products[$i] != null){
            echo '<div class="item">';
            echo "<li class='horizontal-scroll__item bonheur'>";
            echo "<img class='article_img' src='https://augustine-metro.fr/".$products[$i][9]."-medium_default/".$products[$i][6].".jpg'></img>";
            echo "<p class='p1'>".$products[$i][1]."</p>";
            echo "<p class='p2'>".round($products[$i][2]*(1+$taxe_sur_articles/100), 2)."€</p>";
            echo "<a href='https://augustine-metro.fr/".$products[$i][0]."-".$products[$i][6].".html' class='horizontal-scroll__itemonclick'>Voir l'article</a>";
            echo "</li>";
            echo '</div>';
            }
    
    
        }


        echo '
          
        </div>
        
      </div>';
        
    }else{
        echo '<p class="p_resultatspour">Aucun résultat pour " '.$inputvalue.' "</p>';
    }
    
}

?>