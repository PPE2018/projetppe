<?php

$link = mysqli_init();     // initialiser et connection au serveur

 $connection = mysqli_connect('localhost', 'root', ''); /* savoir si la connection au serveur de base de données*/
if($connection){
  //echo 'Connexion au serveur réussie <br/>';
  $ok = mysqli_select_db($connection, 'ppe');
  if($ok){
    //echo'Base de données selectionner';
  }
  else{
    //echo 'Echec de la sélection de la base';
  }
}
else {
  //echo ' Erreur de la connection';
}

 ?>

<html>
    <head>
        <title>Consultation des offres  :</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="style/consultation_offre_rh.css" rel="stylesheet">
    </head>
    <body>
          <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
          <a class="navbar-brand" href="#">Accueil</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarsExample05">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="consultation_offre_rh.php">Consultation des offres</a>
              </li>
              <li class="nav-item ">
                <a class="nav-link" href="creation_offre.php">Création des offres</a>
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
          <?php

          $resultat=mysqli_query($connection, 'SELECT*  FROM offre_emplois'); /*permet d'afficher les données*/
          while($ligne = mysqli_fetch_array($resultat, MYSQLI_BOTH))
          {
            $id=$ligne['id_offre'];
            $libelle = $ligne['libelle'];
            $desc=$ligne['description'];
            $lieu=$ligne['lieu'];
            $typecontr=$ligne['type_contrat'];
            $salaire= $ligne['salaire'];
            $datelim=$ligne['date_limite'];
            $video=$ligne['video'];

            ?>
            <div class="card bg-secondary text-white">

              <div class="card-body">
                <?php
                  echo 'Consultation des offres : '.$id.'<br/> Nom emploi : '.$libelle.'<br/> Descriptif : '. $desc.'<br/> Lieu : '.$lieu.'<br/> type de contrat : '.$typecontr.'<br/>Salaire : '.$salaire.'<br/> Date limite : '.$datelim.'<br/> URL de la vidéo : '.$video.'<br/> <br/><br/>';
                 ?>
               </div>
               <a href="#" class="btn btn-info" role="button">Réception de candidatures</a>
               <a href="creation_offre.php" class="btn btn-info" role="button">Modifier l'offre</a>
               <input type="submit" class="btn btn-info" value="Supprimer l'offre">
             </div>
          <?php
           }

          ?>

          <br>
      </div>

    </body>
  </html>
<?php
mysqli_close($connection);
 ?>
