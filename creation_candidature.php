<html>
    <head>
        <title>Création_Candidature :</title>
        <meta charset="UTF-8">
    </head>
    <body>

    <form action="creation_candidature.php" method="post">
    <h1> Création candidature : </h1>

      <div id="conteneur01">
      <!-- Saisie le cv-->

      <div>
        <h3>CV :</h3>
        <label for="mon_fichier">Insérer le CV (tous formats | max. 1 Mo) :</label><br />
        <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
        <input type="file" name="mon_fichier" id="mon_fichier" /><br />
        <input type="text" name="nom_CV" required="required" value="" />

      <!-- Saisie le lm-->

      <div>
        <h3>Lettre de motivation :</h3>
          <input type="text" name="nom_lm" required="required" value="" />

          <!-- Ajouter la lettre de motivation -->
          <div>
            <input type="submit" name="soumettre" value="Ajouter une lettre de motivation"/>
          </div>

      </div>

      <!-- Saisie le video-->

      <div>
        <h3>La vidéo :</h3>
            <input type="url" name="url_video" required="required" value="" />

            <!-- Ajouter une vidéo -->
            <div>
              <input type="submit" name="soumettre" value="Ajouter une vidéo"/>
            </div>

            <div>
              <input type="submit" name="soumettre" value="Ajouter/Valider"/>
            </div>

      </div>
    </div>
  </form>


    </body>