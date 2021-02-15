<?php
// $bdd = mysqli_connect("db5000587113.hosting-data.io","dbu682947","Ramses-greta78","dbs566381");
$bdd = mysqli_connect("127.0.0.1","root","","dbs566381");

//Vérifier la connexion
if ($bdd -> connect_errno) {
  echo "Failed to connect to MySQL: " . $bdd -> connect_error;
  exit();
}
?>  