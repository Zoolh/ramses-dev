<?php


require('infos_session.php');	
if(empty($_SESSION['login'])){
		header('Location: index.php ');
	}
require('bdd/bdd_include.php');		


if(isset($_POST['exporter']) & !empty($_POST['exportExcel'])){
    exportMysqlToCsv($_POST['exportExcel'].".csv");
    header('Location: admin_exporter.php?yes=1');
}
else{
	header('Location: admin_exporter.php?err=1');
}



function utf8_encode_mix($input, $encode_keys=false)
{
    if(is_array($input))
    {
        $result = array();
        foreach($input as $k => $v)
        {               
            $key = ($encode_keys)? utf8_encode($k) : $k;
            $result[$key] = utf8_encode_mix( $v, $encode_keys);
        }
    }
    else
    {
        $result = utf8_encode($input);
    }

    return $result;
}


function exportMysqlToCsv($filename)
{
require('bdd/bdd_include.php');		

// Check connection
    if ($bdd->connect_error) {
        die("Connection failed: " . $bdd->connect_error);
    }
    $sql_query = "SELECT DISTINCT(s.nom_structure), sd.id_domaine,d.nom_domaine,ssd.nom_ssd,s.description_structure,s.adresse_structure,s.ville_structure,s.cp_structure,s.horaires,s.date_structure, u.login,r.url_structure,e.email,t.tel,t.detail_tel, c.prenom_contact,c.nom_contact,c.statut_contact,c.mail_contact,c.tel_contact
FROM structure s 
LEFT JOIN utilisateur u 
ON s.id_utilisateur = u.id_utilisateur 
LEFT JOIN structure_domaine sd 
ON s.id_structure = sd.id_structure 
LEFT JOIN domaines d 
ON sd.id_domaine=d.id_domaine 
LEFT JOIN sous_domaine ssd 
ON sd.id_ssd=ssd.id_ssd
LEFT JOIN reseaux r 
ON s.id_structure = r.id_structure
LEFT JOIN email e 
ON s.id_structure = e.id_structure
LEFT JOIN telephone t  
ON s.id_structure = t.id_structure
LEFT JOIN contact c 
ON s.id_structure = c.id_structure";
    // Gets the data from the database
    $result = mysqli_query($bdd,$sql_query);
        header('Content-Encoding: UTF-8');
        header('Content-type: text/csv; charset=UTF-8');
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Length: $size");
        header("Content-type: text/x-csv");
        header("Content-type: text/csv");
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=$filename");

    $f = fopen('php://temp', 'wt');
    $first = true;
    while ($row = $result->fetch_assoc()) {
        if ($first) {
            fputcsv($f, array_keys($row),";");
            $first = false;
        }
		
        fputcsv($f, array_map("utf8_decode", $row), ";");
    } // end while

    $bdd->close();

    $size = ftell($f);
    rewind($f);

    fpassthru($f);
    exit;
}
?>