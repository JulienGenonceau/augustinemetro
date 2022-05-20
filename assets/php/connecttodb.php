<?php

$host = "109.234.162.106";
$dbname = "naal3419_pres487";
$user = "naal3419";
$pass = "SAuyP6MnIe5t";

try {
    $db = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $pass);
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>