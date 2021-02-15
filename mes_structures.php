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
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>	
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">



</head>
<body>


<?php include('entete.php'); ?>



<?php include('navbar.php'); ?>

<nav class="row content">
    <ol class="breadcrumb">
      <li><a href="accueil.php"><span class="sr-only">Home</span><span class="glyphicon glyphicon-home"></span></a></li>
      <li class="active">Mes organismes</li> 
    </ol>
  </nav>


<div class="content">
		<div class="row">
			<div class="col-sm-3" > 
			<div class="table-wrapper">


			<table id="example" class=" display table table-striped table-hover">
      <thead>
        <tr class="filters">
          <th class="hidden">ID</th>
          <th>Nom</th>
          <th class="hidden">N° Rue</th>
          <th class="hidden">Ville</th>

        </tr>
      </thead>
      <tbody >
        <?php 
          $requete = "SELECT * FROM structure WHERE id_utilisateur=$sessionid ORDER BY id_structure DESC";
          $reponse = mysqli_query($bdd,$requete);
          if($reponse -> num_rows > 0){
            while($donnees = $reponse -> fetch_assoc()){
            $idstructure=$donnees['id_structure'];
            $idutilisateur=$donnees['id_utilisateur'];
            $nomstructure=$donnees['nom_structure'];
            $adressestructure=$donnees['adresse_structure'];
						
            echo "<tr onclick='afficheStructure($idstructure)'>
                <td class='hidden'>$idstructure</td>
                <td><b>$nomstructure</b></td>
                <td class='hidden'>$adressestructure</td>
                <td class='hidden'>$villestructure</td>
                </tr>";
          }}
        ?>
    </tbody>
    </table>
			</div> 



		</div> <!-- FIN DE LA PARTIE GAUCHE -->
			
			<div class="col-sm-9"  >
			<br /><!-- PARTIE DROITE -->
      <?php 
					if(isset($_GET['id'])){
						$idStructureDroite = $_GET['id'];
						$sql = "SELECT * FROM structure where id_structure = $idStructureDroite";
						
						$result = mysqli_query($bdd, $sql);
						if ($result->num_rows > 0) {
							while($donnees = $result->fetch_assoc()) {
								$nomStructureDroite=$donnees['nom_structure'];
								$descriptionStructure=$donnees['description_structure'];
								$adresseStructure=$donnees['adresse_structure'];
								$villeStructure=$donnees['ville_structure'];
								$cpStructure=$donnees['cp_structure'];
								$dateStructure=$donnees['date_structure'];
								$horaires=$donnees['horaires'];
								$createur = $donnees['id_utilisateur'];
	
							}
						} ?>
						<div class="panel panel-default" >
        <div class="panel-heading clearfix">
		<div class="table-wrapper">
		<div class="table-title">
            <div class="row">
                <div class="col-sm-5"><h2 style="color:white;"><b>#<?php echo $nomStructureDroite; ?></b></h2></div>
                <div class="col-sm-7">
                    <div class="btn-group" >
						<a href="#" onclick="printDiv();">
                          	<label class="btn btn-info " data-toggle="tooltip" data-placement="top" title="Imprimer">
							            <span class="glyphicon glyphicon-print"></span>
                        	</label>
                        </a>


						<?php if($role=="Administrateur" || $createur == $sessionid){ ?>
						<a href="modifierFiche.php?id=<?php echo $idStructureDroite; ?>" >
							<label class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Modifier">
								<span class="glyphicon glyphicon-pencil"></span>
							</label>
						</a>
						<?php } ?>

						<?php if($role=="Administrateur"){ ?>
							<a href="#" onclick='suppStr();'>
                        <label class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Supprimer">	
							<span class="glyphicon glyphicon-trash"></span>
                        </label>
						</a>
					<?php } ?>
                    </div>
                </div>
            </div>
        </div>
       
        <div class="panel-body" id="DivIdToPrint">
          <form class="form-horizontal row-border" method="POST" action="action_creerStructure.php">


            <div class="form-group">
              <label class="col-md-12 control-label" style="text-align:center; background-color:lightgrey;">Informations générales</label>
              <label class="col-md-12 " ></label>
			  
              <div class="col-md-12">
			  <blockquote class="blockquote ">

  <h2><b><?php echo  ucfirst($nomStructureDroite);  ?></b></h2>
</blockquote>

              </div>
            </div>


        
			<div class="form-group">
              <div class="col-md-12">
			  <?php 							  	
			  if(empty($descriptionStructure)){ ?>
				<textarea class="form-control" rows="5" id="comment" name="description" readonly>-Aucune Description-</textarea >
				<?php } else{?>
				<textarea class="form-control" rows="5" id="comment" name="description" readonly><?php echo $descriptionStructure; ?></textarea >
				<?php } ?>
              </div>
            </div>

			
			<div class="form-group">
              <label class="col-md-12 control-label" style="text-align:center; background-color:lightgrey;">Coordonnées</label>
              <label class="col-md-12 " ></label> 
			  <div class="col-md-12">
				<div class='hr'><span class='hr-title'>Adresse</span></div>
				
                <div class="row">
				<?php if(empty($adresseStructure) && empty($villeStructure) && empty($cpStructure)){?>
					    <div class="col-md-10">
					<?php echo "-Aucune adresse-"; ?>
					</div>
					<?php
				} else{
					?>
                  <div class="col-xs-5">
					  <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
						<input type="text" name="adresse" class="form-control" placeholder="N° de rue" value="<?php echo ucfirst($adresseStructure); ?>" readonly>
					  </div>
                  </div>
                  <div class="col-xs-4">
					  <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
						<input type="text" name="ville" class="form-control" placeholder="Ville" value="<?php echo ucfirst($villeStructure); ?>" readonly>
					  </div>
                  </div>
                  <div class="col-xs-3">
					  <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
						<input type="text" name="cp" class="form-control" placeholder="Code postal" value="<?php echo ucfirst($cpStructure); ?>" readonly>
					  </div>
                  </div><?php } ?>
                </div> 
              </div>
            </div>

									<div class='hr'><span class='hr-title'>Téléphone(s)</span></div>
	
			 <div class="form-group">
 

						<?php	
						$requeteTel = "SELECT * FROM telephone where id_structure = $idStructureDroite ";
						$result = mysqli_query($bdd, $requeteTel);
						if ($result->num_rows > 0) {
							while($row2 = $result->fetch_assoc()) {
							  	if(empty($row2['tel'])){ ?>
										<div class="col-md-4" id="buildyourform2">
								
										<?php echo "-Aucun téléphone-"; ?>
										</div>
								 <?php } else{?>
										<div class="col-md-4" id="buildyourform2">
											<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span><input id="tel"  placeholder="Numéro de téléphone" class="form-control"  value="<?php echo $row2['tel']; ?>" type="text" readonly></div>
							  			</div>	
										<?php if(!empty($row2['detail'])){ ?>
										<div class="col-md-4" id="buildyourform2">
											<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span><input id="tel"  placeholder="Numéro de téléphone" class="form-control"  value="<?php echo $row2['detail']; ?>" type="text" readonly></div>
							  			</div>
										<?php } ?>

							  <?php }}
							}
							else{ ?>
															  				<div class="col-md-4" id="buildyourform2">

								<?php echo "-Aucun téléphone-"; ?>
								</div>
								
						<?php	}
						 ?>				
			
			 </div>
			 
			 <div class='hr'><span class='hr-title'>Email(s)</span></div>
	
			 <div class="form-group">
				<div class="col-md-5 " >
							<?php 		
								$requeteMail = "SELECT * FROM email where id_structure = $idStructureDroite ";
								$result = mysqli_query($bdd, $requeteMail);
								if ($result->num_rows > 0) {
									while($row = $result->fetch_assoc()) {
										if(empty($row['email'])){ 
												echo "-Aucun emails-";
										} else{?>
										<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span><input id="email"  placeholder="Adresse E-Mail" class="form-control"  value="<?php echo $row['email']; ?>" type="text" readonly></div>
									<?php } }
									}
									else{ 
										echo "-Aucun emails-";
									}
						 	?>
				</div>  


			
			 </div>

				<div class='hr'><span class='hr-title'>Réseau(x)</span></div>

			 <div class="form-group" id="dynamic_field">
				<div class="col-md-9">
						<?php 
								$requeteUrl = "SELECT * FROM reseaux where id_structure = $idStructureDroite ";
								$result = mysqli_query($bdd, $requeteUrl);
								if ($result->num_rows > 0) {
									while($row = $result->fetch_assoc()) {
								  if(empty($row2['url_structure'])){ 
										echo "-Aucun réseaux-";
								  		break;
								  }
								  else{ ?>
								<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span><input id="url"  placeholder="Réseaux" class="form-control"  value="<?php echo $row2['url_structure']; ?>" type="text" readonly></div>
								  <?php }
								  }
							}
							else{ 
								echo "-Aucun réseaux-";
							}
						 ?>				</div>
            </div>


									<div class='hr'><span class='hr-title'>Horaires</span></div>

			 <div class="form-group">
              <div class="col-md-3">
			  <?php 							  	
			  if(empty($horaires)){ ?>
				<textarea class="form-control" rows="5" id="comment" name="description" readonly>-Horaires non renseignées-</textarea >
				<?php } else{?>
				<textarea class="form-control" rows="5" id="comment" name="description" readonly><?php echo $horaires; ?></textarea >
				<?php } ?>
               </div>
            </div>



            

			<hr />
			<div class="form-group">

				<label class="col-md-12 font-weight-bold control-label" style="text-align:center; background-color:lightgrey;">Domaines et sous domaines</label>
				<label class="col-md-12 " ></label>
				<div class="col-md-12">
				<table class="table table-condensed">
					<thead>
					<tr>
						<th>Domaines</th>
						<th>Sous-domaines</th>
					</tr>
					</thead>
					<tbody>
					<?php 

						$sql = "SELECT nom_domaine,id_domaine FROM domaines WHERE id_domaine IN (SELECT distinct id_domaine FROM structure_domaine where id_structure = $idStructureDroite)" ;
						$result = mysqli_query($bdd, $sql);

						if ($result->num_rows > 0) {
							while($donnees = $result->fetch_assoc()) {
								$domaine=$donnees['nom_domaine'];
								$iddudomaine=$donnees['id_domaine']; ?>

							<tr>
								<td> 
									<?php echo $domaine; ?>
								</td>
								<td> 
									<ul>
									<?php 
										$sqlSsd = "SELECT * FROM sous_domaine WHERE id_ssd IN (SELECT id_ssd FROM structure_domaine WHERE id_structure=$idStructureDroite AND id_domaine=$iddudomaine)" ;
										$resultSsd = mysqli_query($bdd, $sqlSsd);

										if ($resultSsd->num_rows > 0) {
											while($donnees2 = $resultSsd->fetch_assoc()) {
												$nomSsd=$donnees2['nom_ssd']; ?>
												<li><?php echo $nomSsd; ?> </li>
									<?php }
										} ?>
									</ul>
								</td>
							</tr>


							<?php }
						} ?>


					</tbody>
				</table>

				</div>
        	</div>
		
			<hr />
			<div class="form-group">

			<label class="col-md-12 font-weight-bold control-label" style="text-align:center; background-color:lightgrey;">Contacts</label>
			<label class="col-md-12 " ></label>
			<div class="col-md-12">
			<?php 	

			$requeteContact = "SELECT * FROM contact where id_structure = $idStructureDroite ";
			$result = mysqli_query($bdd, $requeteContact);
			if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
			if(empty($row['nom_contact']) && empty($row['prenom_contact'])){ 
				echo "-Aucun Contact-";
			} else{?>
			<div class="col-md-3">
				<div class="contact-box center-version">
					<!--<img alt="image" class="img-circle" src="img/contact.png">-->
					<h4 class="m-b-xs"><strong><?php echo ucfirst($row['prenom_contact']).' '.ucfirst($row['nom_contact']); ?> </strong></h4>
					<address class="m-t-md">
						<strong><?php if(isset($row['statut_contact'])){echo $row['statut_contact'];} ?></strong><br>
						<?php echo $row['mail_contact']; ?> <br>
						<?php echo $row['tel_contact']; ?>
					</address>
				</div>
			</div>

							  <?php }}
						   }
						   /* Aucune ligne ne correspond -- faire quelque chose d'autre */
						   else {
							  echo "-Aucun Contact-";
						   }
						
						
				?>


			   </div>
			  
			
			<hr />
			

          </form>
        </div>
        </div>
        </div>
		

					<?php } 
					else{
						echo "<p style='text-align:center; font-size: 10em;'><a href='#'><span class='glyphicon glyphicon-info-sign'></a></span></p>";
						echo "<p style='text-align:center; font-size: 2em;'>Veuillez sélectionner un organisme</p>";
						echo "</div>"; 
						
					}
				?>
			
 <!-- FIN DE LA PARTIE DROITE -->
  </div>
 
