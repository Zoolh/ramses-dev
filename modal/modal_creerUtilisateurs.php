    
<!-- Modal CREER UN SOUS DOAMINE -->
<div class="modal fade" id="modalajouteruser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Création d'un utilisateur</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  
	  <form action="action_creerUtilisateurs.php" method="POST">
		<div class="modal-body">
			<div class="col">
				<label for="role">Choisir un rôle:</label>
				<select class="form-control" name="role" id="role">
				<?php 
                    $requete3 = "SELECT * FROM role ";
                    $reponse3 = mysqli_query($bdd,$requete3);
						while($donnees3 = $reponse3 -> fetch_assoc()){
							$idrole=$donnees3['id_role'];
							$nomrole=$donnees3['nom_role'];
							echo "<option value='$idrole'>",ucfirst($nomrole),"</option>";
					}
				?>
				</select>
				<br />
				
				<label for="prenomuser">Prénom:</label>
				<input type="text" class="form-control" id="prenomuser" placeholder="Entrez un prénom" name="prenomuser">
				<br />
				
				<label for="nomuser">Nom:</label>
				<input type="text" class="form-control" id="nomuser" placeholder="Entrez un nom" name="nomuser">
				<br />
				
				<label for="loginuser">Login:</label>
				<input type="text" class="form-control" id="loginuser" placeholder="Entrez le login" name="loginuser">
				
			</div>
		</div>
			
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
			<button type="submit" name="creer" class="btn btn-primary">Créer</button>
		</div>
	  </form>
    </div>
  </div>
</div>
<!-- FIN Modal -->