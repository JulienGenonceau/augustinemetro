<?php

 $dbhost = "localhost";
 $dbuser = "naal3419_pres487";
 $dbpass = "7[I)78npS1";
 $dbname = "naal3419_pres487";

 try {
  $db = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser, $dbpass);
} catch (PDOException $e) {
  print "Erreur !: " . $e->getMessage() . "<br/>";
  die();
}
?>