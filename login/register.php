<?php


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

$requete = "INSERT INTO personne(nom, prenom, mdp) VALUES ('$nom', '$prenom', PASSWORD('$mdp'))";
$resultat = mysqli_query($connexion, $requete);

$requete = "SELECT id_personne FROM personne ORDER BY id_personne DESC LIMIT 1;";
$resultat = mysqli_query($connexion, $requete);
while ($ligne = mysqli_fetch_array($resultat, MYSQLI_BOTH)){
    $id_personne = $ligne['id_personne'];
}

$requete = "INSERT INTO candidat(id_personne, nom, prenom, mdp) VALUES ($id_personne, '$nom', '$prenom', PASSWORD('$mdp'))";
$resultat = mysqli_query($connexion, $requete);

$erreur = false;
if(!$resultat)
    $erreur = true;

//Message de réussite
if($erreur){
    echo 'L\'envoi a échoué';
}
else{
    echo 'Votre compte a bien été créer !<br />';
}

?>
