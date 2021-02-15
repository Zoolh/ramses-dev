<?php 	
  include('infos_session.php');	
require('bdd/bdd_include.php');		
require('fonction.php');
?>

<nav class="navbar navbar-default navbar-exand-lg">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>

      </button>
      <!-- <a class="navbar-brand" href="accueil.php">RAMSES</a> -->
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      <li><a href="accueil.php">Accueil<span class="sr-only">(current)</span></a></li>
      <?php if($role!="Utilisateur"){ ?>
      <li><a href="creation.php">Création<span class="sr-only">(current)</span></a></li>
      <?php } ?>
      <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Recherche <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">Moyens de recherche</li>
                <li><a href="recherche.php">Recherche avancée</a></li>
                <li><a href="rechercheDomaine.php">Recherche par domaine</a></li>
                <li><a href="rechercheDepartement.php">Recherche par département</a></li>
              </ul>
            </li>
      <?php if($role!="Utilisateur"){ ?>
      <li><a href="mes_structures.php">Mes organismes<span class="sr-only">(current)</span></a></li>
      <?php } ?>
      <!-- <li><a href="test.php">TEST<span class="sr-only">(current)</span></a></li> -->


      </ul>

      <ul class="nav navbar-nav navbar-right">
		  <span class="navbar-text text-whi"><?php echo " ".$prenom." ".$nom." (".ucfirst($role).")"; ?></span>
		  <li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog"></span><span class="caret"></span></a>
			  <ul class="dropdown-menu">
				<li><a href="mesinfos.php">Mes infos</a></li>
			  	<li><a href="numeros_verts.php">Numéros d'urgence</a></li>
				<?php if($role=='Administrateur' || $role=="Ag"){ ?>
					<li role="separator" class="divider"></li>	
					<li><a href="admin.php">Admin</a></li>
				<?php } ?>
				<li role="separator" class="divider"></li>	
				<li><a href="logout.php">Déconnexion</a></li>
			  </ul>
        </li> 
		  
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<script type="text/javascript">
    $(document).ready(function () {
        var url = window.location;
        $('ul.nav a[href="'+ url +'"]').parent().addClass('active');
        $('ul.nav a').filter(function() {
             return this.href == url;
        }).parent().addClass('active');
        
$('.navbar .dropdown').hover(function () {
        $(this).find('.dropdown-menu').first().stop(true, true).slideDown(150);
    }, function () {
        $(this).find('.dropdown-menu').first().stop(true, true).slideUp(105)
    });
});
</script> 