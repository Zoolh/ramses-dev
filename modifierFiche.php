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

</style>
<body>
<?php
$idS = $_GET['id'];
?>
<?php include('entete.php'); ?>



<?php include('navbar.php'); ?>

<nav class="row content">
    <ol class="breadcrumb">
      <li><a href="accueil.php"><span class="sr-only">Home</span><span class="glyphicon glyphicon-home"></span></a></li>
      <li class="active">Modifier organisme</li> 
    </ol>
  </nav>



<div class="content">

<div class="container" style="background:white;">


  <!-- Row start -->
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
		<div class="table-title">
            <div class="row">
                <div class="col-sm-12"><h3 style="color:white;"><b>Modifier organisme</b></h3></div>
            </div>
        </div>
        </div>
       
        <div class="panel-body">
          <form class="form-horizontal row-border" method="POST" action="#">


            <div class="form-group">
              <label class="col-md-2 control-label">Nom de l'organisme</label>
              <div class="col-md-10">
                <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
				<input id="nomStructure" name="nomStructure" placeholder="" class="form-control "  value="<?php echo infosStructures($idS,$bdd)[0]; ?>" type="text" >
				</div>
              </div>
            </div>
			
			
            <div class="form-group">
			              <label class="col-md-2 control-label"></label>

              <div class="col-md-5">

				<div class="panel-group">
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h4 class="panel-title">
						  <a data-toggle="collapse" href="#collapse">Domaines</a>
						</h4>
					  </div>
					  <div id="collapse" class="panel-collapse collapse	">
						<ul class="list-group" multiple="multiple" type="checkbox">
										 <select class='form-control' id="domaine" multiple="multiple" name="nomDomaine[]">
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
              </div> 
              </div> 
			  <div class="col-md-5">
				<div class="panel-group">
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h4 class="panel-title">
						  <a data-toggle="collapse" href="#collapse2">Sous-domaines</a>
						</h4>
					  </div>
					  <div id="collapse2" class="panel-collapse collapse	">
						<ul class="list-group">
				  <select class='form-control' id="ssd" multiple="multiple" name="nomSsd[]" size="7">
				  <?php
					$sql = "SELECT nom_domaine,id_domaine FROM domaines WHERE id_domaine IN (SELECT DISTINCT(id_domaine) FROM sous_domaine ORDER BY id_domaine)";
					$result = mysqli_query($bdd, $sql);

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							$nomdudomaine = $row['nom_domaine'];
							$iddudomaine = $row['id_domaine'];
							echo "<optgroup label='".htmlspecialchars($nomdudomaine, ENT_QUOTES)."'>";
							
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
				  </div>				
              </div>
            </div>
			
			
           
			
			<div class="form-group">
              <label class="col-md-2 control-label">Adresse</label>
              <div class="col-md-10">
                <div class="row">
                  <div class="col-xs-5">
					  <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
						<input type="text" name="adresse" value="<?php echo infosStructures($_GET['id'],$bdd)[2]; ?>" class="form-control" placeholder="N° Rue">
					  </div>
                  </div>
                  <div class="col-xs-4">
					  <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
						<input type="text" name="ville" value="<?php echo infosStructures($_GET['id'],$bdd)[3]; ?>" class="form-control" placeholder="Ville">
					  </div>
                  </div>
                  <div class="col-xs-3">
					  <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
						<input type="text" name="cp" value="<?php echo infosStructures($_GET['id'],$bdd)[4]; ?>" class="form-control" placeholder="Code Postal">
					  </div>
                  </div>
                </div>
              </div>
            </div>
			<hr />
			
			 <div class="form-group">
				<div id="formMail">

				<label class="col-md-2 col-lg-2  control-label">E-mail(s)</label>
				<?php for($i=0; $i<sizeof(mailStructure($_GET['id'],$bdd));$i++){
						if($i%2==0){
					?>

				<div class="col-md-7 col-lg-7" >
					<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
						
                        <input type="text" name="email[]" value="<?php echo mailStructure($_GET['id'],$bdd)[$i]; ?>" class="form-control" placeholder="Adresse E-Mail">
					</div>
                </div>
				<div class="col-md-3 col-lg-3 " >
                    <button id="suppMail" type="button" class="btn btn-danger collapse">-</button>
					<button id="ajoutMail" type="button" class="btn btn-primary">+</button>
				</div> 
				<div class="col-md-10 col-lg-10" >
				</div>
				<?php }} ?>

			 </div>
			 <div id="nouveauMail"></div>				
			 </div>


			 <div class="form-group">
				<div id="formTel">

				<label class="col-md-2 control-label">Téléphone(s)</label>
				<div class="col-md-4 " >
					<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
						<input type="text" name="tel[]" value="<?php print_r(telStructure($_GET['id'],$bdd)); ?>" class="form-control" placeholder="Numéro de téléphone">
					</div>
                </div>	
				<div class="col-md-2 " >
					<input type="text" name="detail[]" class="form-control" placeholder="Information">
                </div>
				<div class="col-md-4 " >
                    <button id="suppTel" type="button" class="btn btn-danger collapse">-</button>
					<button id="ajoutTel" type="button" class="btn btn-primary">+</button>
				</div> 
			 <div id="nouveauTel"></div>				
			 </div>
			 </div>


		
			 
			 

			 <div class="form-group">
              <label class="col-md-2 control-label">Horaires</label>
              <div class="col-md-10">
			  				<textarea class="form-control" rows="3" id="comment" name="horaires"><?php echo infosStructures($_GET['id'],$bdd)[5]; ?></textarea>
              </div>
            </div>

			 <div class="form-group">
				<div id="formUrl" class="class-reseaux">

				<label class="col-md-2 control-label ">Réseaux</label>
				<div class="col-md-8 " >
					<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
						<input type="text" name="url[]" class="form-control" placeholder="https://www.exempledereseaux.com">
					</div>
                </div>
				<div class="col-md-2 " >
                    <button id="suppUrl" type="button" class="btn btn-danger collapse">-</button>
					<button id="ajoutUrl" type="button" class="btn btn-primary">+</button>
				</div> 
			 </div>
			 <div id="nouveauUrl"></div>				
			 </div>

            
            <div class="form-group">
              <label class="col-md-2 control-label has-success">Description</label>
              <div class="col-md-10">
				<textarea class="form-control" rows="5" id="comment" name="description"><?php echo infosStructures($_GET['id'],$bdd)[1]; ?></textarea>
				<span class="help-block" style="color:red">Aucune information confidentielle ne doit être mentionnée!</span>
              </div>
            </div>
			<hr />
			
			<div class="clearfix mt-4">
              <button type="button" id="add-button" class="btn btn-primary float-left text-uppercase shadow-sm"> Ajouter un contact</button>
              <button type="button" id="remove-button" class="btn btn-danger float-left text-uppercase ml-1" disabled="disabled"><i class="fas fa-minus fa-fw"></i> Supprimer contact</button>
            </div><br/>
			<div id="dynamic-field-1" class="form-group dynamic-field">
              <label for="field" class="font-weight-bold col-md-2 control-label">Contact</label>
			  <div class="col-md-10">
					<div class="row">
						<div class="col-xs-2" >
							<input type="text" id="field" class="form-control" name="contactprenom[]" placeholder="Prénom" />
						</div>
						<div class="col-xs-2" >
							<input type="text" id="field" class="form-control" name="contactnom[]" placeholder="Nom" />
						</div>
						<div class="col-xs-3" >
							<input type="text" id="field" class="form-control" name="contactmail[]" placeholder="Adressemail@mail.com" />
						</div>
						<div class="col-xs-2" >
							<input type="text" id="field" class="form-control" name="contacttel[]" placeholder="06.06.06.06.06" />
						</div>
						<div class="col-xs-2" >
							<input type="text" id="field" class="form-control" name="contactposte[]" placeholder="Statut" />
						</div>
					</div>
				</div>
			  
            </div>
			
			<hr />
			
			<input style="float:right" type="submit" class="btn btn-success" name="sauvegarder" value="Sauvegarder"/> 

          </form>
        </div>
        </div>
      </div>
    </div>
  </div>
  </div>
