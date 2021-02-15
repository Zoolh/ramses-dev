<?php
require('infos_session.php');	
if(empty($_SESSION['login'])){
		header('Location: index.php ');
	}
require('bdd/bdd_include.php');		


if(isset($_POST['save'])){
	$dom = $_POST['domaine'];
	$idim = $_POST['idimage'];
	$texte = $_POST['texte'];
    $image = $_POST['image'];
    $basename = basename($_FILES["fileToUpload"]["name"]);

    $target_dir = "imagesEtTextes/";
    $target_file = $target_dir . $basename;
  
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        if(!empty($image)){
            unlink($target_dir . $image);
        }
        mysqli_query($bdd, "UPDATE images SET texte_image='$texte',nom_image='$basename' WHERE id_image='$idim'");
        unset($_POST['texte']);
        header('Location: admin_imagesTextes.php');
    }
    else if(isset($image)){
        mysqli_query($bdd, "UPDATE images SET texte_image='$texte' WHERE id_image='$idim'");
        unset($_POST['texte']);
        header('Location: admin_imagesTextes.php');
    }
    else {
        header('Location: admin_imagesTextes.php?err=1');
    }
}
else if(isset($_POST['saveEntete'])){
    #POUR L'IMAGE UN
    if(isset($_FILES['image_un'])){
        $oldimg1 = $_POST['oldimg1'];
        $basename1 = basename($_FILES["image_un"]["name"]);

        $target_dir = "entete/";
        $target_file1 = $target_dir . $basename1;
    
        if (move_uploaded_file($_FILES["image_un"]["tmp_name"], $target_file1)) {
            if(!empty($oldimg1)){
                unlink($target_dir . $oldimg1);
            }
            mysqli_query($bdd, "UPDATE entete SET nom_entete='$basename1' WHERE id_entete='1'");
        }
        header('Location: admin_imagesTextes.php');
    }

    #POUR L'IMAGE DEUX
    if(isset($_FILES['image_deux'])){
        $oldimg2 = $_POST['oldimg2'];
        $basename2 = basename($_FILES["image_deux"]["name"]);

        $target_dir = "entete/";
        $target_file2 = $target_dir . $basename2;
    
        if (move_uploaded_file($_FILES["image_deux"]["tmp_name"], $target_file2)) {
            if(!empty($oldimg2)){
                unlink($target_dir . $oldimg2);
            }
            mysqli_query($bdd, "UPDATE entete SET nom_entete='$basename2' WHERE id_entete='2'");
        }
        header('Location: admin_imagesTextes.php');
    }
}
else if(isset($_POST['saveMention'])) {
    $text = htmlspecialchars($_POST['mention'],ENT_QUOTES);
    if(mysqli_query($bdd, "UPDATE mentions SET texte_mention='$text' WHERE id_mention='1'")){
        header('Location: admin_imagesTextes.php?m=2');
    }
    else{
        echo mysqli_error($bdd);
    }
}

else if(isset($_POST['delete1'])){
    $oldimg1 = $_POST['oldimg1'];
    $target_dir = "entete/";
    if(!empty($oldimg1)){
        unlink($target_dir . $oldimg1);
    }
    mysqli_query($bdd, "UPDATE entete SET nom_entete='' WHERE id_entete='1'");
    header('Location: admin_imagesTextes.php');

}
else if(isset($_POST['delete2'])){
    $oldimg2 = $_POST['oldimg2'];
    $target_dir = "entete/";
    if(!empty($oldimg2)){
        unlink($target_dir . $oldimg2);
    }
    mysqli_query($bdd, "UPDATE entete SET nom_entete='' WHERE id_entete='2'");
    header('Location: admin_imagesTextes.php');

}
else{
header('Location: admin_imagesTextes.php?err=10');
}


?>