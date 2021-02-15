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

</head>
<body>

<?php include('entete.php'); ?>



<?php include('navbar.php'); ?>

<nav class="row content">
    <ol class="breadcrumb">
      <li><a href="accueil.php"><span class="sr-only">Home</span><span class="glyphicon glyphicon-home"></span></a></li>
      <li><a href="admin.php">Administration</a></li>
      <li class="active">Images et textes</li> 
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
                <div class="col-sm-12"><h2 style="color:white;"><b>Images et Textes</b></h2></div>
            </div>
        </div>
        <div class="cutlist">
        <table class="table table-striped table-hover images">
            <thead>
                <tr>
                    <th class="hidden">ID</th>
                    <th>Domaine</th>
                    <th>Texte</th>
                    <th>Image</th>

                </tr>
            </thead>
            <tbody>
			<?php	
              $sql = "SELECT * FROM images i LEFT JOIN domaines d ON i.id_domaine = d.id_domaine" ;
              $result = mysqli_query($bdd, $sql);
  
              if ($result->num_rows > 0) {
                  while($donnees = $result->fetch_assoc()) {
                      $domaine=$donnees['nom_domaine'];
                      $idimage=$donnees['id_image']; 
                      $nomimage=$donnees['nom_image']; 
                      $texteimage=$donnees['texte_image']; 
			?>

                <tr>
                    <td class="hidden"><?php echo $idimage; ?></td>
                    <td><?php echo $domaine; ?></td>
                    <td><?php echo $texteimage; ?></td>
                    <td><?php echo $nomimage; ?></td>
                </tr>
			
			<?php } }?>	
            </tbody>	
        </table>
        </div> <!--div cutlist -->
        </div>


        <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-10"><h2 style="color:white;"><b>En-tête</b></h2></div>
                <div class="col-sm-2"><a href="#" data-toggle="modal" data-target="#myEntete"><input type="button" class="btn btn-primary" value="+"/></a></div>
            </div>
        </div>  

        <table class="table table-striped table-hover entete">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image Entête</th>

                </tr>
            </thead>
            <tbody>
                <?php	
              $sql = "SELECT * FROM entete ORDER BY id_entete" ;
              $result = mysqli_query($bdd, $sql);

              if ($result->num_rows > 0) {
                  while($donnees = $result->fetch_assoc()) {
                    $nomEntete=$donnees['nom_entete'];
                    $idEntete=$donnees['id_entete'];                
           ?>
                <tr>
                    <td><?php echo 'Entete '.$idEntete; ?></td>
                    <td><?php echo $nomEntete; ?></td>
                </tr>
                  <?php 
                    }
                  }
			        ?>
            </tbody>	
        </table>
        </div>

    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-10"><h2 style="color:white;"><b>Mentions Légales</b></h2></div>
                <div class="col-sm-2"><a href="#" data-toggle="modal" data-target="#mentions"><input type="button" class="btn btn-primary" value="+"/></a></div>
            </div>
        </div>  

        </div>
    </div> <!-- end div wrapper-->

	</div>
</div>
</div>
</div>

    </div>
</div>
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modifier infos</h4>
      </div>
      <form action="action_images.php" METHOD="POST" enctype="multipart/form-data">
      <div class="modal-body">
        <input name="idimage" type="text" class="input-sm" id="idimage" hidden/>
        <p>DOMAINE: <input name="domaine" type="text" class="input-sm" id="domaine" readonly/></p>
        <p>TEXTE: <textarea name="texte" type="text" class="input-sm" id="texte"></textarea></p>
        <p>IMAGE: <input name="image" type="text" class="input-sm" id="image" readonly/></p>
        <p><input name="fileToUpload" type="file" class="input-sm" id="newImg" accept="image/x-png,image/jpeg,image/jpg" /></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="save">Sauvegarder</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

  <div class="modal fade" id="myEntete">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modifier En-tête</h4>
      </div>
      <form action="action_images.php" METHOD="POST" enctype="multipart/form-data">
      <div class="modal-body">
      <div class="row">
      <?php	
              $sql = "SELECT * FROM entete ORDER BY id_entete" ;
              $result = mysqli_query($bdd, $sql);

              if ($result->num_rows > 0) {
                  while($donnees = $result->fetch_assoc()) {
                    $nomEntete=$donnees['nom_entete'];
                    $idEntete=$donnees['id_entete'];              
           ?>
          <?php if($idEntete==1){ ?>
          <div class="col-sm-6">
            <p>Image 1:</p>
            <p><input name="image_un" type="file" class="input-sm" id="newImg" accept="image/x-png,image/jpeg,image/jpg" /></p>
            <p><input name="oldimg1" type="text" class="input-sm" id="image" value="<?php echo $nomEntete; ?>" readonly/><button type="submit" class="btn btn-danger" name="delete1">X</button></p>
          </div>
          <?php } ?>
          <?php if($idEntete==2){ ?>
          <div class="col-sm-6">
            <p>Image 2:</p>
            <p><input name="image_deux" type="file" class="input-sm" id="newImg" accept="image/x-png,image/jpeg,image/jpg" /></p>
            <p><input name="oldimg2" type="text" class="input-sm" id="oldimg" value="<?php echo $nomEntete; ?>" readonly/><button type="submit" class="btn btn-danger" name="delete2">X</button></p>
          </div>

                  <?php }} } ?>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="saveEntete">Sauvegarder</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->  


<div class="modal fade" id="mentions">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modifier mentions légales</h4>
      </div>
      <form action="action_images.php" METHOD="POST">
      <div class="modal-body">
      <div class="row">
      <?php	
              $sql = "SELECT * FROM mentions" ;
              $result = mysqli_query($bdd, $sql);

              if ($result->num_rows > 0) {
                  while($donnees = $result->fetch_assoc()) {
                    $mentions=$donnees['texte_mention'];
                    $idMentions=$donnees['id_mention'];              
           ?>

                  <p><textarea name="mention" type="text" class="input-md" id="mention"><?php echo $mentions; ?></textarea></p>

                  <?php } } ?>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="saveMention">Sauvegarder</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->  



<!-- debut du pied de page -->
<?php include('include_mentions.php'); ?>
<!-- fin pied de page-->
<script>
  $('div.cutlist table tbody tr  td').on('click',function(){
    $("#myModal").modal("show");
    $("#idimage").val($(this).closest('tr').children()[0].textContent);
    $("#domaine").val($(this).closest('tr').children()[1].textContent);
    $("#texte").val($(this).closest('tr').children()[2].textContent);
    $("#image").val($(this).closest('tr').children()[3].textContent);
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
 