</div>


</div>

<form action="action_supprimerStructure.php?idSas=<?php echo $idStructureDroite;?>" method="POST">
 <div class="modal fade" id="modalSupprimer" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Confirmation</h4>
      </div>
          <div class="modal-body">
       
       <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Etes vous sur de vouloir supprimer cette structure?</div>
       
      </div>
        <div class="modal-footer ">
        <button type="submit" class="btn btn-success" name="supprimer"><span class="glyphicon glyphicon-ok-sign"></span> Oui</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Non</button>
      </div>
        </div>
</div>
</div>
</form>
<!-- debut du pied de page -->
<?php include('include_mentions.php'); ?>
<!-- fin pied de page-->
<script>
function afficheStructure(id){
	const monadresse = "mes_structures.php?id="+id;
	document.location.href= monadresse;
}

function suppStr(){
	$('#modalSupprimer').modal();
}

function printDiv(){
		$('textarea').replaceWith(function() {
  			return '<p>' + $(this).text() + '</p>';
		});	

     var divToPrint=document.getElementById('DivIdToPrint');
     var newWin=window.open('','Print-Window');
	 newWin.document.open();
	 newWin.document.write('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">'); 
	 newWin.document.write('<style>@media print {a[href]:after {display: none;visibility: hidden;}}</style>');
	 newWin.document.write('<html><body onload="window.print()">');
     newWin.document.write('<div class="row" style="background:whitesmoke;"><div class=" col-md-offset-2 col-md-8" style="background:white;">');
     newWin.document.write(divToPrint.innerHTML);
     newWin.document.write('</div></body></html>');
	 newWin.document.close();
	 
}
$(document).ready(function() {



    var table = $('#example').DataTable( {
      "language":{
    "decimal":        "",
    "emptyTable":     "Aucune données",
    "info":           " _START_ à _END_ sur _TOTAL_ organisme(s)",
    "infoEmpty":      " 0 à 0 sur 0 organisme(s)",
    "infoFiltered":   "(filtres sur _MAX_ organisme(s))",
    "infoPostFix":    "",
    "thousands":      ",",
    "lengthMenu":     "Afficher par _MENU_ ",
    "loadingRecords": "En charge...",
    "processing":     "En charge...",
    "search":         "Recherche:",
    "zeroRecords":    "Aucun résultat",
    "paginate": {
        "first":      "<<",
        "last":       ">>",
        "next":       ">",
        "previous":   "<"
    }
},
        order: [[ 3, 'desc' ], [ 0, 'asc' ]],
        orderCellsTop: true,
        fixedHeader: true
    } );


  $('[data-toggle="tooltip"]').tooltip();   


} );

</script>

</body>
</html>
 




