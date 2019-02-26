<?php
  session_start();
  if(!isset($_SESSION['admin'])){
    $_SESSION['admin'] = 0;
  }
?>
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
      ?>
          <nav class='navbar sticky-top navbar-expand-lg navbar-dark bg-dark'>
          <a class='navbar-brand' href='#'><?php echo $str[1]?></a>
          <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarsExample05' aria-controls='navbarsExample05' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
          </button>

          <div class='collapse navbar-collapse' id='navbarsExample05'>
            <ul class='navbar-nav mr-auto'>
              <li class='nav-item active'>
                <a class='nav-link' href='consultation_offre.php?langue=<?php echo $langue ?>'><?php echo$str[2]?></a>
              </li>
              <?php
              if($_SESSION['admin'] == 20){
              ?>
              <li class='nav-item '>
                <a class='nav-link' href='creation_offre.php?langue=<?php echo $langue ?>'><?php echo$str[3]?></a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='reception_cand_rh.php?langue=<?php echo $langue ?>'><?php echo$str[4]?></a>
              </li>
            <?php } ?>
            </ul>
            <ul class='navbar-nav ml-auto'>
              <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><?php echo$str[5]?></a>
                <div class='dropdown-menu' aria-labelledby='dropdown05'>
                  <a class='dropdown-item' href='consultation_offre.php?langue=fr'><?php echo $str[6]?></a>
                  <a class='dropdown-item' href='consultation_offre.php?langue=en'><?php echo $str[7]?></a>
                </div>
              </li>
              <?php

              if($_SESSION['admin'] == 20){
              ?>
              <li class='nav-item'>
                <a class='nav-link' href='login/disconnect.php?langue=<?php echo $langue ?>'><?php echo $str[62] ?></a>
              </li>

              <?php
              }
              if($_SESSION['admin'] == 10){
              ?>
              <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><?php echo $str[8] ?></a>
                <div class='dropdown-menu' aria-labelledby='dropdown05'>
                  <a class='dropdown-item' href=consulter_profil_candidat.php><?php echo $str[16] ?></a>
                  <a class='dropdown-item' href='login/disconnect.php?langue=<?php echo $langue ?>'><?php echo $str[62] ?></a>
                </div>
              </li>
              <?php
              }

              if($_SESSION['admin'] == 0){
              ?>
                <li class='nav-item'>
                  <a class='nav-link' href='login/connexion.php?langue=<?php echo $langue ?>'><?php echo $str[888] ?></a>
                </li>
              <?php
              }
              ?>
            </ul>
          </div>
        </nav>
              <?php
              include 'bdd/bdd.php';
              //$resultat=mysqli_query($connexion, 'SELECT offre_emplois.id_offre, offre_emplois.libelle as libelle_offre, description, lieu, type_contrat, salaire, date_limite, video, competence.libelle FROM offre_emplois INNER JOIN posseder ON offre_emplois.id_offre = posseder.id_offre INNER JOIN competence ON posseder.id_competence = competence.id_competence ORDER BY offre_emplois.libelle'); /*permet d'afficher les données*/
              $resultat=mysqli_query($connexion, 'SELECT offre_emplois.id_offre, offre_emplois.libelle as libelle_offre, description, lieu, type_contrat, salaire, date_limite, video, competence.libelle, supprimer FROM offre_emplois INNER JOIN posseder ON offre_emplois.id_offre = posseder.id_offre INNER JOIN competence ON posseder.id_competence = competence.id_competence WHERE supprimer = 0 ORDER BY offre_emplois.libelle'); /*permet d'afficher les données*/
              echo "
              <div class='container'>
              <div class='row'>
              ";

              $id = -1; //index impossible
              $i= 0;
              while($ligne = mysqli_fetch_array($resultat, MYSQLI_BOTH)){
                $id_offre=$ligne['id_offre'];
                $id_datelim=$ligne['date_limite'];

                $datetime = date("Y-m-d ");
                if ($datetime< $id_datelim) {
                  if($id_offre!=$id){ // si id est différents de l'autre id
                    if ($id!=-1) {
                      // on affiche le bouton
                      echo "</div>
                            </p>
                            <div class='card-footer'>
                              <p class='text-center'>";
                      if($_SESSION['admin'] == 20){
                        echo "<a href='reception_cand_rh.php?id=$id&amp;langue=$langue' id='$id' class='candidature'>$str[16]</a>
                        <a href='crud/modifier.php?id=$id&amp;langue=$langue' id='$id' class='modifier'>$str[15]</a>
                        <a href='crud/supprimer.php?id=$id&amp;langue=$langue' id='$id' class='supprimer' onclick='return confirm('Etes-vous sûr ?')'>$str[17]</a>";
                      }

                      if($_SESSION['admin'] == 10){
                        echo "<a href='creation_candidat.php?id=$id&amp;langue=$langue' id='$id' class='modifier'>$str[63]</a>";
                      }
                      echo"        </p>
                            </div>
                          </div>
                        </div>
                      </div>
                            ";
                    }
                    $libelle = $ligne['libelle_offre'];
                    $desc=$ligne['description'];
                    $lieu=$ligne['lieu'];
                    $typecontr=$ligne['type_contrat'];
                    $salaire= $ligne['salaire'];
                    $datelim=$ligne['date_limite'];
                    $datelim=date("d/m/Y");
                    $video=$ligne['video'];
                    $competence = $ligne['libelle'];

                    echo "
                            <div class='col-lg-12'>
                              <div class='boite'>
                                <div class='card'>
                                <div class='card-header' style='text-align: center;'>
                                  <h5 class='card-title'><b>$libelle</b></h5>
                                </div>
                                  <div class='card-body'>
                                    <p class='card-text'>
                                      <p>$desc</p>

                                      <b>$str[9] :</b> $lieu
                                      <br/> <b>$str[10] :</b> $typecontr
                                      <br/> <b>$str[11] :</b> $salaire
                                      <br/> <b>$str[12] :</b> $datelim
                                      <br /><a href='$video'><b>$str[13]</b></a>
                                      <br/> <b>$str[14] :</b> <br/> - $competence


                                ";

                  }
                  else{
                    $competence = $ligne['libelle'];
                    echo "<br />- $competence";

                  }
                $id=$id_offre;
              }
            }
            echo "</div>
                  </p>
                  <div class='card-footer'>
                    <p class='text-center'>";
            if($_SESSION['admin'] == 20){
              echo "<a href='reception_cand_rh.php?id=$id&amp;langue=$langue' id='$id' class='candidature'>$str[16]</a>
              <a href='crud/modifier.php?id=$id&amp;langue=$langue' id='$id' class='modifier'>$str[15]</a>
              <a href='crud/supprimer.php?id=$id&amp;langue=$langue' id='$id' class='supprimer' onclick='return confirm('Etes-vous sûr ?')'>$str[17]</a>";
            }
            if($_SESSION['admin'] == 10){
              echo "<a href='creation_candidat.php?id=$id&amp;langue=$langue' id='$id' class='modifier'>$str[63]</a>";
            }

            echo"        </p>
                  </div>
                </div>
              </div>
            </div>
                  ";
              ?>
    </body>
    <script src="bootstrap/js/jQuery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </html>
