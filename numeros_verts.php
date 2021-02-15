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
<body>
<?php include('entete.php'); ?>

<?php include('navbar.php'); ?>

<nav class="row content">
    <ol class="breadcrumb">
      <li><a href="accueil.php"><span class="sr-only">Home</span><span class="glyphicon glyphicon-home"></span></a></li>
      <li class="active">Numéros d'urgence</li> 
    </ol>
  </nav>

<div class="content">

    <div class="col">

		<div class="col-md-6 col-md-offset-3" id="sectionAimprimer">
		<div class="row filterable">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-sm-9">
							<h2 style="color:white;"><span class="glyphicon glyphicon-earphone"></span> Numéros d'urgence </h2>
						</div>
            <div class="col-sm-3">
                    <div class="btn-group" data-toggle="buttons">
                        <a href="#" onClick="imprimer('sectionAimprimer')">
                          <label class="btn btn-info " data-toggle="tooltip" data-placement="top" title="Imprimer">
							            <span class="glyphicon glyphicon-print"></span>
                        </label>
                        </a>
 
                    </div>
                </div>
					</div>
				</div>
        <div class="row">

<div class=" col-sm-10 col-sm-offset-1">  
<ul  class="list-group list-group-flush"><b>

      <?php
        $sql = "SELECT * FROM structure WHERE id_structure IN (SELECT DISTINCT id_structure FROM structure_domaine WHERE id_domaine=12)";
        $result = mysqli_query($bdd, $sql);

        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) { 
            $idStr = $row['id_structure'];
            ?>
            

            <li class="list-group-item list-group-item-action"><a target="_blank" style="color:black" href="fichestructure.php?id=<?php echo $idStr;?>"><?php echo ucfirst($row['nom_structure']); ?></a> 
            <?php if(!empty($row['description_structure'])){ ?>
            <br /><small><span class="glyphicon glyphicon-info-sign text-info" ></span> (<?php echo str_split($row['description_structure'], 100)[0];?>)</small>
            <?php } ?>
            
            <?php
						$requeteTel = "SELECT * FROM telephone where id_structure = $idStr";
						$resultTel = mysqli_query($bdd, $requeteTel);
						if ($resultTel->num_rows > 0) {
							while($row2 = $resultTel->fetch_assoc()) {
							  	if(!empty($row2['tel'])){ 

                      if(!empty($row2['detail_tel'])){ ?>
                        <br /><span class="glyphicon glyphicon-earphone" style="color:green;"></span> <?php echo $row2['detail_tel'];?>: <a href="tel:<?php echo $row2['tel'];?>"><?php echo $row2['tel']; ?> </a>
                      <?php }else{ ?>
                          <br /><span class="glyphicon glyphicon-earphone" style="color:green;"></span><a href="tel:<?php echo $row2['tel'];?>"><?php echo ' '.$row2['tel']; ?> </a>

                 <?php }}else{ ?>
                    <br /><span class="glyphicon glyphicon-earphone" style="color:green;"></span> Non renseigné</small>
                
                
                
               <?php  }}}?>           
           
            <?php
                  $requeteUrl = "SELECT * FROM reseaux where id_structure = $idStr";
                  $resultUrl = mysqli_query($bdd, $requeteUrl);
                  if ($resultUrl->num_rows > 0) {
                  while($row2 = $resultUrl->fetch_assoc()) {
                  if(!empty($row2['url'])){ ?>
                    <br /><span class="glyphicon glyphicon-globe" style="color:blue;"></span> <a target="_blank" href="<?php echo $row2['url']; ?>"> <?php echo $row2['url']; ?></a></small>
                  <?php }else{ ?>
                    <br /><span class="glyphicon glyphicon-globe" style="color:blue;"></span> Non renseigné</small>
                
                 <?php }}}?>         
            </li>          
   <?php }
        }
   ?>



</b></ul>

</div>



</div> <!--row-->
      </div>
		</div>     
		</div>    
		</div>
		</div>
<!-- debut du pied de page -->
<?php include('include_mentions.php'); ?>
<!-- fin pied de page-->
<script>
function imprimer(divName) {
      var printContents = document.getElementById(divName).innerHTML;    
   var originalContents = document.body.innerHTML;      
   document.body.innerHTML = printContents;     
   window.print();     
   document.body.innerHTML = originalContents;
   }

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
 



