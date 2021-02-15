

<?php 


function afficheTitre($string){
	$resultat;
	if($string == 'id_utilisateur'){
		$resultat = "Créé par";
	}
	if($string == 'id_structure'){
		$resultat = "ID";
	}
	
	if($string == 'nom_structure'){
		$resultat = "Nom";
	}
	if($string == 'domaine_structure'){
		$resultat = "Domaine";
	}

	if($string == 'sousdomaine_structure'){
		$resultat = "Sous Domaine";
	}
	if($string == 'description_structure'){
		$resultat = "Domaines";
	}
	
	if($string == 'activite_structure'){
		$resultat = "Activité";
	}
	if($string == 'siteweb_structure'){
		$resultat = "URL";
	}
	if($string == 'mail_structure'){
		$resultat = "E-mail";
	}
	if($string == 'horaires'){
		$resultat = "Horaires";
	}
	if($string == 'telephone_structure'){
		$resultat = "Télephone";
	}
	if($string == 'telephone_structure2'){
		$resultat = "Téléphone Secondaire";
	}
	if($string == 'sousdomaine_structure'){
		$resultat = "Sous-Domaine";
	}	
	if($string == 'ville_structure'){
		$resultat = "Ville";
	}	
	if($string == 'cp_structure'){
		$resultat = "Code Postal";
	}	
	if($string == 'date_structure'){
		$resultat = "Date de création";
	}	
	if($string == 'adresse_structure'){
		$resultat = "N°Rue";
	}	



	
	
	return($resultat);
}


?>

</body>
</html>
 

