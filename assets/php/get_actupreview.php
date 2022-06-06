<?php

include 'connecttodb.php';

if (isset($_POST['offset'])){

$stmt = $db->query("SELECT * FROM actu ORDER BY actu_id DESC LIMIT 1 OFFSET ".$_POST['offset']);
while ($row = $stmt->fetch()) {
    echo "<a class='actu_box' href='actualites?actuid=".$row['actu_id']."'>";

    
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
}

?>