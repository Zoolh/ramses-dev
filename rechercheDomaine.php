
<?php 	
require('infos_session.php');		
if(empty($_SESSION['login'])){
		header('Location: index.php ');
	}
require('bdd/bdd_include.php');		

?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/style_accueil.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">

  <!-- Favicons -->
  <link href="img/test.jpg" rel="icon">
  <link href="img/test.jpg" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Ruda:400,900,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animations/animations.css" rel="stylesheet">
  <link href="lib/hover-pack/hover-pack.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/colors/color-74c9be.css" rel="stylesheet">
  

</head>
<style>

.table-wrapper {

background: #fff;
padding: 20px 30px 5px;
box-shadow: 0 0 1px 0 rgba(0,0,0,.25);
border-style:solid; 
border-width: 1px; 
border-color:gainsboro;"
}
.table-title .btn-group {
float: right;
}
.table-title .btn {
min-width: 50px;
border-radius: 2px;
border: none;
padding: 6px 12px;
font-size: 95%;
outline: none !important;
height: 30px;
}
.table-title {
border-bottom: 1px solid #e9e9e9;
padding-bottom: 15px;
margin-bottom: 5px;
background: #1586A4;
margin: -20px -31px 10px;
padding: 15px 30px;
color: #fff;
}
.table-title h2 {
margin: 2px 0 0;
font-size: 24px;
}

table.table td .btn.manage {
padding: 2px 10px;
background: #37BC9B;
color: #fff;
border-radius: 2px;
}

table.table td .btn.manage2 {
padding: 2px 10px;
background: #C9B118;
color: #fff;
border-radius: 2px;
}

table.table td .btn.manage:hover {
background: #2e9c81;		
}

</style>
<body>

<?php include('entete.php'); ?>



<?php include('navbar.php'); ?>

<nav class="row content">
    <ol class="breadcrumb">
      <li><a href="accueil.php"><span class="sr-only">Home</span><span class="glyphicon glyphicon-home"></span></a></li>
      <li class="active">Recherche par domaine</li> 
    </ol>
  </nav>



<div class="content">



<div class="col">

<div class="col-md-6 col-md-offset-3">
<div class="row filterable">
<div class="table-wrapper">
    <div class="table-title">
      <div class="row">
        <div class="col-sm-6">
          <h2 style="color:white;">Recherche par domaine</b></h2>
        </div>
      </div>
    </div>

<hr />
<div class="row">
<div class="col-lg-12 ">
  <div class="row">
    <form method="POST"  >
    <div class="col-sm-4">
    <a data-toggle="collapse" href="#collapse1">Domaines</a>
    <div id="collapse1" class="panel-collapse collapse	">

            <ul class="list-group" multiple="multiple" type="checkbox">
              <select class='form-control' id="domaine" multiple="multiple" name="nomDomaine[]" required>
                <?php
                  $sql = "SELECT * FROM domaines	 ORDER BY nom_domaine";
                  $result = mysqli_query($bdd, $sql);
                  if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      echo "<option id='".$row["id_domaine"]."' value='".$row["id_domaine"]."'>".ucfirst($row["nom_domaine"])."</option>";
                    }
                  }
                ?>
              </select>
            </ul>
            </div>
    </div>
  <div class="col-sm-6">
  <a data-toggle="collapse" href="#collapse2">Sous-domaines</a>
  <div id="collapse2" class="panel-collapse collapse	">

<ul class="list-group">
				  <select class='form-control' id="ssd" multiple="multiple" name="nomSsd[]" size="12">
				  <?php
					$sql = "SELECT nom_domaine,id_domaine FROM domaines WHERE id_domaine IN (SELECT DISTINCT(id_domaine) FROM sous_domaine ORDER BY id_domaine)";
					$result = mysqli_query($bdd, $sql);

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							$nomdudomaine = $row['nom_domaine'];
							$iddudomaine = $row['id_domaine']; 
							echo "<optgroup id='optiontest' label='".htmlspecialchars($nomdudomaine, ENT_QUOTES, 'UTF-8')."' >";
							
							$sqlSsd = "SELECT * FROM sous_domaine WHERE id_domaine=$iddudomaine";
							$resultSsd = mysqli_query($bdd, $sqlSsd);
							
							if($resultSsd -> num_rows > 0){
								while($rowSsd = $resultSsd -> fetch_assoc()){
									echo "<option id =".$rowSsd['id_domaine']." value=".$rowSsd['id_ssd'].">".ucfirst($rowSsd['nom_ssd'])."</option>";
								}
							}
							echo "</optgroup>";
						}
					}
				?>

                </select>
						</ul>
            </div>	
            </div>	
    <div class="col-sm-2">
      <button type="submit" name="rechercher" >Valider</button>

    </div>
    </form>

  </div>
