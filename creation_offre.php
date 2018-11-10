<html>
    <head>
        <title>Création_Offre :</title>
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
              <a class='nav-link' href='creation_offre.php?langue=fr'>$str[3]</a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='#'>$str[4]</a>
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
      <?php
        echo"
        <div class='container'>
        <h1>$str[18]</h1>
          <form action='envois/creer_offre_envois.php' method='post'>
              <!-- Saisie de l'Intitulé du post-->
              <div class='form-group'>
                 <label for='nom_post'>$str[19] :</label>
                  <input type='text' class='form-control' name='nom_post' value='' required='required'/>
              </div>

              <!-- Description du poste -->
              <div class='form-group'>
                <label for='description'>$str[20] :</label>
                <textarea name='description' class='form-control' rows=4 cols=40 required='required'></textarea>
              </div>

              <!-- Saisie du type post-->
              <div class='form-group'>
                <label for='contrat'>$str[21] :</label><br />
                <input type='radio' name='contrat' value=$str[22] checked />
                    CDI
                <input type='radio' name='contrat' value=$str[23] />
                    CDD
                <input type='radio' name='contrat' value=$str[24] />
                    Intérim
              </div>

              <!-- Saisie Compétences-->
              <div class='form-group'>
                <label for='competences'>$str[25] :</label>
                <h6>$str[26]</h6>
                <select class='form-control' name='competences[]' multiple>";
                ?>

                <?php
                  include 'bdd/bdd.php';
                  $requete = 'SELECT id_competence, libelle FROM competence;';
                  $resultat = mysqli_query($connexion, $requete);
                  while ($ligne = mysqli_fetch_array($resultat, MYSQLI_BOTH)){?>
                      <option value=<?php echo $ligne['id_competence']; ?>><?php echo $ligne['libelle']; ?></option>';
                  <?php
                  }
                  ?>

                <?php
                echo "</select>
                <br />
                <input type='submit' class='btn btn-secondary' name='ajouter' value='$str[27]'/>
                <input type='text' class='form-control' name='nom_post' value='' required='required'/>
              </div>

              <!-- A FAIRE Afficher les compétences dans une textarea-->

              <?php

              ?>
              <!-- Saisie le lieu-->
              <div class='form-group'>
                <label for='lieu'>$str[28] :</label>
                  <input type='text' class='form-control' name='lieu' required='required' value='' />
              </div>

              <!-- Saisie du salaire-->
              <div class='form-group'>
                <label for='salaire'>$str[29] :</label>
                  <input type='number' class='form-control' name='salaire' required='required' value='' max='10' />
              </div>

              <!-- Saisie de la date limite de dépots-->
              <div class='form-group'>
                <label for='date'>$str[30] :</label>
                <input type='date' class='form-control' name='date_depots' required='required' >
              </div>

              <!-- Saisie documents a fournir (cases à cocher)-->
              <div class='form-group'>
                <label for='documents'>$str[31] :</label><br />
                <input type='checkbox' name='doc_cv' />$str[32]
                <input type='checkbox' name='doc_lm' />$str[33]
                <input type='checkbox' name='doc_video' />$str[34]
              </div>

              <!-- Saisie vidéo en url-->
              <div class='form-group'>
                <label for='url'>$str[35] :</label>
                <input type='url' class='form-control' name='url' required='required' value='' />
              </div>
              <!-- Bouton-->
              <div>
                <input type='submit' class='btn btn-primary' name='soumettre' value=$str[36]/>
              </div>
        </div>
        </form>
      </div>";
     ?>
    </body>
    <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</html>
