<html>
    <head>
        <title>Consultation des offres  :</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="style/style.css" rel="stylesheet">
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
              <li class='nav-item active'>
                <a class='nav-link' href='consultation_offre_rh.php?langue=fr'>$str[2]</a>
              </li>
              <li class='nav-item '>
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
                  <a class='dropdown-item' href='consultation_offre_rh.php?langue=fr'>$str[6]</a>
                  <a class='dropdown-item' href='consultation_offre_rh.php?langue=en'>$str[7]</a>
                </div>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='#'>$str[8]</a>
              </li>
            </ul>
          </div>
        </nav>";
        ?>
        <div class="container-fluid">
          <div class="row content">
            <div class='col-sm-4'>
            </div>
            <div classe='col-sm-4'>
              <?php
              include 'bdd/bdd.php';

              //$resultat=mysqli_query($connexion, 'SELECT offre_emplois.id_offre, offre_emplois.libelle as libelle_offre, description, lieu, type_contrat, salaire, date_limite, video, competence.libelle FROM offre_emplois INNER JOIN posseder ON offre_emplois.id_offre = posseder.id_offre INNER JOIN competence ON posseder.id_competence = competence.id_competence ORDER BY offre_emplois.libelle'); /*permet d'afficher les données*/
              $resultat=mysqli_query($connexion, 'SELECT offre_emplois.id_offre, offre_emplois.libelle as libelle_offre, description, lieu, type_contrat, salaire, date_limite, video, competence.libelle, supprimer FROM offre_emplois INNER JOIN posseder ON offre_emplois.id_offre = posseder.id_offre INNER JOIN competence ON posseder.id_competence = competence.id_competence WHERE supprimer = 0 ORDER BY offre_emplois.libelle'); /*permet d'afficher les données*/

              $id = -1; //index impossible
              while($ligne = mysqli_fetch_array($resultat, MYSQLI_BOTH)){
                $id_offre=$ligne['id_offre'];
                $id_datelim=$ligne['date_limite'];

                $datetime = date("Y-m-d ");
                if ($datetime< $id_datelim) {
                  if($id_offre!=$id){ // si id est différents de l'autre id
                    if ($id!=-1) {
                      // on affiche le bouton
                      echo "</div>
                            <div class='btn-group text-center'>
                            <a href='#?id=$id' id='$id' class='candidature'>$str[16]</a>
                            <a href='#?id=$id' id='$id' class='modifier'>$str[15]</a>
                            <a href='crud/supprimer.php?id=$id' id='$id' class='supprimer'>$str[17]</a>
                            </div>

                            </div>";
                    }
                    $libelle = $ligne['libelle_offre'];
                    $desc=$ligne['description'];
                    $lieu=$ligne['lieu'];
                    $typecontr=$ligne['type_contrat'];
                    $salaire= $ligne['salaire'];
                    $datelim=$ligne['date_limite'];
                    $video=$ligne['video'];
                    $competence = $ligne['libelle'];

                    echo "
                            <div class='card bg-secondary text-white'>
                              <div class='card-body'>
                                $libelle<br/>
                              </div>
                              <div classe='card-body1'>
                                <p>$desc
                                <br/> $str[9] : $lieu
                                <br/> $str[10] : $typecontr
                                <br/> $str[11] : $salaire
                                <br/> $str[12] : $datelim
                                <br/> $str[13] : $video
                                <br/> $str[14] : <br/> - $competence";
                  }
                  else{
                    $competence = $ligne['libelle'];
                    echo "<br />- $competence";

                  }
                $id=$id_offre;
              }
            }
              echo "</div>
                    <div class='btn-group text-center'>
                    <a href='#?id=$id' id='$id' class='candidature'>$str[16]</a>
                    <a href='#?id=$id' id='$id' class='modifier'>$str[15]</a>
                    <a href='crud/supprimer.php?id=$id' id='$id' class='supprimer'>$str[17]</a>
                    </div>
                    </div>";
              ?>
            </div>
            <div class='col-sm-4'>
            </div>
           </div>
         </div>

    </body>
    <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </html>
<?php
mysqli_close($connexion);
 ?>
