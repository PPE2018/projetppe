<html>
    <head>
        <title>Création_Offre</title>
        <meta charset="UTF-8">
        <link href="creation_offre.css" rel="stylesheet" type="text/css" media="screen">
    </head>
    <body>
      <ul>
        <li><a class="active" href="#home">Acceuil</a></li>
        <li><a href="#news">Consultation des offres</a></li>
        <li><a href="#contact">Création des offres</a></li>
        <li><a href="#about">Réception des candidatures</a></li>
        <li style="float:right"><a class="active" href="#about">Français</a></li>
        <li style="float:right"><a class="active" href="#about">Anglais</a></li>
        <li style="float:right"><a class="active" href="#about">Mon compte</a></li>
      </ul>

      <form action="creation_offre.php" method="post">
        <h1> Création de l'offre </h1>

      <!-- Conteneur du formulaire -->

      <div id="conteneur01">

          <!-- Saisie de l'Intitulé du post-->

          <div>
            <h3> Intitulé du post :</h3>
              <input type="text" name="nom_post">
          </div>

          <!-- Saisie Compétences-->

          <div>
            <h3> Compétences :</h3>
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
              <input type="text" name="nom_lieu" >
          </div>

            <!-- Saisie de la date limite de dépots-->

          <div>
            <h3> Date limite de dépots :</h3>

            <input type="date" name="date_depots" >
          </div>

          <!-- Saisie documents a fournir (cases à cocher)-->

        <div>
          <h3>Documents à fournir :</h3>

          <input type="text" name="nom_docsr" >
        </div>

        <!-- Saisie vidéo en url-->

      <div>
        <h3>Vidéos :</h3>

        <input type="text" name="" >
      </div>

          <div>
            <input type="submit" name="soumettre" value="Ajouter/Valider"/>
          </div>



    </body>
</html>
