<div class="sidebar-heading">ADMIN </div>
  <div class="list-group list-group-flush">
  <a href="admin.php" class="list-group-item list-group-item-action bg-light">Tableau de bord</a>
<?php if($role!="Ag"){ ?><a href="admin_creerDomaines.php" class="list-group-item list-group-item-action bg-light">Gestion des domaines</a> <?php } ?>
<?php if($role!="Ag"){ ?><a href="admin_creerSsd.php" class="list-group-item list-group-item-action bg-light">Gestion des sous-domaines</a><?php } ?>
  <a href="admin_gererUtilisateurs.php" class="list-group-item list-group-item-action bg-light">Gestion des utilisateurs</a>
  <?php if($role!="Ag"){ ?><a href="admin_importerStructure.php" class="list-group-item list-group-item-action bg-light">Importer des organismes</a><?php } ?>
  <?php if($role!="Ag"){ ?><a href="admin_exporter.php" class="list-group-item list-group-item-action bg-light">Export RAMSES</a><?php } ?>
  <?php if($role!="Ag"){ ?><a href="admin_imagesTextes.php" class="list-group-item list-group-item-action bg-light">Images et textes</a><?php } ?>

  </div> <!-- FIN DE LA LISTE-->