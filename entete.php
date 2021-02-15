<?php 	
require('bdd/bdd_include.php');		
?>

<div class="container-fluid" style="background-color:white;">
<?php	
              $sql = "SELECT * FROM entete ORDER BY id_entete" ;
              $result = mysqli_query($bdd, $sql);
              while($donnees = $result->fetch_assoc()) {
                $nomEntete=$donnees['nom_entete'];
                $idEntete=$donnees['id_entete']; 
                if(!empty($nomEntete)){               
           ?>
                  <a href="accueil.php"><img src="entete/<?php  echo $nomEntete;?>"  style="display:inline-block" class="img-responsive"></a>
                  <?php }} ?>
</div>