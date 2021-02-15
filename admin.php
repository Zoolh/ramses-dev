<?php 	
require('infos_session.php');		

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



</style>
<body>

<?php include('entete.php'); ?>

<?php include('navbar.php'); ?>

<nav class="row content">
    <ol class="breadcrumb">
      <li><a href="accueil.php"><span class="sr-only">Home</span><span class="glyphicon glyphicon-home"></span></a></li>
      <li class="active">Administration</li> 
    </ol>
  </nav>

<div class="content">

	<div class="col-md-2">
		<?php include('navAdmin.php'); ?>
	</div><!-- FIN DE LA COLONNE-->
  
    <div class="col-md-10" >




    <div class="counter">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-3">
            
                <div class="count-up ">
                    <h3 class="counter-count text-warning">
                      <?php          
                        $result = mysqli_query($bdd, "SELECT * FROM utilisateur");
                        echo $result->num_rows; 
                      ?>
                    </h3>
                    <h3 class="text-warning">Utilisateurs</h3>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="count-up">
                <h3 class="counter-count text-success">
                      <?php          
                        $result = mysqli_query($bdd, "SELECT * FROM structure");
                        echo $result->num_rows; 
                      ?>
                    </h3>
                    <h3 class="text-success">Organismes<h3>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="count-up">
                <h3 class="counter-count text-info">
                      <?php          
                        $result = mysqli_query($bdd, "SELECT * FROM domaines");
                        echo $result->num_rows; 
                      ?>
                    </h3>
                    <h3 class="text-info">Domaines</h3>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="count-up">
                <h3 class="counter-count text-danger">
                      <?php          
                        $result = mysqli_query($bdd, "SELECT * FROM sous_domaine");
                        echo $result->num_rows; 
                      ?>
                    </h3>
                    <h3 class="text-danger">Sous domaines</h3>
                </div>
            </div>


            </div>
            </div>
            </div>

	
			
			
  </div><!-- FIN DE LA COLONNE-->  

</div>
<!-- debut du pied de page -->
<?php include('include_mentions.php'); ?>
<!-- fin pied de page-->
<script>


$('.counter-count').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
          
          //chnage count up speed here
            duration: 1000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });


</script>

</body>
</html>
 



