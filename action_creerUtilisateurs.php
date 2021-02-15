<?php
require('infos_session.php');	
if(empty($_SESSION['login'])){
		header('Location: index.php ');
}
require('bdd/bdd_include.php');		


if(isset($_POST['creer']) & isset($_POST['prenomuser']) & isset($_POST['nomuser']) & isset($_POST['loginuser'])){
	$loginUser = $_POST['loginuser'];
	$prenomUser = $_POST['prenomuser'];
	$nomUser = $_POST['nomuser'];
	$idroleUser = $_POST['role'];


	$requete = "INSERT into utilisateur(login,mot_de_passe,prenom,nom,id_roleuser) VALUES('$loginUser','azerty','$prenomUser','$nomUser','$idroleUser')";
	$resultat = mysqli_query($bdd,$requete);

	unset($_POST['loginuser'],$_POST['prenomuser'],$_POST['nomuser'],$_POST['role']);
	header('Location: admin_gererUtilisateurs.php?creerUser=1');

}



else{
	header('Location: admin_gererUtilisateurs.php');
}


?>