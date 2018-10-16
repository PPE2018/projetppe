<html>
    <head>
        <title>Création_Offre :</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
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
              <a class="nav-link" href="#">Consultation des offres</a>
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

      <form action="envois/creer_offre_envois.php" method="post">
        <h1> Création de l'offre : </h1>

      <!-- Conteneur du formulaire -->

      <div id="conteneur01">

          <!-- Saisie de l'Intitulé du post-->

          <div>
            <h3> Intitulé du post :</h3>
              <input type="text" name="nom_post" required="required">
          </div>

          <!-- Description du poste -->

          <div>
            <h3> Description :</h3>
              <TEXTAREA name="description" rows=4 cols=40></TEXTAREA>
                <!-- on a deux fois soit on fait un size qui modifie la longeur de la case soit on modifie la long et larg mais il y a
              un pb de saisie -->

          </div>

          <!-- Saisie du type post-->

        <div>
          <h3>Type de l'offre :</h3>
          <div>
            <input type="radio" name="contrat" value="cdi" checked />
                <label>CDI</label>
            <input type="radio" name="contrat" value="cdd" />
                <label>CDD</label>
            <input type="radio" name="contrat" value="interim" />
                <label>Intérim</label>

        </div>



          <!-- Saisie Compétences-->

          <div>
            <h3> Compétences :</h3>
              <input type="submit" name="soumettre" value="+"/>
            <select name="Compétence">
              <option value="Compétence_1">Compétence_1</option>
              <option value="Compétence_2">Compétence_2</option>
              <option value="Compétence_3">Compétence_3</option>
              <option value="Compétence_4">Compétence_4</option>
            </select>
          </div>

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
        <h3>Vidéos :</h3>

        <input type="url" name="url" required="required" value="" />
      </div>

      <div>
        <input type="submit" name="soumettre" value="Ajouter/Valider"/>
      </div>

    </body>
    <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</html>
