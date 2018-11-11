<html>
    <head>
        <title>Création_Candidature :</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style/style.css">
    </head>
    <body>
      <?php

      $langue = 'fr';

      if (isset($_GET['langue']))
        $langue = $_GET['langue'];
      include "langue_".$langue.".php";

      echo"
        <nav class='navbar sticky-top navbar-expand-lg navbar-dark bg-dark'>
        <a class='navbar-brand' href='#'>$str[1]</a>
        <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarsExample05' aria-controls='navbarsExample05' aria-expanded='false' aria-label='Toggle navigation'>
          <span class='navbar-toggler-icon'></span>
        </button>

        <div class='collapse navbar-collapse' id='navbarsExample05'>
          <ul class='navbar-nav mr-auto'>
            <li class='nav-item'>
              <a class='nav-link' href='consultation_offre_rh.php?langue=fr'>$str[2]</a>
            </li>
            <li class='nav-item active'>
              <a class='nav-link' href='#'> Consulter des différentes candidatures</a>
            </li>
          </ul>
          <ul class='navbar-nav ml-auto'>
            <li class='nav-item dropdown'>
              <a class='nav-link dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>$str[5]</a>
              <div class='dropdown-menu' aria-labelledby='dropdown05'>
                <a class='dropdown-item' href='creation_offre.php?langue=fr'>$str[6]</a>
                <a class='dropdown-item' href='creation_offre.php?langue=en'>$str[7]</a>
              </div>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='#'>$str[8]</a>
            </li>
          </ul>
        </div>
      </nav>";

      ?>
<!-- TODOO afficher l'identité de la personne nom, prenom / afficher en fonction de l'offre les élémemnts à envoyer /mettre dans la base de données  -->


    <form action="creation_candidature.php" method="post">
    <h1> Création candidature : </h1>

    <?php
    include 'bdd/bdd.php'
    //pas sur du tt je veux associer le candidat à sa fiche candidature en fonction de l'offre (bouton postuler)
    $resultat= mysqli_query($connexion, "SELECT C.id_personne, nom, prenom FROM candidat C INNER JOIN candidature CA on CA.id_personne=C.id_personne INNER JOIN offre_emplois O on O.id_offre=CA.id_offre WHERE CA.id_offre=CA.id_candidature;")

     ?>



      <div id="conteneur01">

      <!-- Saisie le cv-->

      <div>
        <h3>CV :</h3>
        <label for="mon_fichier">Insérer le CV (tous formats | max. 1 Mo) :</label><br />
        <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
        <input type="file" name="mon_fichier" id="mon_fichier" /><br />
      </div>


      <!-- Saisie le lm-->

      <div>
        <h3>Lettre de motivation :</h3>

          <!-- Ajouter la lettre de motivation -->
          <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
          <input type="file" name="mon_fichier" id="mon_fichier" /><br />

      </div>

      <!-- Saisie le video-->

      <div>
        <h3>La vidéo :</h3>
        <!-- Ajouter une vidéo -->
        <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
        <input type="file" name="mon_fichier" id="mon_fichier" /><br />

      </div>
      <div>
        <input type="submit" name="soumettre" value="Ajouter/Valider"/>
      </div>

    </div>
  </form>


    </body>