</div>
</div> 
<hr />


</div>
 <!--/row--> </div> 
 <br /> 

 <!-- RECUPERER LE NOM DES FILTRES -->
 <?php 
  $listF = array();
 if(isset($_POST['nomDomaine']) && empty($_POST['nomSsd'])){
 $filtres = "SELECT * FROM domaines";
 $rf = mysqli_query($bdd,$filtres);
 while($donnees = $rf -> fetch_assoc()){
   if(in_array($donnees["id_domaine"],$_POST['nomDomaine'])){
    array_push($listF,$donnees['nom_domaine']);
   }
 }
}

if(!empty($_POST['nomSsd'])){
  $d = array();
  $filtres = "SELECT * FROM sous_domaine";
  $rf = mysqli_query($bdd,$filtres);
  while($donnees = $rf -> fetch_assoc()){
    if(in_array($donnees["id_ssd"],$_POST['nomSsd'])){
     array_push($listF,$donnees['nom_ssd']);
     $idd = $donnees['id_domaine'];
     $nomd = "SELECT nom_domaine FROM domaines WHERE id_domaine=$idd";
     $res = mysqli_query($bdd,$nomd);
     while($elem = $res -> fetch_assoc()){
      array_push($d, $elem['nom_domaine']);
     }
    }
  }

}
 ?>
 <div class="well">
  <h4>Filtres:</h4>
    <?php 
    for($i=0;$i<sizeof($listF);$i++){
      echo $d[$i]."<b>(".$listF[$i].")</b>, ";
    }
    ?>
 </div>
 <!--/row--> </div>     
 <!-- RECUPERER LE NOM DES FILTRES -->


  

       <?php
       if(isset($_POST['rechercher'])){
      
      if(empty($_POST['nomSsd'])){
       $message = "SELECT * FROM structure WHERE id_structure IN (SELECT DISTINCT(id_structure) FROM structure_domaine WHERE id_domaine IN (SELECT id_domaine FROM domaines WHERE id_domaine=10000000 ";
       for($i=0;$i< sizeof($_POST['nomDomaine']);$i++){
          $dom = $_POST['nomDomaine'][$i];
          $message .= " OR id_domaine=$dom";
        }
        $message .= "))";
      }
      else{
        $message = "SELECT * FROM structure WHERE id_structure IN (SELECT id_structure FROM structure_domaine WHERE id_ssd=10000000";
        for($i=0;$i< sizeof($_POST['nomSsd']);$i++){
           $domssd = $_POST['nomSsd'][$i];
           $message .= " OR id_ssd=$domssd";
         }
         $message .= ")";
       }
       $reponse = mysqli_query($bdd,$message);

        ?>
        
<div class="col-md-12">
<div class="row filterable">
  <div class="table-wrapper">
    <div class="table-title">
      <div class="row">
        <div class="col-sm-8">
          <h2 style="color:white"><?php echo $reponse -> num_rows.' résultats';?></h2>
        </div>
        <div class="col-sm-4">
                    <div class="btn-group" >
						<a href="#" onClick="printDiv();">
                          	<label class="btn btn-info " data-toggle="tooltip" data-placement="top" title="Imprimer">
							            <span class="glyphicon glyphicon-print"></span>
                        	</label>
                        </a>


   
                    </div>
                </div>
      </div>
    </div>
    <table id="example" class=" display table table-striped table-hover">
      <thead>
        <tr class="filters">
          <th class="hidden">ID</th>
          <th class='hidden'>Crée par</th>
          <th>Nom</th>
          <th>Tél</th>
          <th>E-mails</th>
          <th>N° rue</th>
          <th>Ville</th>
          <th>Code postal</th>
          <th>Domaines</th>
          <th>Sous-domaines</th>
          <th class='hidden'>Date de création</th>
        </tr>
      </thead>
      <tbody id="DivIdToPrint">
        <?php 
          $requete = $message;
          $reponse = mysqli_query($bdd,$requete);
          if($reponse -> num_rows > 0){
            while($donnees = $reponse -> fetch_assoc()){
            $idstructure=$donnees['id_structure'];
            $idutilisateur=$donnees['id_utilisateur'];

            $requeteUser = "SELECT login FROM utilisateur WHERE id_utilisateur=$idutilisateur";
            $resultatUser=mysqli_query($bdd,$requeteUser);
            while($user = $resultatUser -> fetch_assoc()){
              $nomutilisateur=$user['login'];
            }

            $nomstructure=$donnees['nom_structure'];
            $requeteDomaines="SELECT nom_domaine,id_domaine FROM domaines WHERE id_domaine IN(SELECT DISTINCT(id_domaine) FROM structure_domaine WHERE id_structure=$idstructure)";
            $resultDomaines = mysqli_query($bdd,$requeteDomaines);
            $domaines = array();
            while($dom = $resultDomaines -> fetch_assoc()){
              array_push($domaines, $dom['nom_domaine']);
            }

            $requeteSsd="SELECT nom_ssd FROM sous_domaine WHERE id_ssd IN(SELECT id_ssd FROM structure_domaine WHERE id_structure=$idstructure)";
            $resultSsd = mysqli_query($bdd,$requeteSsd);
            $ssds = array();
            while($ssd = $resultSsd -> fetch_assoc()){
              array_push($ssds, $ssd['nom_ssd']);
            }


            $requeteTel="SELECT tel FROM telephone WHERE id_structure=$idstructure";
            $resultTel = mysqli_query($bdd,$requeteTel);
            $tels = array();
            while($tel = $resultTel -> fetch_assoc()){
              array_push($tels, $tel['tel']);
            }

            $requeteMail="SELECT email FROM email WHERE id_structure=$idstructure";
            $resultMail = mysqli_query($bdd,$requeteMail);
            $emails = array();
            while($email = $resultMail -> fetch_assoc()){
              array_push($emails, $email['email']);
            }

            $adressestructure=$donnees['adresse_structure'];
            $cpstructure=$donnees['cp_structure'];
            $villestructure=$donnees['ville_structure'];
            $datestructure=$donnees['date_structure'];						
            $horairesstructure=$donnees['horaires'];						

?>
          <tr>
                <td class='hidden'><?php echo $idstructure; ?></td>
                <td class='hidden'><?php echo $nomutilisateur; ?></td>
                <td><b><a href='fichestructure.php?id=<?php echo $idstructure; ?>' target='_blank'><?php echo $nomstructure; ?></a></b></td>


                <td><?php for($i=0;$i<sizeof($tels);$i++){
                            if($i==sizeof($tels)-1){
                              echo $tels[$i];
                             }
                            else{
                              echo $tels[$i].'<br />';                }
                              }
                  ?></td>
                <td><?php for($i=0;$i<sizeof($emails);$i++){
                            if($i==sizeof($emails)-1){
                              echo $emails[$i];
                             }
                            else{
                              echo $emails[$i].'<br />';                }
                              }
                  ?></td>
          
              
                <td><?php echo $adressestructure; ?></td>
                <td><?php echo $villestructure; ?></td>
                <td><?php echo $cpstructure; ?></td>
                <td class='hidden'><?php echo $datestructure; ?></td>
                <td><?php for($i=0;$i<sizeof($domaines);$i++){
                            if($i==sizeof($domaines)-1){
                              echo $domaines[$i];
                             }
                            else{
                              echo $domaines[$i].', ';                }
                              }
                  ?></td>
                <td ><?php for($i=0;$i<sizeof($ssds);$i++){
                            if($i==sizeof($ssds)-1){
                              echo $ssds[$i];
                             }
                            else{
                              echo $ssds[$i].', ';                }
                              }
                  ?></td>
                </tr>
                            <?php } } ?>
    </tbody>
    </table>

  </div>     
    </div>

        <?php } ?>
        </div>
        </div>
        </div>
        </div>
        </div>

