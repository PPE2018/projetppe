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
        <div class="container">
        <h1>Création de l'offre </h1>
          <form action="envois/creer_offre_envois.php" method="post">
              <!-- Saisie de l'Intitulé du post-->
              <div class="form-group">
                 <label for="nom_post">Intitulé du poste :</label>
                  <input type="text" class="form-control" name="nom_post" value="" required="required"/>
              </div>

              <!-- Description du poste -->
              <div class="form-group">
                <label for="description">Description :</label>
                <textarea name="description" class="form-control" rows=4 cols=40 required="required"></textarea>
              </div>

              <!-- Saisie du type post-->
              <div class="form-group">
                <label for="contrat">Type de l'offre :</label><br />
                <input type="radio" name="contrat" value="CDI" checked />
                    CDI
                <input type="radio" name="contrat" value="CDD" />
                    CDD
                <input type="radio" name="contrat" value="Interim" />
                    Intérim
              </div>

              <!-- Saisie Compétences-->
              <div class="form-group">
                <label for="competences">Compétences :</label>
                <h6> Appuyer sur le bouton ctrl (sur Windows) ou Command (Mac) pour sélectionner plusieurs compétences</h6>
                <select class="form-control" name="competences" multiple>
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
                <input type="submit" class="btn btn-secondary" name="ajouter" value="Ajouter"/>
              </div>

              <!-- A FAIRE Afficher les compétences dans une textarea-->

              <?php

              ?>
              <!-- Saisie le lieu-->
              <div class="form-group">
                <label for="lieu">Lieu :</label>
                  <input type="text" class="form-control" name="lieu" required="required" value="" />
              </div>

              <!-- Saisie du salaire-->
              <div class="form-group">
                <label for="salaire">Salaire annuel :</label>
                  <input type="int" class="form-control" name="salaire" required="required" value="" max="10" />
              </div>

              <!-- Saisie de la date limite de dépots-->
              <div class="form-group">
                <label for="date">Date limite de dépots :</label>
                <input type="date" class="form-control" name="date_depots" required="required" >
              </div>

              <!-- Saisie documents a fournir (cases à cocher)-->
              <div class="form-group">
                <label for="documents">Documents à fournir :</label><br />
                <input type="checkbox" name="doc_cv" />CV
                <input type="checkbox" name="doc_lm" />Lettre motivation
                <input type="checkbox" name="doc_video" />Vidéo
              </div>

              <!-- Saisie vidéo en url-->
              <div class="form-group">
                <label for="url">URL de la Vidéo :</label>
                <input type="url" class="form-control" name="url" required="required" value="" />
              </div>
              <!-- Bouton-->
              <div>
                <input type="submit" class="btn btn-primary" name="soumettre" value="Ajouter"/>
              </div>
        </div>
        </form>
      </div>
    </body>
    <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</html>
