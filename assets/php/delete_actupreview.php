<?php

include 'connecttodb.php';

$id = $_POST['id_to_delete'];

$sql = "DELETE FROM actu WHERE actu_id=".$id;
$stmt= $db->prepare($sql);
$stmt->execute([$id]);

$sql = "DELETE FROM actusection WHERE actusection_actuid=".$id;
$stmt= $db->prepare($sql);
$stmt->execute([$id]);

?>