<!-- debut du pied de page -->
<?php include('include_mentions.php'); ?>
<!-- fin pied de page-->
<script>
	function printDiv(){

var divToPrint=document.getElementById('DivIdToPrint');
var newWin=window.open('','Print-Window');
newWin.document.open();
newWin.document.write('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">'); 
newWin.document.write('<style>@media print {a[href]:after {display: none;visibility: hidden;}}</style>');
newWin.document.write('<html><body onload="window.print()">');
newWin.document.write('<div class="row"><div class="col-md-1"></div><div class=" col-md-10" style="background:white;"><table border="2" class=" table "> ');
newWin.document.write('<th>Nom</th><th>Tél</th><th>E-mails</th><th>N° rue</th><th>Ville</th><th>Code postal</th><th>Domaines</th><th>Sous-domaines</th>');
newWin.document.write(divToPrint.innerHTML);
newWin.document.write('</table></div></div></body></html>');
newWin.document.close();

}
$(document).ready(function() {
		var buttonAdd = $("#add-button");
		var buttonRemove = $("#remove-button");
		var className = ".dynamic-field";
		var count = 0;
		var countUrl = 0;
		var field = "";
		var maxFields = 10;
		
		var fieldMail = "";
		var fieldTel = "";
		var fieldUrl = "";



  function totalReseaux() {
    return $(".class-reseaux").length;
  }
        $("#ajoutMail").click(function () {
			fieldMail = $("#formMail").clone();
			$(fieldMail).find("#ajoutMail").remove();
			$(fieldMail).find("#suppMail").removeClass("collapse");
			fieldMail.find("input").val("");
            $('#nouveauMail').append(fieldMail);
        }); 
		
		$("#ajoutTel").click(function () {
			fieldTel = $("#formTel").clone();
			$(fieldTel).find("#ajoutTel").remove();
			$(fieldTel).find("#suppTel").removeClass("collapse");
			fieldTel.find("input").val("");
            $('#nouveauTel').append(fieldTel);
        }); 
		
		$("#ajoutUrl").click(function () {
			fieldUrl = $("#formUrl").clone();
			countUrl = totalReseaux() + 1;
			fieldUrl.children("label").text("Réseau n°" + countUrl);
			$(fieldUrl).find("#ajoutUrl").remove();
			$(fieldUrl).find("#suppUrl").removeClass("collapse");
			fieldUrl.find("input").val("");
            $('#nouveauUrl').append(fieldUrl);
        });

        //Supprimer un mail, telephone ou url
        $(document).on('click', '#suppMail', function () {
            $(this).closest('#formMail').remove();
        }); 
		$(document).on('click', '#suppTel', function () {
            $(this).closest('#formTel').remove();
        }); 
		$(document).on('click', '#suppUrl', function () {
            $(this).closest('#formUrl').remove();
        });
		


  function totalFields() {
    return $(className).length;
  }

  function addNewField() {
    count = totalFields() + 1;
    field = $("#dynamic-field-1").clone();
    field.attr("id", "dynamic-field-" + count);
    field.children("label").text("Contact " + count);
    field.find("input").val("");
    $(className + ":last").after($(field));
  }

  function removeLastField() {
    if (totalFields() > 1) {
      $(className + ":last").remove();
    }
  }

  function enableButtonRemove() {
    if (totalFields() === 2) {
      buttonRemove.removeAttr("disabled");
      buttonRemove.addClass("shadow-sm");
    }
  }

  function disableButtonRemove() {
    if (totalFields() === 1) {
      buttonRemove.attr("disabled", "disabled");
      buttonRemove.removeClass("shadow-sm");
    }
  }

  function disableButtonAdd() {
    if (totalFields() === maxFields) {
      buttonAdd.attr("disabled", "disabled");
      buttonAdd.removeClass("shadow-sm");
    }
  }

  function enableButtonAdd() {
    if (totalFields() === (maxFields - 1)) {
      buttonAdd.removeAttr("disabled");
      buttonAdd.addClass("shadow-sm");
    }
  }

  buttonAdd.click(function() {
    addNewField();
    enableButtonRemove();
    disableButtonAdd();
  });

  buttonRemove.click(function() {
    removeLastField();
    disableButtonRemove();
    enableButtonAdd();
  });
});

$(document).ready(function() {
   
});
   
$( "#domaine" ).change(function () {
	var tableau = [];
    $( "#domaine option:selected" ).each(function() {
		tableau.push($(this).attr('id'));
    });

    
	$("#ssd option" ).each(function() {
		if( $.inArray($(this).attr('id') , tableau) == -1 ){
			$(this).hide();
			$(this).prop("disabled",true);
		}
		else{
			$(this).show();
			$(this).prop("disabled",false);
			$(this).prop("selected", false);
		}
	});
}).change();

 
$('#domaine').multiselect({
	nonSelectedText: 'Sélectionner un domaine',
	buttonWidth:'100%',
	includeSelectAllOption: true,
	enableFiltering: true,
	enableCaseInsensitiveFiltering: true,
	selectAllText: 'Tout'
});




$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
  
});


window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}




</script>

</body>
</html>
 



