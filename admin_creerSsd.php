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

</style>
<body>

<?php include('entete.php'); ?>


<?php include('navbar.php'); ?>

<nav class="row content">
    <ol class="breadcrumb">
      <li><a href="accueil.php"><span class="sr-only">Home</span><span class="glyphicon glyphicon-home"></span></a></li>
      <li><a href="admin.php">Administration</a></li>
      <li class="active">Gestion des sous-domaines</li> 
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
                <div class="col-sm-6"><h2 style="color:white;"><b>Table des </b>Sous-Domaines</h2></div>
                <div class="col-sm-6">
                    <div class="btn-group" data-toggle="buttons">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal2">+</button>
                       
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
            <tr style="background:grey">
            <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-info active">
                            <input type="radio" name="status" value="tout" checked="checked"> Tout
                        </label>
                        <?php $sqlTri = "SELECT * FROM domaines ORDER BY nom_domaine";
                          $resultTri = mysqli_query($bdd, $sqlTri);

                          if ($resultTri->num_rows > 0) {
                            while($row = $resultTri->fetch_assoc()) {
                              $idTriDomaine=$row['id_domaine']; 
                              $nomTriDomaine=$row['nom_domaine']; ?>

                                    <label class="btn btn-default">
                                        <input type="radio" name="status" value="<?php echo $idTriDomaine; ?>"> <?php echo $nomTriDomaine; ?>
                                    </label>
                            <?php }}  ?>
 						
                    </div>
                    </tr>
                <tr>
                    <th>#</th>
                    <th>Sous domaine</th>
                    <th>Crée le</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

				
            <?php 

              $sql = "SELECT * FROM sous_domaine ORDER BY id_ssd";
              $result = mysqli_query($bdd, $sql);

              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  $idssd=$row['id_ssd'];
                  $nomssd=$row['nom_ssd'];
                  $datessd=$row['date_ssd'];								
                  $domaine=$row['id_domaine'];								
                  		
						echo "<tr data-status= $domaine>
									<td>$idssd</td>
									<td>$nomssd</td>
									<td>$datessd</td>
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
<?php include('modal/modal_creerSsd.php'); ?>
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modifier infos</h4>
      </div>
      <form action="action_creerDomaine.php" METHOD="POST">
      <div class="modal-body">
        <input name="idssd" type="text" class="input-sm" id="idssd" hidden/>
        <p>Nom du sous-domaine: <input name="ssd" type="text" class="input-sm" id="ssd"/></p>
        <p><button type="button" id="suppSsd" class="btn btn-danger" name="rstPwd">Supprimer sous-domaine</button></p>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger" id="suppression" name="suppressionSsd" style="display: none">Suppression</button>
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

$('#suppSsd').on('click',function(){
  alert('j k');
  var r = confirm("Etes-vous sûr de vouloir supprimer ce sous-domaine et toutes ses références?");
  if (r == true) {
    var txt;
    txt = "Vous pouvez supprimer le domaine!";
    $( "#suppression" ).show( "slow" );
    $( "#suppSsd" ).hide( "slow" );
    document.getElementById("demo").innerHTML = txt;
  } 

});
  $('table tbody tr  td').on('click',function(){
    $("#myModal").modal("show");
    $("#idssd").val($(this).closest('tr').children()[0].textContent);
    $("#ssd").val($(this).closest('tr').children()[1].textContent);

});


$(document).ready(function(){
	$(".btn-group .btn").click(function(){
		var inputValue = $(this).find("input").val();
		if(inputValue != 'tout'){
			var target = $('table tr[data-status="' + inputValue + '"]');
			$("table tbody tr").not(target).hide();
			target.fadeIn();
		} else {
			$("table tbody tr").fadeIn();
		}
	});
	// Changing the class of status label to support Bootstrap 4
    var bs = $.fn.tooltip.Constructor.VERSION;
    var str = bs.split(".");
    if(str[0] == 4){
        $(".label").each(function(){
        	var classStr = $(this).attr("class");
            var newClassStr = classStr.replace(/label/g, "badge");
            $(this).removeAttr("class").addClass(newClassStr);
        });
    }
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
 



