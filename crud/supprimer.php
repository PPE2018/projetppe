<?php
    include '../bdd/bdd.php';
    $requete = "SELECT id_offre FROM OFFRE_EMPLOIS";
    $resultat = mysqli_query($connexion, $requete);
    $id = $_GET['id'];
    $requete = "UPDATE offre_emplois SET supprimer = 1 WHERE id_offre=$id";
    $resultat = mysqli_query($connexion, $requete);
    header("location: ../consultation_offre.php");
    exit;
 ?>
