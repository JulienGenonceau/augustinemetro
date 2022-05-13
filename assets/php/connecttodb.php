<?php

$host = "localhost";
$dbname = "naal3419_0112";
$user = "root";
$pass = "";

try {
    $db = new PDO('mysql:host='.'$host'.';dbname='.$dbname, $user, $pass);
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>