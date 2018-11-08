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
        <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Accueil</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample05">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="consultation_offre_rh.php">Consultation des offres</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#">Création des offres</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Réception des candidatures</a>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Langue</a>
              <div class="dropdown-menu" aria-labelledby="dropdown05">
                <a class="dropdown-item" href="#">Français</a>
                <a class="dropdown-item" href="#">English</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Mon Compte</a>
            </li>
          </ul>
        </div>
      </nav>
      <div class="form-style-2">
        <div class="form-style-2-heading">Création de l'offre </div>
          <form action="envois/creer_offre_envois.php" method="post">

          <!-- Conteneur du formulaire -->

          <div id="conteneur01">

              <!-- Saisie de l'Intitulé du post-->

              <label for="nom_post">
                <span>Intitulé du poste : <span class="required">*</span></span>
                <input type="text" class="input-field" name="nom_post" value="" required="required"/>
              </label>
              <!-- Description du poste -->


              <label for="description">
                <span>Description : <span class="required">*</span></span>
                <textarea name="description" class="textarea-field" rows=4 cols=40 required="required"></textarea>
              </label>
              <!-- Saisie du type post-->

            <div>
              <label for="contrat">
                <span>Type de l'offre : <span class="required">*</span></span>
                <input type="radio" class="ratio-field" name="contrat" value="CDI" checked />
                    CDI
                <input type="radio" class="ratio-field" name="contrat" value="CDD" />
                    CDD
                <input type="radio" class="ratio-field" name="contrat" value="Interim" />
                    Intérim
              </label>
              <!-- Saisie Compétences-->

              <div>
                <h3> Compétences : </h3>
                <h6> Appuyer sur le bouton ctrl (sur Windows) ou Command (Mac) pour sélectionner plusieurs compétences</h6>
                <select name="competences" multiple>
                  <?php
                  include 'bdd/bdd.php';
                  $requete = "SELECT libelle FROM competence;";
                  $resultat = mysqli_query($connexion, $requete);
                  while ($ligne = mysqli_fetch_array($resultat, MYSQLI_BOTH)){ ?>
                      <option value="<?php echo $ligne['libelle']; ?>"><?php echo $ligne['libelle']; ?></option>';
                  <?php
                  }
                  ?>
                </select>
                <br />
                <input type="submit" name="ajouter" value="Ajouter"/>
              </div>

              <!-- A FAIRE Afficher les compétences dans une textarea-->

              <?php

              ?>
              <!-- Saisie le lieu-->

              <div>
                <h3>Lieu :</h3>
                  <input type="text" name="lieu" required="required" value="" />
              </div>

              <!-- Saisie du salaire-->

              <div>
                <h3>Salaire annuel :</h3>
                  <input type="int" name="salaire" required="required" value="" max="10" />
              </div>

                <!-- Saisie de la date limite de dépots-->

              <div>
                <h3> Date limite de dépots :</h3>

                <input type="date" name="date_depots" required="required" >
              </div>

              <!-- Saisie documents a fournir (cases à cocher)-->

            <div>
              <h3>Documents à fournir :</h3>

              <input type="checkbox" name="doc_cv" />CV
              <input type="checkbox" name="doc_lm" />Lettre motivation
              <input type="checkbox" name="doc_video" />Vidéo
            </div>

            <!-- Saisie vidéo en url-->

          <div>
            <h3>URL de la Vidéo :</h3>

            <input type="url" name="url" required="required" value="" />
          </div>

          <div>
            <input type="submit" name="soumettre" value="Ajouter/Valider"/>
          </div>
        </form>
      </div>
    </body>
    <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</html>
