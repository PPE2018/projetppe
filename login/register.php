<?php

$langue = 'fr';
if (isset($_GET['langue']))
  $langue = $_GET['langue'];
include "../langue_".$langue.".php";

include '../bdd/bdd.php';
if(isset($_POST['nom'])){
    $nom = $_POST['nom'];
}

if(isset($_POST['prenom'])){
    $prenom = $_POST['prenom'];
}

if(isset($_POST['mdp'])){
    $mdp = $_POST['mdp'];
}
if(isset($_POST['mdp_verif'])){
    $mdp_verif = $_POST['mdp_verif'];
}
if($mdp != $mdp_verif){
  echo"Les deux mot de passe ne correspondent pas !";
}
else{

  $requete = "SELECT nom, prenom FROM personne WHERE nom LIKE '$nom' and prenom LIKE '$prenom'";
  $resultat = mysqli_query($connexion, $requete);

  $erreur = false;
  while ($ligne = mysqli_fetch_array($resultat, MYSQLI_BOTH)){
    $erreur = true;
    echo 'Cette association nom/prenom existe déjà !<br />';
  }
  if(!$erreur){
    $requete = "INSERT INTO personne(nom, prenom, mdp) VALUES ('$nom', '$prenom', PASSWORD('$mdp'))";
    $resultat = mysqli_query($connexion, $requete);

    if(!$resultat)
        $erreur = true;

    $requete = "SELECT id_personne FROM personne ORDER BY id_personne DESC LIMIT 1;";
    $resultat = mysqli_query($connexion, $requete);
    while ($ligne = mysqli_fetch_array($resultat, MYSQLI_BOTH)){
        $id_personne = $ligne['id_personne'];
    }

    if(!$resultat)
        $erreur = true;

    $requete = "INSERT INTO candidat(id_personne, nom, prenom, mdp) VALUES ($id_personne, '$nom', '$prenom', PASSWORD('$mdp'))";
    $resultat = mysqli_query($connexion, $requete);

    if(!$resultat)
        $erreur = true;
  }

  //Message de réussite
  if($erreur){
      echo 'L\'envoi a échoué';
      echo "<br /><a href='connexion.php?langue=$langue'>Retour</a>";
  }
  else{
      echo 'Votre compte a bien été créer !<br />';
      echo "<br /><a href='connexion.php?langue=$langue'>Connectez-vous</a>";
  }
}
?>
