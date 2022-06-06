<?php

include 'connecttodb.php';

$stmt = $db->query("SELECT * FROM actu ORDER BY actu_id DESC LIMIT 999");
while ($row = $stmt->fetch()) {
    echo "<div class='actu_crudlist' id='".$row['actu_id']."'>".$row['actu_nom']."</div>";
}
?>