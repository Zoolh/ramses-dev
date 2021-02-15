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

	
	.highlight_row {
    background: red;
}

</style>
<body>

<?php include('entete.php'); ?>

<?php include('navbar.php'); ?>

<nav class="row content">
    <ol class="breadcrumb">
      <li><a href="accueil.php"><span class="sr-only">Home</span><span class="glyphicon glyphicon-home"></span></a></li>
      <li class="active">Mes informations</li> 
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
							<h2 style="color:white;">Mes informations</b></h2>
						</div>
					</div>
				</div>

<hr />
<div class="row">
	<div class="col-lg-12 ">
			<div class="row">
				<div class="col-sm-6">
					<input type="text" class="input-lg form-control" value="<?php echo $prenom; ?>" name="prenom" placeholder="" autocomplete="off" disabled>
				</div>	
				<div class="col-sm-6">
					<input type="text" class="input-lg form-control" value="<?php echo $nom; ?>" name="nom" placeholder="" autocomplete="off" disabled>
				</div><br /><br /><br />
					<div class="col-sm-6">
					<input type="text" class="input-lg form-control" value="<?php echo $login; ?>" name="login"  placeholder="" autocomplete="off" disabled> 
				</div>	
				<div class="col-sm-6">
					<input type="text" class="input-lg form-control" value="<?php echo $role; ?>" name="role" placeholder="" autocomplete="off" disabled>
				</div>
			</div>
	</div>
</div> 
<hr />
<div class="row">
	<div class="col-lg-6 col-lg-offset-3">
		<form method="POST" id="passwordForm" action="action_changerMdp.php">
			<input type="password" class="input-lg form-control" name="password1" id="password1" placeholder="Nouveau mot de passe" autocomplete="off">
			<div class="row">
				<div class="col-lg-6">
					<span id="8char" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span>Au moins 8 caractères<br>
					<span id="ucase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span>Au moins une majuscule
				</div>
				<div class="col-lg-6">
					<span id="lcase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span>Au moins une minuscule<br>
					<span id="num" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span>Au moins un numérique
				</div>
			</div>
			<input type="password" class="input-lg form-control" name="password2" id="password2" placeholder="Répéter le mot de passe" autocomplete="off">
			<div class="row">
				<div class="col-sm-12">
					<span id="pwmatch" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span>Correspondance des mots de passe 
				</div>
			</div>
			<input type="submit" class="col-xs-12 btn btn-primary btn-load btn-lg" name="changer" id="changer" value="Changer de mot de passe" disabled>
		</form>
	</div>
</div>
 
</div>


            <!--/row-->
			</div>     
			</div>    
		</div>
		</div>

<?php 
if(isset($_GET['pwdChange'])){ ?>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-body">
        Votre mot de passe a bien été modifier.
      </div>

    </div>
  </div>
</div>
<?php 
}
?>


<script>
$('#exampleModal').modal({
  show: true
})
$("input[type=password]").keyup(function(){
    var ucase = new RegExp("[A-Z]+");
	var lcase = new RegExp("[a-z]+");
	var num = new RegExp("[0-9]+");
	
	if($("#password1").val().length >= 8){
		$("#8char").removeClass("glyphicon-remove");
		$("#8char").addClass("glyphicon-ok");
		$("#8char").css("color","#00A41E");
	}else{
		$("#8char").removeClass("glyphicon-ok");
		$("#8char").addClass("glyphicon-remove");
		$("#8char").css("color","#FF0004");
	}
	
	if(ucase.test($("#password1").val())){
		$("#ucase").removeClass("glyphicon-remove");
		$("#ucase").addClass("glyphicon-ok");
		$("#ucase").css("color","#00A41E");
	}else{
		$("#ucase").removeClass("glyphicon-ok");
		$("#ucase").addClass("glyphicon-remove");
		$("#ucase").css("color","#FF0004");
	}
	
	if(lcase.test($("#password1").val())){
		$("#lcase").removeClass("glyphicon-remove");
		$("#lcase").addClass("glyphicon-ok");
		$("#lcase").css("color","#00A41E");
	}else{
		$("#lcase").removeClass("glyphicon-ok");
		$("#lcase").addClass("glyphicon-remove");
		$("#lcase").css("color","#FF0004");
	}
	
	if(num.test($("#password1").val())){
		$("#num").removeClass("glyphicon-remove");
		$("#num").addClass("glyphicon-ok");
		$("#num").css("color","#00A41E");
	}else{
		$("#num").removeClass("glyphicon-ok");
		$("#num").addClass("glyphicon-remove");
		$("#num").css("color","#FF0004");
	}
	
	if($("#password1").val() == $("#password2").val()){
		$("#pwmatch").removeClass("glyphicon-remove");
		$("#pwmatch").addClass("glyphicon-ok");
		$("#pwmatch").css("color","#00A41E");
	}else{
		$("#pwmatch").removeClass("glyphicon-ok");
		$("#pwmatch").addClass("glyphicon-remove");
		$("#pwmatch").css("color","#FF0004");
	}
	
	if($("#password1").val() == $("#password2").val() &&num.test($("#password1").val()) && lcase.test($("#password1").val()) && ucase.test($("#password1").val()) && $("#password1").val().length >= 8){
		$("#changer").prop("disabled",false);	
	}
	else{
		$("#changer").prop("disabled",true);	
	
	}
});



</script>

</body>
</html>
 



