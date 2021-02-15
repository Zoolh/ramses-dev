<?php
require('infos_session.php');	
if(empty($_SESSION['login'])){
		header('Location: index.php ');
	}
require('bdd/bdd_include.php');		
$dateOjrd = date('y-m-d');


if(isset($_POST['creer']) & isset($_POST['nomDomaine'])){

	
	for($i=0;$i<sizeof($_POST['nomDomaine']);$i++){
		if(!empty($_POST['nomDomaine'][$i])){
            $domaine = $_POST['nomDomaine'][$i];

            /*VERIFIE SI LE DOMAINE EXISTE DEJA AVANT DE LE CREER */
            $requeteVERIF = "SELECT * FROM domaines WHERE nom_domaine = $domaine";
            $resultVERIF = mysqli_query($bdd, $requeteVERIF);
            if ($resultVERIF->num_rows > 0) {
                header('Location: admin_creerDomaines.php?domaineexiste=1');
            }
            /*****************************************************/


            $requete = "INSERT into domaines(nom_domaine,date_domaine) VALUES('$domaine','$dateOjrd')";
            mysqli_query($bdd, $requete);
			$dernier_id=mysqli_insert_id($bdd);
			
			#INSERER LES IMAGES A LACCUEIL
			$requeteImage = "INSERT into images(id_domaine) VALUES('$dernier_id')";
			mysqli_query($bdd, $requeteImage);
			
            $requeteparDefaut="INSERT into sous_domaine(id_domaine,nom_ssd,date_ssd) VALUES('$dernier_id','$domaine','$dateOjrd')";
            mysqli_query($bdd, $requeteparDefaut);

		}
	}
	
	unset($_POST['nomDomaine']);
	header('Location: admin.php');

}


else if(isset($_POST['creerssd']) & isset($_POST['nomssd'])){
	$grandDomaine=$_POST['granddomaine'];

	for($i=0;$i<sizeof($_POST['nomssd']);$i++){
		if(!empty($_POST['nomssd'][$i])){
			$nomssd=$_POST['nomssd'][$i];
			$requete2 = "INSERT into sous_domaine(id_domaine,nom_ssd,date_ssd) VALUES('$grandDomaine','$nomssd','$dateOjrd')";	
			mysqli_query($bdd, $requete2);
		}
	}
	unset($_POST['granddomaine'],$_POST['nomssd']);
	header('Location: admin_creerSsd.php?ssdCreer=1');
}

else if(isset($_POST['modifier']) && !empty($_POST['nomDomaine'])){
	$dom = $_POST['nomDomaine'];
	$iddom = $_POST['iddomaine'];
	mysqli_query($bdd, "UPDATE domaines SET nom_domaine='$dom' WHERE id_domaine='$iddom'");
	
	unset($_POST['nomDomaine']);
	header('Location: admin_creerDomaines.php');

}

else if(isset($_POST['suppression']) && !empty($_POST['iddomaine'])){
	echo $_POST['iddomaine'];
}


else{
	header('Location: admin.php');
}


?>