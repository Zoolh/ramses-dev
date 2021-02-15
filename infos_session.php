<?php
ob_start();
session_start(); 	
if(empty($_SESSION['login'])){
	header('Location: index.php ');
}
include('bdd/bdd_include.php');
$sessionid=$_SESSION['id'];


$sql = "SELECT prenom FROM utilisateur where id_utilisateur = '".$_SESSION['id']."' ";
$result = mysqli_query($bdd, $sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$prenom=ucfirst(strtolower($row['prenom'])) ;
	}
}


$sql = "SELECT nom FROM utilisateur where id_utilisateur = '".$_SESSION['id']."' ";
$result = mysqli_query($bdd, $sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$nom=ucfirst(strtolower($row['nom'])) ;
	}
}

$sql = "SELECT login FROM utilisateur where id_utilisateur = '".$_SESSION['id']."' ";
$result = mysqli_query($bdd, $sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$login=ucfirst(strtolower($row['login'])) ;
	}
}

$sql = "SELECT * FROM role WHERE id_role = (SELECT id_roleuser FROM utilisateur WHERE utilisateur.id_utilisateur = '".$_SESSION['id']."') ";
$result = mysqli_query($bdd, $sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$role=ucfirst(strtolower($row['nom_role'])) ;
		$idrole=ucfirst(strtolower($row['id_role'])) ;
	}
}
$sql = "SELECT count(*),id_utilisateur FROM structure WHERE id_utilisateur = '$sessionid' ";
$result = mysqli_query($bdd, $sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$nbr=$row['count(*)'] ;
	}
}


/*



$requeteid = $bdd->query("SELECT count(*),id_utilisateur FROM structure WHERE id_utilisateur = '$sessionid'");
while($donnees = $requeteid->fetch()){
	$nbr=$donnees['count(*)'];
}

*/
?>