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
        border-style:solid; 
border-width: 1px; 
border-color:gainsboro;"
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
      <li class="active">Gestion des utilisateurs</li> 
    </ol>
  </nav>

<div class="content">


	<div class="col-md-2">
		<?php include('navAdmin.php'); ?>
	</div><!-- FIN DE LA COLONNE-->
  
    <div class="col-md-10" >

    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalajouteruser">Ajouter un utilisateur</button>
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-5"><h2 style="color:white;"><b>Utilisateurs</b></h2></div>
                <div class="col-sm-7">
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-info active">
                            <input type="radio" name="status" value="tout" checked="checked"> Tout
                        </label>
                        <label class="btn btn-success">
                            <input type="radio" name="status" value="administrateur"> Administrateur
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="status" value="ag"> Ag
                        </label>
                        <label class="btn btn-warning">
                            <input type="radio" name="status" value="modérateur"> Modérateur
                        </label>
                        <label class="btn btn-danger">
                            <input type="radio" name="status" value="utilisateur"> Utilisateur
                        </label>							
                    </div>
                </div>
            </div>
        </div>
		

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Login</th>
                    <th>Rôle</th>
                    <th>Action</th>
                </tr>
            </thead>
			
			<?php	
      $requeteutilisateur = "SELECT * FROM utilisateur";
      $result = mysqli_query($bdd, $requeteutilisateur);

      if ($result->num_rows > 0) {
        while($donnees = $result->fetch_assoc()) {
          $idutilisateur=$donnees['id_utilisateur'];
          $loginutilisateur=$donnees['login'];
          $prenomutilisateur=$donnees['prenom'];
          $nomutilisateur=$donnees['nom'];
          $idroleuser=$donnees['id_roleuser'];
        
          /*LE ROLE DE L'UTILISATEUR */
          $requeterole = "SELECT nom_role FROM role WHERE id_role=$idroleuser";
          $resultrole = mysqli_query($bdd, $requeterole);

          while($donnees2 = $resultrole -> fetch_assoc()){
            $roleutilisateur=$donnees2['nom_role'];
          }
          /************************/
			?>
            <tbody>
            <?php if($role=="Ag" && $roleutilisateur=="administrateur"){
              continue;
            } else { ?>
                
                <tr  data-status="<?php echo $roleutilisateur; ?>">
                    <td><?php echo $idutilisateur; ?></td>
                    <td><?php echo ucfirst($nomutilisateur); ?></td>
                    <td><?php echo ucfirst($prenomutilisateur); ?></td>
                    <td><?php echo $loginutilisateur; ?></td>
					<?php	

					?>
                    <td>
                      <?php 
                        switch($roleutilisateur){
                          case "administrateur": 
                            $color = "success";
                            break;
                          case "utilisateur":
                              $color = "danger";
                              break; 
                          case "ag":
                              $color = "primary";
                              break;
                          case "modérateur":
                            $color = "warning";
                            break;
                          default:
                            $color = "default";
                        }
                      ?>
                      <span class="label label-<?php echo $color; ?>"><?php echo ucfirst($roleutilisateur); ?> </span>
                      
                      </td>
                    <td><a href="#" class="btn btn-sm manage"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                </tr>
                      <?php } ?>
            </tbody>
			
			<?php } }?>		
        </table>
    </div> 


	</div>
</div>
</div>
</div>
<?php include('modal/modal_creerUtilisateurs.php'); ?>

    </div>
</div>

<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modifier infos</h4>
      </div>
      <form action="action_modifierUser.php" METHOD="POST">
      <div class="modal-body">
        <input name="idUser" type="text" class="input-sm" id="idUser" hidden/>
        <p>NOM: <input name="nom" type="text" class="input-sm" id="nom"/></p>
        <p>PRENOM: <input name="prenom" type="text" class="input-sm" id="prenom"/></p>
        <p>LOGIN: <input name="login" type="text" class="input-sm" id="login"/></p>
        <p>ROLE: 
        <select class="form-control" name="role" id="role" required>
        <option value=''></option>

				<?php 
            $requete3 = "SELECT * FROM role ";
            $reponse3 = mysqli_query($bdd,$requete3);
						while($donnees3 = $reponse3 -> fetch_assoc()){
							$idrole=$donnees3['id_role'];
              $nomrole=$donnees3['nom_role'];
              if($nomrole=="administrateur" && $role=="Ag"){
                  echo "<option value='$idrole' style='display: none;'>",ucfirst($nomrole),"</option>";
                }
                else{
                  echo "<option value='$idrole'>",ucfirst($nomrole),"</option>";
                }
					}
				?>
				</select></p>
        <p><label class="btn btn-warning"><input type="checkbox" name="rstPwd" >RESET MOT DE PASSE</label></p>
        <p><input type="button" class="btn btn-danger" name="rstPwd" value="Supprimer Utilisateur"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="save">Sauvegarder</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    
<!-- debut du pied de page -->
<?php include('include_mentions.php'); ?>
<!-- fin pied de page-->
<script>
  $('table tbody tr  td').on('click',function(){
    $("#myModal").modal("show");
    $("#idUser").val($(this).closest('tr').children()[0].textContent);
    $("#nom").val($(this).closest('tr').children()[1].textContent);
    $("#prenom").val($(this).closest('tr').children()[2].textContent);
    $("#login").val($(this).closest('tr').children()[3].textContent);
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
 


