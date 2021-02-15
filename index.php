<?php 	
require('bdd/bdd_include.php');		
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/style_accueil.css" media="screen" type="text/css" />
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>	
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<!--couleur de fond: whitesmoke -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/style_accueil.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

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

.navbar .dropdown-menu .form-control {
	width: 200px;
}
	
.test{
  padding-top:20px;
  padding-bottom:20px;
}
.circle {
    background: red;
    border-radius: 200px;
    color: white;
    height: 300px;
    font-weight: bold;
    width: 300px;
    display: table;
    margin: 20px auto;
}
.circle p {
    vertical-align: middle;
    display: table-cell;
}
</style>
<body>


<?php include('entete.php'); ?>



<div id="black" >
    <div class="container">
      <div class="row mt centered ">
	  
	  <!-- Connexion -->
				<form action="action_connexion.php" method="POST">
					  <h3 style="color:orange">Connexion </h3>
					  <hr><br />
					<label> Nom d'utilisateur </label>
						<div class="input-group">
						   <div class="input-group-addon">
							<span class="glyphicon glyphicon-user"></span> 
						   </div>
						  
					   <input type="text" class="form-control" name="login" id="idLogin" autofocus required>
						</div><br />
						<label> Mot de passe </label>
						<div class="input-group">
						   <div class="input-group-addon">
							<span class="glyphicon glyphicon-lock"></span> 
						   </div>
							<input type="password" class="form-control" name="motdepasse" id="idMotDePasse" aria-describedby="mdpo" required>
						</div>
						
						
						<p class="mt"><button type="submit" class="btn btn-lg" style="color:grey; background-color:white;border:1px solid orange;" name="connexion">Se connecter</button></p>
				</form>
			  </div>

	  <!-- fin de  Connexion -->
    </div>
  </div> 
<div class="container">

<?php 
 $sql = "SELECT * FROM images i LEFT JOIN domaines d ON i.id_domaine = d.id_domaine" ;
 $result = mysqli_query($bdd, $sql);
$cpt = 0;
 if ($result->num_rows > 0) {
     while($donnees = $result->fetch_assoc()) {
         $cpt++;
         $domaine=$donnees['nom_domaine'];
         $idimage=$donnees['id_image']; 
         $nomimage=$donnees['nom_image']; 
         $texteimage=$donnees['texte_image']; 

?>
<?php if($cpt%3==1){ 
    echo '<div class="row mt">';
 } ?>
      <div class="col-lg-4 col-md-4 col-xs-12 desc">
        <a class="b-link-fade b-animate-go"><img width="350" height="200"src="imagesEtTextes/<?php echo $nomimage; ?>" alt="" />
					<div class="b-wrapper">
					  	<h4 class="b-from-left b-animate b-delay03"><?php echo $domaine; ?></h4>
					</div>
				</a>
        <p><?php echo $domaine; ?></p>
        <p class="lead"><?php echo $texteimage; ?>
        </p>
        <hr-d>
      </div><!-- col-lg-4 -->
      <?php if($cpt%3==0){ 

      echo '<div class="row mt" >
      </div>'; 
     } ?>

<?php }}?>


</div>
</div>
</div>
</div>
</div>
<div class="jumbotron text-center" style="margin-bottom:0;background-color:whitesmoke;color:#737373;">
<a href="mentionslegales.php">Mentions Légales </a>
</div>
</div>
<!-- /f -->



<script type="text/javascript">
    $(document).ready(function () {
        var url = window.location;
        $('ul.nav a[href="'+ url +'"]').parent().addClass('active');
        $('ul.nav a').filter(function() {
             return this.href == url;
        }).parent().addClass('active');
        
$('.navbar .dropdown').hover(function () {
        $(this).find('.dropdown-menu').first().stop(true, true).slideDown(150);
    }, function () {
        $(this).find('.dropdown-menu').first().stop(true, true).slideUp(105)
    });
});
</script> 

</body>
</html>
 



