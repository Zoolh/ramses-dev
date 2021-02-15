<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Création d'un domaine</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form action="action_creerDomaines.php" method="POST">
		  <div class="modal-body">
				<div id="listeDomaines">
					<div class="row">
						<div class="col-md-8 " >
							<input type="text" class="form-control" id="nomDomaine" placeholder="Entrez un nom de domaine" name="nomDomaine[]">
						</div>
						<div class="col-md-4 " >
							<button id="suppDomaine" type="button" class="btn btn-danger collapse">-</button>
							<button id="ajoutDomaine" type="button" class="btn btn-primary">+</button>
						</div> 
					</div>
				</div>
				<div id="nouveauDomaine"></div>
		  </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				<button type="submit" name="creer" class="btn btn-primary">Créer</button>
			</div>
	  </form>
    </div>
  </div>
</div>