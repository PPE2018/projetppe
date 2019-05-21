<?php
include "../bdd/bdd.php";

if (isset($_GET['langue']))
  $langue = $_GET['langue'];

if(isset($_GET['id']))
  $id_candidature = $_GET['id'];

$requete = "UPDATE candidature SET reception = 1 WHERE id_candidature = $id_candidature";
$resultat = mysqli_query($connexion, $requete);

header("location: ../reception_cand_rh.php?langue=$langue");

?>
