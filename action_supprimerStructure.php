<?php
require('infos_session.php');	
if(empty($_SESSION['login'])){
		header('Location: index.php ');
	}
require('bdd/bdd_include.php');		



if(isset($_POST['supprimer']) & isset($_GET['idSas'])){
    $idAs = $_GET['idSas'];
	mysqli_query($bdd,"DELETE FROM contact WHERE id_structure='$idAs'");
    mysqli_query($bdd,"DELETE FROM email WHERE id_structure='$idAs'");
	mysqli_query($bdd,"DELETE FROM reseaux WHERE id_structure='$idAs'");
	mysqli_query($bdd,"DELETE FROM telephone WHERE id_structure='$idAs'");
	mysqli_query($bdd,"DELETE FROM structure_domaine WHERE id_structure='$idAs'");
	mysqli_query($bdd,"DELETE FROM structure WHERE id_structure='$idAs'");

	
	unset($_POST['idSas']);
	header('Location: mes_structures.php?supp=1');
}




else{
	header('Location: admin.php');
}


?>