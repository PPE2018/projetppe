<?php
session_start();

$langue = 'fr';
if (isset($_GET['langue']))
  $langue = $_GET['langue'];
include "../langue_".$langue.".php";

include '../bdd/bdd.php';
if(isset($_POST['nom'])){
    $nom = $_POST['nom'];
}
if(isset($_POST['mdp'])){
    $mdp = $_POST['mdp'];
}



$requete = "SELECT id_personne, nom, prenom FROM candidat WHERE nom = '$nom' AND mdp = PASSWORD('$mdp');";
$resultat = mysqli_query($connexion, $requete);
while ($ligne = mysqli_fetch_array($resultat, MYSQLI_BOTH)){
    $_SESSION['Candidat'] = $ligne['id_personne'];
    $_SESSION['admin'] = 10;
}

$requete = "SELECT id_personne, nom, prenom FROM rh WHERE nom = '$nom' AND mdp = PASSWORD('$mdp');";
$resultat = mysqli_query($connexion, $requete);
while ($ligne = mysqli_fetch_array($resultat, MYSQLI_BOTH)){
    $_SESSION['Candidat'] = $ligne['id_personne'];
    $_SESSION['admin'] = 20;
}
if($_SESSION['admin'] == 20 || $_SESSION['admin'] == 10){
  header("location: ../consultation_offre.php?langue=$langue");
}
else{
  echo "Mauvais login<br />";
  echo "<a class='navbar-brand' href='connexion.php'>Retour</a>";
}
?>
