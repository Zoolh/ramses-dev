<meta charset="utf-8">

<?php 
require('infos_session.php');	
if(empty($_SESSION['login'])){
		header('Location: index.php ');
	}
require('bdd/bdd_include.php');		
include "SimpleXLSX.php";


        
        
        $target_dir = "fileImport/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "Erreur, le fichier n'a pas été importé";
            } else
            {
                
                $monfichier= $target_dir.$_FILES["fileToUpload"]["name"];
                if ($xlsx = SimpleXLSX::parse($monfichier) ) {
                    $i = 0;
                    $memoire="";
                    $continuer=0;
                    foreach ($xlsx->rows() as $elt) {
                    if (!$i == 0){
                        $nomStructure = $elt[0];
                        $dateojrd = date('Y-m-d');

                        if($i>1){
                            if($memoire == $nomStructure){
                                $continuer = 1;
                            }
                            else{
                                $continuer =0;
                            }
                        }
                        
                        $memoire = $elt[0];
                        $description = $elt[1];
                        $cp = $elt[2];
                        $ville = $elt[3];
                        $adresse = $elt[4];
                        $horaires = $elt[5];
                        $tel1 = $elt[6];
                        $infotel1 = $elt[7];
                        $tel2 = $elt[8];
                        $infotel2 = $elt[9];
                        $url1 = $elt[10];
                        $url2 = $elt[11];
                        $mail1 = $elt[12];
                        $mail2 = $elt[13];
                        $domaine = $elt[14];
                        $ssd = $elt[15];
                        $nomContact = $elt[16];
                        $prenomContact = $elt[17];
                        $mailContact = $elt[18];
                        $telContact = $elt[19];
                        $statutContact = $elt[20];
                        
                        
                        if(empty($nomStructure)){
                            break;
                        }
                        if(empty($domaine)){
                            $domaine="Prestations sociales";
                        }
                        if(empty($ssd)){
                            $ssd = $domaine;
                        }
                        /****RECUPERER LE DOMAINE */
                        $sql = "SELECT * from domaines";
                        $result = mysqli_query($bdd, $sql);

                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["nom_domaine"] == $domaine){
                                $iddomaine = $row["id_domaine"];
                            }
                        }	
                        /****RECUPRER LE SSD**/
                        $sql = "SELECT * from sous_domaine ";
                        $result = mysqli_query($bdd, $sql);

                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["nom_ssd"] == $ssd){
                                $idssd = $row["id_ssd"];
                            }
                        }
                        
                        
                        if($continuer==0){ //creer une nouvelle structure
                            $requete = "INSERT INTO structure(id_utilisateur,nom_structure,description_structure,adresse_structure,ville_structure,cp_structure,horaires,date_structure) VALUES('$sessionid','$nomStructure','$description','$adresse','$ville','$cp','$horaires','$dateojrd')";
                            if(!mysqli_query($bdd, $requete)){
                                header('admin_importerStructure.php?erreurImport=1');
                            }	

                            $dernier_id=mysqli_insert_id($bdd);
                            $sqlSsd = "INSERT INTO structure_domaine(id_structure,id_domaine,id_ssd) VALUES('$dernier_id','$iddomaine','$idssd')";
                            mysqli_query($bdd, $sqlSsd);
                                
                                /*Insérer le numéro de téléphone*/
                                if(!empty($tel1)){
                                    $sqlTel = "INSERT INTO telephone(id_structure,tel,detail_tel) VALUES ('".$dernier_id."','".$tel1."','".$infotel1."')";
                                    mysqli_query($bdd, $sqlTel);
                                }
                                if(!empty($tel2)){
                                    $sqlTel2 = "INSERT INTO telephone(id_structure,tel,detail_tel) VALUES ('".$dernier_id."','".$tel2."','".$infotel2."')";
                                   mysqli_query($bdd, $sqlTel2);
                                }
                            
                                /*Inserer les mails*/
                                if(!empty($mail1)){
                                    $sqlMail = "INSERT INTO email(id_structure,email) VALUES ('".$dernier_id."','".$mail1."')";
                                    mysqli_query($bdd, $sqlMail);
                                }
                                if(!empty($mail2)){
                                    $sqlMail2 = "INSERT INTO email(id_structure,email) VALUES ('".$dernier_id."','".$mail2."')";
                                    mysqli_query($bdd, $sqlMail2);
                                }
                                

                                /*Inserer les reseaux*/
                                if(!empty($url1)){
                                    $sqlUrl = "INSERT INTO reseaux(id_structure,url_structure) VALUES ('".$dernier_id."','".$url1."')";
                                    mysqli_query($bdd, $sqlUrl);
                                }
                                if(!empty($url2)){
                                    $sqlUrl2 = "INSERT INTO reseaux(id_structure,url_structure) VALUES ('".$dernier_id."','".$url2."')";
                                   mysqli_query($bdd, $sqlUrl2);
                                }
                        }

                        if($continuer==1){//inserer les domaines dans une structure déjà existante
                            $sqlSsd = "INSERT INTO structure_domaine(id_structure,id_domaine,id_ssd) VALUES('$dernier_id','$iddomaine','$idssd')";
                            mysqli_query($bdd, $sqlSsd);
                        }

                        }     
                    $i++;
                    }
                    if( file_exists ( $monfichier)){
                        unlink( $monfichier );
                     } 
                     $ctest=1;
                     switch ($ctest) {
                        case 1:
                          echo '<script language="javascript">document.location="admin_importerStructure.php?import=1"</script>';
                          break;        
                    }
                }else {
          }

    }
		 } 

?>