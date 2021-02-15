<!-- Modal CREER UN SOUS DOAMINE -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Création d'un Sous-domaine</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form action="action_creerDomaines.php" method="POST">
		  <div class="modal-body">
			<div class="col">
				<label for="granddomaine">Choisir un domaine:</label>
				<select class="form-control" name="granddomaine" id="granddomaine">
				<?php 
                    $requete = "SELECT * FROM domaines";
                    $result = mysqli_query($bdd,$requete);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $iddomaine=$row['id_domaine'];
							$nomdomaine=$row['nom_domaine'];
							echo "<option value='$iddomaine'>$nomdomaine</option>";
                        }
                    }
				?>
				</select>
				<br />
				<div id="listesousdomaines">
					<div class="row">
						<div class="col-md-8 " >
							<input type="text" class="form-control" id="nomssd" placeholder="Entrez un sous-domaine" name="nomssd[]">
						</div>
						<div class="col-md-4 " >
							<button id="suppSsd" type="button" class="btn btn-danger collapse">-</button>
							<button id="ajoutSsd" type="button" class="btn btn-primary">+</button>
						</div> 
					</div>
				</div>
				<div id="nouveauSsd"></div>

				
			</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				<button type="submit" name="creerssd" class="btn btn-primary">Créer</button>
			</div>
	  </form>
    </div>
  </div>
</div>
<!-- FIN Modal -->