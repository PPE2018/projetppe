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
          <div class="row">
              <?php
              include 'bdd/bdd.php';
              $resultat=mysqli_query($connexion, 'SELECT offre_emplois.libelle as libelle_offre, description, lieu, type_contrat, salaire, date_limite, video, competence.libelle FROM offre_emplois INNER JOIN posseder ON offre_emplois.id_offre = posseder.id_offre INNER JOIN competence ON posseder.id_competence = competence.id_competence ORDER BY offre_emplois.libelle'); /*permet d'afficher les données*/
              $ligne = mysqli_fetch_array($resultat);
              $libelle = $ligne['libelle_offre'];
              $desc=$ligne['description'];
              $lieu=$ligne['lieu'];
              $typecontr=$ligne['type_contrat'];
              $salaire= $ligne['salaire'];
              $datelim=$ligne['date_limite'];
              $video=$ligne['video'];
              $competence = $ligne['libelle'];
              echo"<div class='col-sm-8'>
                      <div class='card bg-secondary text-white'>
                        <div class='card-body'>
                          $libelle<br/>
                        </div>
                        <div classe='card-body1'>
                          $desc
                          <br/> Lieu : $lieu
                          <br/> Type de contrat : $typecontr
                          <br/> Salaire annuel en euros : $salaire
                          <br/> Date limite : $datelim
                          <br/> URL de la vidéo : $video
                          <br/> Compétences : $competence";
              while($ligne = mysqli_fetch_array($resultat))
              {
                if($libelle != $ligne['libelle_offre']){
                  echo '</div></div></div>';
                  echo "
                  <div class='container1'>
                    <div class='row'>
                      <div class='col-sm-4'>
                        <div class='btn-group-vertical'>
                          <a href='#' class='btn btn-info' role='button'>Réception de candidatures</a>
                          <a href='creation_offre.php' class='btn btn-info' role='button'>Modifier</a>
                          <input type='submit' class='btn btn-info' value='Supprimer'>
                        </div>
                      </div>
                    </div>
                  </div>";
                  $libelle = $ligne['libelle_offre'];
                  $desc=$ligne['description'];
                  $lieu=$ligne['lieu'];
                  $typecontr=$ligne['type_contrat'];
                  $salaire= $ligne['salaire'];
                  $datelim=$ligne['date_limite'];
                  $video=$ligne['video'];
                  $competence = $ligne['libelle'];
                  echo"<div class='col-sm-8'>
                          <div class='card bg-secondary text-white'>
                            <div class='card-body'>
                              $libelle<br/>
                            </div>
                            <div classe='card-body1'>
                              $desc
                              <br/> Lieu : $lieu
                              <br/> Type de contrat : $typecontr
                              <br/> Salaire annuel en euros : $salaire
                              <br/> Date limite : $datelim
                              <br/> URL de la vidéo : $video
                              <br/> Compétences :
                              <br /> - $competence";
                }
                else{
                  echo "<br />-".$ligne['libelle'];
                  $libelle = $ligne['libelle_offre'];
                  echo '<br/>
                  <br/>
                </div>
              </div>';
                }
             }
             echo "
             <div class='container1'>
               <div class='row'>
                 <div class='col-sm-4'>
                   <div class='btn-group-vertical'>
                     <a href='#' class='btn btn-info' role='button'>Réception de candidatures</a>
                     <a href='creation_offre.php' class='btn btn-info' role='button'>Modifier</a>
                     <input type='submit' class='btn btn-info' value='Supprimer'>
                   </div>
                 </div>
               </div>
             </div>";
             ?>
          </div>
        </div>

    </body>
    <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </html>
<?php
mysqli_close($connexion);
 ?>
