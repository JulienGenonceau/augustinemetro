<?php

echo"<br><br><b>Upload Actualité traitement : </b><br><br>";

var_dump($_POST['id_modif']);
var_dump($_POST['name']);
var_dump($_POST['date_de_sortie']);
var_dump($_POST['show_date']);
var_dump($_POST['list_is_video']);
var_dump($_POST['list_is_image']);
var_dump($_POST['list_filepath']);
var_dump($_POST['list_title']);
var_dump($_POST['list_text']);

$name = $_POST['name'];
$date = date("Y-m-d H:i:s");
$show_date = $_POST['show_date'];
if ($show_date=='true'){$show_date=1;}else{$show_date=0;}

$article_id =  -1;

include 'connecttodb.php';

if ($_POST['id_modif']=="-1"){

  echo"On va ajouter une nouvelle actu"."<br>";;

$sql = "INSERT INTO actu (actu_nom, actu_date, actu_showdate) VALUES (?,?,?)";
$stmt= $db->prepare($sql);
$stmt->execute([$name, $date, $show_date]);

$article_id = $db->lastInsertId();

for ($x = 0; $x <= count($_POST['list_is_video'])-1; $x++) {
    $sql = "INSERT INTO actusection (actusection_actuid, actusection_place, actusection_is_video, actusection_is_image, actusection_filepath, actusection_title, actusection_desc) VALUES (?,?,?,?,?,?,?)";
    $stmt= $db->prepare($sql);

    $is_video = $_POST['list_is_video'][$x];
    if ($is_video=='true'){$is_video=1;}else{$is_video=0;}

    $is_image = $_POST['list_is_image'][$x];
    if ($is_image=='true'){$is_image=1;}else{$is_image=0;}

    $filepath = $_POST['list_filepath'][$x];
    $title = $_POST['list_title'][$x];
    $desc = $_POST['list_text'][$x];

    $stmt->execute([$article_id, $x+1, $is_video, $is_image, $filepath, $title, $desc]);
  }

echo 'Upload Réussi';

}else{
$id_actu = $_POST['id_modif'];


echo"On va modifier l'actu ".$id_actu."<br>";


$sql = "DELETE FROM actusection WHERE actusection_actuid=?";
$stmt= $db->prepare($sql);
$stmt->execute([$id_actu]);

$sql = "UPDATE actu SET actu_nom=?, actu_date=?, actu_showdate=? WHERE actu_id=?";
$stmt= $db->prepare($sql);
$stmt->execute([$name, $date, $show_date, $id_actu]);

for ($x = 0; $x <= count($_POST['list_is_video'])-1; $x++) {
  $sql = "INSERT INTO actusection (actusection_actuid, actusection_place, actusection_is_video, actusection_is_image, actusection_filepath, actusection_title, actusection_desc) VALUES (?,?,?,?,?,?,?)";
  $stmt= $db->prepare($sql);

  $is_video = $_POST['list_is_video'][$x];
  if ($is_video=='true'){$is_video=1;}else{$is_video=0;}

  $is_image = $_POST['list_is_image'][$x];
  if ($is_image=='true'){$is_image=1;}else{$is_image=0;}

  $filepath = $_POST['list_filepath'][$x];
  $title = $_POST['list_title'][$x];
  $desc = $_POST['list_text'][$x];

  $stmt->execute([$id_actu, $x+1, $is_video, $is_image, $filepath, $title, $desc]);
}



echo 'Modifications Réussies';

}
?>