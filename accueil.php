<?php 	

ob_start();
if(!isset($_SESSION)){
  session_start();
}


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
.ch-grid {
	padding: 0;
	list-style: none;
	display: block;
	text-align: center;
  vertical-align: middle;
	width: 100%;
}



.ch-grid:after {
	clear: both;
}

.ch-grid li {
	width: 220px;
	height: 220px;
	display: inline-block;
	margin: 50px;
}
.ch-item {
	width: 100%;
	height: 100%;
	border-radius: 50%;
	overflow: hidden;
	cursor: default;
	box-shadow: 
		inset 0 0 0 16px rgba(255,255,255,0.6),
		0 1px 2px rgba(0,0,0,0.1);
	transition: all 0.4s ease-in-out;
}

.ch-info{
  padding: 30% 0;
}

.ch-info h3{
  color:white;
}
.ch-item:hover {
	box-shadow: 
		inset 0 0 0 1px rgba(255,255,255,0.1),
		0 1px 2px rgba(0,0,0,0.1);
}
.ch-item:hover .ch-info {
	transform: scale(1);
	opacity: 1;
}
.ch-item:hover .ch-info p {
	opacity: 1;
}


</style>
<body>


<?php include('entete.php'); ?>

<?php include('navbar.php'); ?>

<div class="content" style="background-color:white;">
<!-- <header>
  <h1>Que voulez-vous faire <?php echo $prenom;?> ?</h1>
</header> -->

<div class="row test" style="background:whitesmoke;  margin:10px 10px 10px 10px;">
<ul class="ch-grid">
<?php if($role!='Utilisateur'){ ?>

	<li>
		<div class="ch-item ch-img-1" style="background:#1586A4;">
			<div class="ch-info">
      <a href="creation.php"><h3>Création</h3></a>
			</div>
		</div>
	</li>
  <?php } ?>

	<li>
		<div class="ch-item ch-img-2" style="background:#E83385;">
			<div class="ch-info">
				<a href="recherche.php"><h3>Recherche</h3></a>
			</div>
		</div>
	</li>
	<li>
		<div class="ch-item ch-img-3" style="background:#F39300;">
			<div class="ch-info">
      <a href="numeros_verts.php"><h3>Numéros <br />verts</h3></a>
			</div>
		</div>
	</li>
</ul>
    </div>

    <?php
$requeteSsd="SELECT * FROM email";
$resultSsd = mysqli_query($bdd,$requeteSsd);
while($donnees = $resultSsd->fetch_assoc()) {
  echo $donnees['email'].' '.$donnees['id_structure'].'<br />';

}
?>

    <!-- /row -->

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
        echo '<div class="row mt" >'; 
      }?>
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
      </div>';       }?>
<?php }}?>


</div>
</div>
</div>
</div>
</div>
</div>
<!-- /f -->
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
 



