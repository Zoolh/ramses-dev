<?php
require('infos_session.php');	
if(empty($_SESSION['login'])){
		header('Location: index.php ');
	}
require('bdd/bdd_include.php');		


if(isset($_POST['changer']) & isset($_POST['password1'])){
	$motdepasse = $_POST['password1'];
	mysqli_query($bdd, "UPDATE utilisateur SET mot_de_passe='$motdepasse' WHERE id_utilisateur='$sessionid'");
	
	unset($_POST['password1']);
	header('Location: mesinfos.php?pwdChange=1');

}
header('Location: mesinfos.php');

?>