<!-- debut du pied de page -->
<?php include('include_mentions.php'); ?>
<!-- fin pied de page-->
<?php
#RECUPERER LES INFOS D'UNE STRUCTURE 
function infosStructures($idStructure,$bdd){
	$sqlInfo = "SELECT * FROM structure WHERE id_structure=$idStructure";
	$resultInfo = mysqli_query($bdd, $sqlInfo);
	if ($resultInfo->num_rows > 0) {
		while($row = $resultInfo->fetch_assoc()) {
			$infos = array($row['nom_structure'],$row['description_structure'],$row['adresse_structure'],$row['ville_structure'],$row['cp_structure'],$row['horaires']) ;
		}
	}
	return $infos;
}

function mailStructure($idStructure,$bdd){
    $emails = array();
	$sqlInfo = "SELECT * FROM email WHERE id_structure=$idStructure";
	$resultInfo = mysqli_query($bdd, $sqlInfo);
	if ($resultInfo->num_rows > 0) {
		while($row = $resultInfo->fetch_assoc()) {
            array_push($emails,$row['email'],$row['id_email_structure']);
        }
	}
	return $emails;
}

function telStructure($idStructure,$bdd){
    $emails = array();
	$sqlInfo = "SELECT * FROM telephone WHERE id_structure=$idStructure";
	$resultInfo = mysqli_query($bdd, $sqlInfo);
	if ($resultInfo->num_rows > 0) {
		while($row = $resultInfo->fetch_assoc()) {
            $emails[$row['id_telephone_structure']]=$row['tel'];
        }
	}
	return $emails;
}
?>
<script>
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
 



