<?php
require('infos_session.php');	
if(empty($_SESSION['login'])){
		header('Location: index.php ');
}
require('bdd/bdd_include.php');		


if(isset($_POST['save'])){
	$loginUser = $_POST['login'];
	$prenomUser = $_POST['prenom'];
	$nomUser = $_POST['nom'];
    $idroleUser = $_POST['role'];
    $idUser = $_POST['idUser'];


	$requete = "UPDATE utilisateur SET nom='$nomUser', prenom='$prenomUser', login='$loginUser', id_roleuser='$idroleUser' WHERE id_utilisateur='$idUser'";
	mysqli_query($bdd,$requete);

    if(isset($_POST['rstPwd'])){
        $requete2 = "UPDATE utilisateur SET mot_de_passe='azerty' WHERE id_utilisateur='$idUser'";
        mysqli_query($bdd,$requete2);     
    }
	unset($_POST['login'],$_POST['prenom'],$_POST['nom'],$_POST['role']);
	header('Location: admin_gererUtilisateurs.php?change=1');

}



else{
	header('Location: admin_gererUtilisateurs.php');
}


?>