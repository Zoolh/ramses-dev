
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

<body>

<?php include('entete.php'); ?>



<?php include('navbar.php'); ?>

<nav class="row content">
    <ol class="breadcrumb">
      <li><a href="accueil.php"><span class="sr-only">Home</span><span class="glyphicon glyphicon-home"></span></a></li>
      <li class="active">Recherche par département</li> 
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
          <h2 style="color:white;">Recherche par département</b></h2>
        </div>
      </div>
    </div>

<hr />
<div class="row">
<div class="col-lg-12 ">
  <div class="row">
    <form method="POST"  >
  <div class="col-sm-10">
  <ul class="list-group" multiple="multiple" type="checkbox">
              <select class='form-control' id="domaine" multiple="multiple" name="departements[]" required>
<option value="00">(00) Hors France</option>
<option value="01">(01) Ain </option>
<option value="02">(02) Aisne </option>
<option value="03">(03) Allier </option>
<option value="04">(04) Alpes de Haute Provence </option>
<option value="05">(05) Hautes Alpes </option>
<option value="06">(06) Alpes Maritimes </option>
<option value="07">(07) Ardèche </option>
<option value="08">(08) Ardennes </option>
<option value="09">(09) Ariège </option>
<option value="10">(10) Aube </option>
<option value="11">(11) Aude </option>
<option value="12">(12) Aveyron </option>
<option value="13">(13) Bouches du Rhône </option>
<option value="14">(14) Calvados </option>
<option value="15">(15) Cantal </option>
<option value="16">(16) Charente </option>
<option value="17">(17) Charente Maritime </option>
<option value="18">(18) Cher </option>
<option value="19">(19) Corrèze </option>
<!-- <option value="2A">(2A) Corse du Sud </option>
<option value="2B">(2B) Haute-Corse </option>-->
<option value="21">(21) Côte d'Or </option>
<option value="22">(22) Côtes d'Armor </option>
<option value="23">(23) Creuse </option>
<option value="24">(24) Dordogne </option>
<option value="25">(25) Doubs </option>
<option value="26">(26) Drôme </option>
<option value="27">(27) Eure </option>
<option value="28">(28) Eure et Loir </option>
<option value="29">(29) Finistère </option>
<option value="30">(30) Gard </option>
<option value="31">(31) Haute Garonne </option>
<option value="32">(32) Gers </option>
<option value="33">(33) Gironde </option>
<option value="34">(34) Hérault </option>
<option value="35">(35) Ille et Vilaine </option>
<option value="36">(36) Indre </option>
<option value="37">(37) Indre et Loire </option>
<option value="38">(38) Isère </option>
<option value="39">(39) Jura </option>
<option value="40">(40) Landes </option>
<option value="41">(41) Loir et Cher </option>
<option value="42">(42) Loire </option>
<option value="43">(43) Haute Loire </option>
<option value="44">(44) Loire Atlantique </option>
<option value="45">(45) Loiret </option>
<option value="46">(46) Lot </option>
<option value="47">(47) Lot et Garonne </option>
<option value="48">(48) Lozère </option>
<option value="49">(49) Maine et Loire </option>
<option value="50">(50) Manche </option>
<option value="51">(51) Marne </option>
<option value="52">(52) Haute Marne </option>
<option value="53">(53) Mayenne </option>
<option value="54">(54) Meurthe et Moselle </option>
<option value="55">(55) Meuse </option>
<option value="56">(56) Morbihan </option>
<option value="57">(57) Moselle </option>
<option value="58">(58) Nièvre </option>
<option value="59">(59) Nord </option>
<option value="60">(60) Oise </option>
<option value="61">(61) Orne </option>
<option value="62">(62) Pas de Calais </option>
<option value="63">(63) Puy de Dôme </option>
<option value="64">(64) Pyrénées Atlantiques </option>
<option value="65">(65) Hautes Pyrénées </option>
<option value="66">(66) Pyrénées Orientales </option>
<option value="67">(67) Bas Rhin </option>
<option value="68">(68) Haut Rhin </option>
<option value="69">(69) Rhône </option>
<option value="70">(70) Haute Saône </option>
<option value="71">(71) Saône et Loire </option>
<option value="72">(72) Sarthe </option>
<option value="73">(73) Savoie </option>
<option value="74">(74) Haute Savoie </option>
<option value="75">(75) Paris </option>
<option value="76">(76) Seine Maritime </option>
<option value="77">(77) Seine et Marne </option>
<option value="78">(78) Yvelines </option>
<option value="79">(79) Deux Sèvres </option>
<option value="80">(80) Somme </option>
<option value="81">(81) Tarn </option>
<option value="82">(82) Tarn et Garonne </option>
<option value="83">(83) Var </option>
<option value="84">(84) Vaucluse </option>
<option value="85">(85) Vendée </option>
<option value="86">(86) Vienne </option>
<option value="87">(87) Haute Vienne </option>
<option value="88">(88) Vosges </option>
<option value="89">(89) Yonne </option>
<option value="90">(90) Territoire de Belfort </option>
<option value="91">(91) Essonne </option>
<option value="92">(92) Hauts de Seine </option>
<option value="93">(93) Seine Saint Denis </option>
<option value="94">(94) Val de Marne </option>
<option value="95">(95) Val d'Oise </option>
<!--<option value="971">(971) Guadeloupe </option>
<option value="972">(972) Martinique </option>
<option value="973">(973) Guyane </option>
<option value="974">(974) Réunion </option>
<option value="975">(975) Saint Pierre et Miquelon </option>
<option value="976">(976) Mayotte </option>-->

              </select>
            </ul>
    </div>	
    <div class="col-sm-2">
      <button type="submit" name="rechercher" ><span class="glyphicon glyphicon-search"></span></button>

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
 <div class="well">
  <h4>Filtres:</h4>
    <?php 
        if(isset($_POST['rechercher'])){
        for($i=0; $i<sizeof($_POST['departements']);$i++){
          echo "<span class='label label-primary'>".$_POST['departements'][$i]."</span> ";
        }
    ?>
 </div>
 <!--/row--> </div>     
 <!-- RECUPERER LE NOM DES FILTRES -->


  

       <?php
      
      $message = "SELECT * FROM structure WHERE SUBSTR(cp_structure,1,2)=99 ";
      for($i=0;$i< sizeof($_POST['departements']);$i++){
         $dpt = $_POST['departements'][$i];
         $message .= " OR SUBSTR(cp_structure,1,2)=$dpt";
       }
       $message .= " ORDER BY ville_structure";

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
          <th column-width: 60px;>Sous-domaines</th>
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
	nonSelectedText: 'Sélectionner un département',
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
 



