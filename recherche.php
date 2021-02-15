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
<style>

	.table-wrapper {

        background: #fff;
        padding: 20px 30px 5px;
        box-shadow: 0 0 1px 0 rgba(0,0,0,.25);
        border-style:solid; 
border-width: 1px; 
border-color:gainsboro;"
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

	table.table td .btn.manage {
		padding: 2px 10px;
		background: #37BC9B;
		color: #fff;
		border-radius: 2px;
	}
	table.table td .btn.manage:hover {
		background: #2e9c81;		
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
      <li class="active">Recherche Avancée</li> 
    </ol>
  </nav>



<div class="content">

<div class="col">

<div class="col-md-12">
<div class="row filterable">
<div class="table-wrapper">
  <div class="table-wrapper">
    <div class="table-title">
      <div class="row">
        <div class="col-sm-8">
          <h2 style="color:white">Table des organismes</h2>
        </div>
        <div class="col-sm-4">
                    <div class="btn-group" >
						<a href="#" onclick='printDiv();'>
                          	<label class="btn btn-info " data-toggle="tooltip" data-placement="top" title="Imprimer">
							            <span class="glyphicon glyphicon-print"></span>
                        	</label>
                        </a>




						<?php if($role=="administrateur"){ ?>
                        <label class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Supprimer">	
							<span class="glyphicon glyphicon-trash"></span>
                        </label>
					<?php } ?>
                    </div>
                </div>
      </div>
    </div>
    <table id="example" class=" display table table-striped table-hover">
    <div id="GFG">
      <thead>
        <tr class="filters">
          <th>Nom</th>
          <th>Tél</th>
          <th>E-mails</th>
          <th>N° rue</th>
          <th>Ville</th>
          <th>Code postal</th>
          <th>Domaines</th>
          <th>Sous-domaines</th>
        </tr>
      </thead>
      <tbody id="DivIdToPrint">
        <?php 
          $requete = "SELECT * FROM structure ";
          $reponse = mysqli_query($bdd,$requete);
          if($reponse -> num_rows > 0){
            while($donnees = $reponse -> fetch_assoc()){
            $idstructure=$donnees['id_structure'];
            $idutilisateur=$donnees['id_utilisateur'];

            $requeteUser = "SELECT login FROM utilisateur WHERE id_utilisateur=$idutilisateur";
            $resultatUser=mysqli_query($bdd,$requeteUser);
            while($user = $resultatUser -> fetch_assoc()){
              $nomutilisateur=$user['login'];
            }

            $nomstructure=$donnees['nom_structure'];

            $requeteDomaines="SELECT nom_domaine FROM domaines WHERE id_domaine IN(SELECT DISTINCT(id_domaine) FROM structure_domaine WHERE id_structure=$idstructure)";
            $resultDomaines = mysqli_query($bdd,$requeteDomaines);
            $domainess = array();
            while($dom = $resultDomaines -> fetch_assoc()){
              array_push($domainess, $dom['nom_domaine']);
            }

            $requeteSsd="SELECT nom_ssd FROM sous_domaine WHERE id_ssd IN(SELECT id_ssd FROM structure_domaine WHERE id_structure=$idstructure)";
            $resultSsd = mysqli_query($bdd,$requeteSsd);
            $ssds = array();
            while($ssd = $resultSsd -> fetch_assoc()){
              array_push($ssds, $ssd['nom_ssd']);
            }


            $requeteTel="SELECT tel FROM telephone WHERE id_structure=$idstructure";
            $resultTel = mysqli_query($bdd,$requeteTel);
            $tels = array();
            while($tel = $resultTel -> fetch_assoc()){
              array_push($tels, $tel['tel']);
            }

            $requeteMail="SELECT email FROM email WHERE id_structure=$idstructure";
            $resultMail = mysqli_query($bdd,$requeteMail);
            $emails = array();
            while($email = $resultMail -> fetch_assoc()){
              array_push($emails, $email['email']);
            }

            $adressestructure=$donnees['adresse_structure'];
            $cpstructure=$donnees['cp_structure'];
            $villestructure=$donnees['ville_structure'];
            $datestructure=$donnees['date_structure'];						
            $horairesstructure=$donnees['horaires'];						

?>
          <tr>

                <td><b><a href='fichestructure.php?id=<?php echo $idstructure; ?>' target='_blank'><?php echo $nomstructure; ?></a></b></td>

                <td><?php for($i=0;$i<sizeof($tels);$i++){

                              echo $tels[$i].'<br />';                }
                              
                  ?></td>
                <td><?php for($i=0;$i<sizeof($emails);$i++){
 
                              echo $emails[$i].'<br />';                }
                            
                  ?></td>
          
              
                <td><?php echo $adressestructure; ?></td>
                <td><?php echo $villestructure; ?></td>
                <td><?php echo $cpstructure; ?></td>
                <td class='hidden'><?php echo $datestructure; ?></td>
                <td><?php for($i=0;$i<sizeof($domainess);$i++){
                            if($i==sizeof($domainess)-1){
                              echo $domainess[$i];
                             }
                            else{
                              echo $domainess[$i].', ';                }
                              }
                  ?></td>
                <td ><?php for($i=0;$i<sizeof($ssds);$i++){
                            if($i==sizeof($ssds)-1){
                              echo $ssds[$i];
                             }
                            else{
                              echo $ssds[$i].', ';                }
                              }
                  ?></td>
                </tr>
                            <?php } } ?>
    </tbody>
    </div><!-- fin gfg -->
    </table>

  </div>     
  </div>    
  </div>    
  </div>    
  </div>    



</div>
<!-- debut du pied de page -->
<?php include('include_mentions.php'); ?>
<!-- fin pied de page-->


<script>
	function printDiv(){

     var divToPrint=document.getElementById('DivIdToPrint');
     var newWin=window.open('','Print-Window');
	 newWin.document.open();
   newWin.document.write('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">'); 
   newWin.document.write('<style>@media print {a[href]:after {display: none;visibility: hidden;}}</style>');
	 newWin.document.write('<html><body onload="window.print()">');
   newWin.document.write('<div class="row"><div class="col-md-1"></div><div class=" col-md-10" style="background:white;"><table border="2" class=" table "> ');
   newWin.document.write('<th>Nom</th><th>Tél</th><th>E-mails</th><th>N° rue</th><th>Ville</th><th>Code postal</th><th>Domaines</th><th>Sous-domaines</th>');
   newWin.document.write(divToPrint.innerHTML);
   newWin.document.write('</table></div></div></body></html>');
	 newWin.document.close();
	 
}
$(document).ready(function() {

    $('#example thead tr').clone(true).appendTo( '#example thead' );
    $('#example thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input type="text" class="form-control" placeholder="Recherche par '+title+'" />' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );
 
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
        orderCellsTop: true,
        fixedHeader: true
    } );

} );
</script>

</body>
</html>
 



