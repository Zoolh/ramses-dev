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
  


<style type="text/css">

	.table-wrapper {
        width: 850px;
        background: #fff;
        padding: 20px 30px 5px;
        margin: 30px auto;
        box-shadow: 0 0 1px 0 rgba(0,0,0,.25);
    }

</style>
<script type="text/javascript">
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
</script>
</head>
<body>
<?php include('entete.php'); ?>


<?php include('navbar.php'); ?>

<nav class="row content">
    <ol class="breadcrumb">
      <li><a href="accueil.php"><span class="sr-only">Home</span><span class="glyphicon glyphicon-home"></span></a></li>
      <li><a href="admin.php">Administration</a></li>
      <li class="active">Importer des organismes (format Excel)</li> 
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
                <div class="col-sm-12"><h2 style="color:white;"><b>Importer un fichier Excel</b></h2></div>

                </div>
            </div>
            <form action="action_importerStructure.php" method="post" enctype="multipart/form-data">
                Selectionner le fichier EXCEL:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Importer" name="submit">
            </form>
        </div>

    </div> 


	</div>
</div>


<div class="modal fade" id="ok" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Import réussi</h4>
        </div>
        <div class="modal-body">
          <p>Les structures ont bien été importées           <span class="glyphicon glyphicon-ok text-success"></span></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
</div>



    </div>
</div>
<?php 
if($_GET['import']==1){
  echo "<script>$('#ok').modal();</script>";
  
}
?>

<!-- debut du pied de page -->
<?php include('include_mentions.php'); ?>
<!-- fin pied de page-->

<script>

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
 


