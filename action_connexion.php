
<?php
session_start();
if (isset($_POST['login']) && isset($_POST['motdepasse']) && isset($_POST['connexion'])) {
  include('bdd/bdd_include.php');
  $login = htmlspecialchars($_POST['login'], ENT_QUOTES, 'UTF-8', false);
  $mdp = htmlspecialchars($_POST['motdepasse'], ENT_QUOTES, 'UTF-8', false);


  $sql = "SELECT * FROM utilisateur";
  $result = mysqli_query($bdd, $sql);
  $ctest=0;
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      if($login==$row['login'] && $mdp==$row['mot_de_passe']){
        $_SESSION['id']=$row['id_utilisateur'];
        $_SESSION['login']=$login;
        echo '<script language="javascript">document.location="accueil.php"</script>';
        $ctest=1;
      }
    }
  }
  switch ($ctest) {
    case 1:
      echo '<script language="javascript">document.location="accueil.php"</script>';
      break;
    
    case 0:
      echo '<script language="javascript">document.location="index.php?err=1"</script>';
      break;
        
    default:
     echo '<script language="javascript">document.location="index.php?err=2"</script>';
     break;
  }
    
  echo '<script language="javascript">document.location="index.php?err=3"</script>';
}
echo '<script language="javascript">document.location="index.php?err=4"</script>';

?>
