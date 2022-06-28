<?php

include 'connecttodb.php';

$id = $_POST['id_to_delete'];

$sql = "DELETE FROM actu WHERE actu_id=?";
$stmt= $db->prepare($sql);
$stmt->execute([$id]);

$stmt = $db->prepare("SELECT actusection_filepath FROM actusection WHERE actusection_actuid=?");
$stmt->execute([$id]); 
while ($row = $stmt->fetch()) {
    unlink('actualites_files/'.$row['actusection_filepath']);
}

$sql = "DELETE FROM actusection WHERE actusection_actuid=?";
$stmt= $db->prepare($sql);
$stmt->execute([$id]);

?>