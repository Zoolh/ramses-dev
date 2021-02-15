<?php 	
require_once('infos_session.php');		
if(empty($_SESSION['login'])){
		header('Location: index.php ');
  }

	require('bdd/bdd_include.php');		
?>
<!DOCTYPE html>
<html>
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
  

<style>

	.table-wrapper {
        width: 850px;
        background: #fff;
        padding: 20px 30px 5px;
        margin: 30px auto;
        box-shadow: 0 0 1px 0 rgba(0,0,0,.25);
    }
</style>
<body>



<?php include('entete.php'); ?>



<?php include('navbar.php'); ?>

<nav class="row content">
    <ol class="breadcrumb">
      <li><a href="accueil.php"><span class="sr-only">Home</span><span class="glyphicon glyphicon-home"></span></a></li>
      <li><a href="admin.php">Administration</a></li>
      <li class="active">Gestion des domaines</li> 
    </ol>
  </nav>

<div class="content">

	<div class="col-md-2">
		<?php include('navAdmin.php'); ?>
	</div><!-- FIN DE LA COLONNE-->
  
    <div class="col-md-10" >

    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6"><h2 style="color:white;"><b>Table des </b>Domaines</h2></div>
                <div class="col-sm-6">
                    <div class="btn-group" data-toggle="buttons">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">+</button>
                       
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Domaines</th>
                    <th>Crée le</th>
                    <th>Nbr sous-domaines</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

				
            <?php 

              $sql = "SELECT * FROM domaines ORDER BY id_domaine";
              $result = mysqli_query($bdd, $sql);

              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  $iddomaine=$row['id_domaine'];
                  $nomdomaine=$row['nom_domaine'];
                  $datedomaine=$row['date_domaine'];								
                  
                  /*Nombre de sous-domaines */
                  $sqlCompteur = "SELECT * FROM sous_domaine WHERE id_domaine=$iddomaine";
                  $nbrSsd = mysqli_query($bdd, $sqlCompteur);			


						echo "<tr>
									<td>$iddomaine</td>
									<td>$nomdomaine</td>
									<td>$datedomaine</td>
									<td>$nbrSsd->num_rows</td>
                  <td><a href='#' class='btn btn-sm manage'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a></td>
                  </tr>";
          }
        }

				?>
                
            </tbody>
        </table>
    </div>     

    </div>
    </div>
<?php 	include('modal/modal_creerDomaine.php');
?>
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modifier infos</h4>
      </div>
      <form action="action_creerDomaines.php" METHOD="POST">
      <div class="modal-body">
        <input name="iddomaine" type="text" class="input-sm" id="iddomaine" hidden/>
        <p>Nom du domaine: <input name="nomDomaine" type="text" class="input-sm" id="domaine"/></p>
        <p><input type="button" id="btnSupprimer" class="btn btn-danger" name="rstPwd" value="Supprimer Domaine"></p>
        <p id="demo"></p>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger" id="suppression" name="suppression" style="display: none">Suppression</button>
        <button type="submit" class="btn btn-primary" name="modifier">Sauvegarder</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>
<!-- debut du pied de page -->
<?php include('include_mentions.php'); ?>
<!-- fin pied de page-->
<script>
  $('table tbody tr  td').on('click',function(){
    $("#myModal").modal("show");
    $("#iddomaine").val($(this).closest('tr').children()[0].textContent);
    $("#domaine").val($(this).closest('tr').children()[1].textContent);
});

  $('#btnSupprimer').on('click',function(){

    var txt;
  var r = confirm("Etes-vous sûr de vouloir supprimer ce domaine et toutes ses références?");
  if (r == true) {
    txt = "Vous pouvez supprimer le domaine!";
    $( "#suppression" ).show( "slow" );
    $( "#btnSupprimer" ).hide( "slow" );

  } 
  document.getElementById("demo").innerHTML = txt;
});


	$("#ajoutDomaine").click(function () {
		fieldDomaine = $("#listeDomaines").clone();
		$(fieldDomaine).find("#ajoutDomaine").remove();
		$(fieldDomaine).find("#suppDomaine").removeClass("collapse");
		fieldDomaine.find("input").val("");
		$('#nouveauDomaine').append(fieldDomaine);
	}); 
		
	$("#ajoutSsd").click(function () {
		fieldSsd = $("#listesousdomaines").clone();
		$(fieldSsd).find("#ajoutSsd").remove();
		$(fieldSsd).find("#suppSsd").removeClass("collapse");
		fieldSsd.find("input").val("");
		$('#nouveauSsd').append(fieldSsd);
	}); 
	    
	$(document).on('click', '#suppSsd', function () {
		$(this).closest('#listesousdomaines').remove();
	});
	
	$(document).on('click', '#suppDomaine', function () {
		$(this).closest('#listeDomaines').remove();
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
 



