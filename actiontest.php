<?php
require('infos_session.php');	
if(empty($_SESSION['login'])){
		header('Location: index.php ');
	}
include('bdd/bdd_include.php');

if(isset($_POST['sauvegarder']) & isset($_POST['nomStructure'])){
	if($_POST['nomStructure']== ''){
		header('Location: creation.php');	
	}
		$dateojrd = date('Y-m-d');
		$nomStructure=mysqli_real_escape_string($bdd,$_POST['nomStructure']);
		$nomDomaine=$_POST['nomDomaine'];
		$nomSsd=$_POST['nomSsd'];
		$adresse=mysqli_real_escape_string($bdd,$_POST['adresse']);
		$ville=mysqli_real_escape_string($bdd,$_POST['ville']);
		$cp=$_POST['cp'];
		$tel=$_POST['tel'];
		$detail=mysqli_real_escape_string($bdd,$_POST['detail']);
		$url=mysqli_real_escape_string($bdd,$_POST['url']);
		$email=mysqli_real_escape_string($bdd,$_POST['email']);
		$description=mysqli_real_escape_string($bdd,$_POST['description']);
		$horaires=$_POST['horaires'];

		$contactnom=$_POST['contactnom'];
		$contactprenom=$_POST['contactprenom'];
		$contactmail=$_POST['contactmail'];
		$contacttel=$_POST['contacttel'];
		$contactposte=$_POST['contactposte'];
		
		/*Créer la base de la structure*/
		$requete = "INSERT INTO structure(id_utilisateur,nom_structure,description_structure,adresse_structure,ville_structure,cp_structure,horaires,date_structure) VALUES('$sessionid','$nomStructure','$description','$adresse','$ville','$cp','$horaires','$dateojrd')";
		echo $requete;
		/*if(!mysqli_query($bdd, $requete)){
			echo mysqli_error($bdd);
		}	*/
		$dernier_id="42";
		

/*
		
		#Insérer les domaines
		for($i=0;$i<sizeof($nomDomaine);$i++){
			$idDudomaine = $nomDomaine[$i];
			
			$requeteParDefaut="SELECT id_ssd FROM sous_domaine WHERE id_domaine = $idDudomaine AND nom_ssd=(SELECT nom_domaine FROM domaines WHERE id_domaine=$idDudomaine)";
			//$resultatDefaut = mysqli_query($bdd, $requeteParDefaut);
            echo $requeteParDefaut;
            while($ligne = mysqli_fetch_array($resultatDefaut)) {
				$idSsdDefaut=$ligne['id_ssd'];
			}			
			$sqlDomaine = "INSERT INTO structure_domaine(id_structure,id_domaine,id_ssd) VALUES($dernier_id,$idDudomaine,$idSsdDefaut)";
			//mysqli_query($bdd, $sqlDomaine);
		}
		*/
        # Insérer les sous-domaines 
        
		for($i=0; $i<sizeof($nomSsd);$i++){
			$leSsd = $nomSsd[$i];
			$requetedomaine = "SELECT id_domaine FROM sous_domaine WHERE id_ssd=$leSsd";
			$reponse = mysqli_query($bdd, $requetedomaine);
			
			while($ligne = mysqli_fetch_array($reponse)) {
				$iddomaine=$ligne['id_domaine'];
			}
			
			$requeteverifier = "SELECT COUNT(*) FROM structure_domaine WHERE id_structure = $dernier_id AND id_domaine=$iddomaine AND id_ssd = $leSsd";
			
			if ($resultat = mysqli_query($bdd, $requeteverifier)) {
				$nbrLignes = mysqli_num_rows($resultat);
				
				if($nbrLignes==0){
					$sqlSsd = "INSERT INTO structure_domaine(id_structure,id_domaine,id_ssd) VALUES($dernier_id,$iddomaine,$leSsd)";
					mysqli_query($bdd, $sqlSsd);
				}
			}
		}	
		
		
		#Insérer le numéro de téléphone
		$nbrTel = sizeof($tel);
		for($i=0; $i<sizeof($tel);$i++){
			$sqlTel = "INSERT INTO telephone(id_structure,tel,detail_tel) VALUES ('".$dernier_id."','".$tel[$i]."','".$detail[$i]."')";
			mysqli_query($bdd, $sqlTel);
		}
		
		#Insérer l'adresse mail
		$nbrEmail = sizeof($email);
		for($y=0; $y<sizeof($email);$y++){
			$sqlMail = "INSERT INTO email(id_structure,email) VALUES ('".$dernier_id."','".$email[$y]."')";
			mysqli_query($bdd, $sqlMail);
		}

		#Insérer les url's
		$nbrUrl = sizeof($url);
		for($z=0; $z<sizeof($url);$z++){
			$sqlUrl = "INSERT INTO reseaux(id_structure,url_structure) VALUES ('".$dernier_id."','".$url[$z]."')";
			mysqli_query($bdd, $sqlUrl);
		}*/
		
		
		/*LA PARTIE CONCERNE LES CONTACTS DE LA STRUCTURE*/
			
		
		$nbrContacts = sizeof($contactprenom);
		for($x=0; $x<$nbrContacts;$x++){
			$sqlContacts = "INSERT INTO contact(nom_contact,prenom_contact,id_structure,mail_contact,tel_contact,statut_contact,id_utilisateur,date_contact)
			VALUES ('".$contactnom[$x]."','".$contactprenom[$x]."','".$dernier_id."','".$contactmail[$x]."','".$contacttel[$x]."','".$contactposte[$x]."','".$sessionid."','".$dateojrd."')";
			//mysqli_query($bdd, $sqlContacts);
		}
		
		/*Les horaires de la structure */

 
		
		/*unset($nomStructure,$nomDomaine,$nomSsd,$url,$email,$tel,
		$adresse,$ville,$cp,$description,$dateojrd,
		$contactmail,$contactnom,$contactposte,$contactprenom,$contacttel,$_POST['sauvegarder']);
		
		header('Location: mes_structures.php');	
}
else{
	header('Location: creation.php');
}*/


?>