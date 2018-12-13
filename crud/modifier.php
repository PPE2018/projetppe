<?php
session_start();
if($_SESSION['admin'] != 20){
  header("location: consultation_offre.php");
}
else{
  ?>
<html>
    <head>
        <title>Création_Offre :</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../style/style.css">
    </head>
    <body>
      <?php
      $id = $_GET['id'];
      $langue = 'fr';

      if (isset($_GET['langue']))
        $langue = $_GET['langue'];
      include "../langue_".$langue.".php";
      ?>
          <nav class='navbar sticky-top navbar-expand-lg navbar-dark bg-dark'>
          <a class='navbar-brand' href='#'><?php echo $str[1]?></a>
          <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarsExample05' aria-controls='navbarsExample05' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
          </button>

          <div class='collapse navbar-collapse' id='navbarsExample05'>
            <ul class='navbar-nav mr-auto'>
              <li class='nav-item'>
                <a class='nav-link' href='../consultation_offre.php?langue=<?php echo $langue ?>'><?php echo $str[2]?></a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='../creation_offre.php?langue=<?php echo $langue ?>'><?php echo $str[3]?></a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='../reception_cand_rh.php?langue=<?php echo $langue ?>'><?php echo $str[4]?></a>
              </li>
            </ul>
            <ul class='navbar-nav ml-auto'>
              <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><?php echo $str[5]?></a>
                <div class='dropdown-menu' aria-labelledby='dropdown05'>
                  <a class='dropdown-item' href='modifier.php?id=<?php echo $id ?>&amp;langue=fr'><?php echo $str[6]?></a>
                  <a class='dropdown-item' href='modifier.php?id=<?php echo $id ?>&amp;langue=en'><?php echo $str[7]?></a>
                </div>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='#'><?php echo $str[8]?></a>
              </li>
            </ul>
          </div>
        </nav>

        <?php
        if (isset($_GET['langue']))
          $langue = $_GET['langue'];
        include "../langue_".$langue.".php";
        include '../bdd/bdd.php';

        //ID de l'offre à modifier
        if(isset($_GET['id'])){
            $id_offre = $_GET['id'];
        }

        //$resultat=mysqli_query($connexion, "SELECT offre_emplois.id_offre, offre_emplois.libelle as libelle_offre, description, lieu, type_contrat, salaire, date_limite, video, competence.libelle, supprimer FROM offre_emplois INNER JOIN posseder ON offre_emplois.id_offre = posseder.id_offre INNER JOIN competence ON posseder.id_competence = competence.id_competence WHERE supprimer = 0 AND offre_emplois.id_offre = $id ORDER BY offre_emplois.libelle"); /*permet d'afficher les données*/
        $resultat=mysqli_query($connexion, "SELECT offre_emplois.id_offre, offre_emplois.libelle as libelle_offre, description, lieu, type_contrat, salaire, date_limite, video, supprimer FROM offre_emplois WHERE supprimer = 0 AND offre_emplois.id_offre = $id_offre ORDER BY offre_emplois.libelle");
        while($ligne = mysqli_fetch_array($resultat, MYSQLI_BOTH)){

        ?>
        <div class='container'>
        <h1><?php $str[18] ?></h1>
          <form action='../envois/modif_envois.php?id=<?php echo $id ?>&amp;langue=<?php echo $langue?>' method='post'>
              <!-- Saisie de l'Intitulé du post-->
              <div class='form-group'>
                 <label for='nom_post'><?php echo $str[19] ?> :</label>
                  <input type='text' class='form-control' name='nom_post' value='<?php echo $ligne['libelle_offre']; ?>'/>
              </div>

              <!-- Description du poste -->
              <div class='form-group'>
                <label for='description'><?php echo $str[20] ?> :</label>
                <textarea name='description' class='form-control' rows=4 cols=40><?php echo $ligne['description']; ?></textarea>
              </div>

              <!-- Saisie du type post-->
              <?php
              $cdiChecked = '';
              $cddChecked = '';
              $interimChecked = '';
              if($ligne['type_contrat'] == 'CDI'){
                $cdiChecked = 'checked';
              }
              if($ligne['type_contrat'] == 'CDD'){
                $cddChecked = 'checked';
              }
              if($ligne['type_contrat'] == 'Interim'){
                $interimChecked = 'checked';
              }
              ?>
              <div class='form-group'>
                <label for='description'><?php echo $str[21] ?> :</label><br />
                <div class='form-check form-check-inline'>
                <input class='form-check-input' type='radio' name='contrat' value='CDI' id='CDI' <?php echo $cdiChecked ?>>
                  <label class='form-check-label' for='CDI'>
                      <?php echo $str[22] ?>
                  </label>
                </div>
                <div class='form-check form-check-inline'>
                  <input class='form-check-input' type='radio' name='contrat' value='CDD' id='CDD' <?php echo $cddChecked ?>>
                  <label class='form-check-label' for='CDD'>
                      <?php echo $str[23] ?>
                  </label>
                </div>
                <div class='form-check form-check-inline'>
                  <input class='form-check-input' type='radio' name='contrat' value='Interim' id='Interim' <?php echo $interimChecked ?>>
                  <label class='form-check-label' for='Interim'>
                      <?php echo $str[24] ?>
                  </label>
                </div>
              </div>

              <!-- Saisie Compétences-->
              <div class='form-group'>
                <label for='competences'><?php echo $str[25] ?> :</label>
                <small id='passwordHelpBlock' class='form-text text-muted'>
                  <?php echo $str[26] ?>
                </small>

                  <?php
                  $requete2 = "SELECT id_competence FROM posseder WHERE id_offre = $id;";
                  $resultat2 = mysqli_query($connexion, $requete2);
                  $tableauCompetences = array();
                  $i=0;
                  while ($ligne2 = mysqli_fetch_array($resultat2, MYSQLI_BOTH)){
                    $tableauCompetences[$i] = $ligne2['id_competence'];
                    $i++;
                  }
                  ?>
                  <select class='form-control' name='competences[]' multiple>";
                  <?php
                  $requete3 = "SELECT id_competence, libelle FROM competence;";
                  $resultat3 = mysqli_query($connexion, $requete3);
                  while ($ligne3 = mysqli_fetch_array($resultat3, MYSQLI_BOTH)){
                    $checked = "";
                    if(in_array($ligne3['id_competence'], $tableauCompetences)){
                      $checked = "selected='selected'";
                    }
                    ?>
                      <option value="<?php echo $ligne3['id_competence']; ?>" <?php echo $checked ?>><?php echo $ligne3['libelle'] ?></option>';
                  <?php
                  }
                  ?>

                </select>
                <br />

              <!-- Saisie le lieu-->
              <div class='form-group'>
                <label for='lieu'><?php echo $str[28] ?> :</label>
                  <input type='text' class='form-control' name='lieu' value='<?php echo $ligne['lieu'] ?>'/>
              </div>

              <!-- Saisie du salaire-->
              <div class='form-group'>
                <label for='salaire'><?php echo $str[29] ?>  :</label>
                  <input type='number' class='form-control' name='salaire' value='<?php echo $ligne['salaire']; ?>' min='0' />
              </div>

              <!-- Saisie de la date limite de dépots-->
              <div class='form-group'>
                <label for='date'><?php echo $str[30] ?>  :</label>
                <input type='date' class='form-control' name='date_depots' value='<?php echo $ligne['date_limite']; ?>'>
              </div>

              <!-- Saisie documents a fournir (cases à cocher)-->
              <?php
              $cvChecked = '';
              $lmChecked = '';
              $videoChecked = '';
              if($ligne['type_contrat'] == 'CDI'){
                $cvChecked = 'checked';
              }
              if($ligne['type_contrat'] == 'CDD'){
                $lmChecked = 'checked';
              }
              if($ligne['type_contrat'] == 'Interim'){
                $videoChecked = 'checked';
              }
              ?>
              <div class='form-group'>
                <label for='documents'><?php echo $str[31] ?> :</label><br />
                <div class='form-check form-check-inline'>
                <input class='form-check-input' type='checkbox' name='doc_cv' value='doc_cv' id='doc_cv' <?php echo $cvChecked ?>>
                  <label class='form-check-label' for='doc_cv'>
                    <?php echo $str[32] ?>
                  </label>
                </div>
                <div class='form-check form-check-inline'>
                  <input class='form-check-input' type='checkbox' name='doc_lm' value='doc_lm' id='doc_lm' <?php echo $lmChecked ?>>
                  <label class='form-check-label' for='doc_lm'>
                    <?php echo $str[33] ?>
                  </label>
                </div>
                <div class='form-check form-check-inline'>
                  <input class='form-check-input' type='checkbox' name='doc_video' value='doc_video' id='doc_video' <?php echo $videoChecked ?>>
                  <label class='form-check-label' for='doc_video'>
                      <?php echo $str[34] ?>
                  </label>
                </div>
              </div>

              <!-- Saisie vidéo en url-->
              <div class='form-group'>
                <label for='url'><?php echo $str[35] ?>:</label>
                <input type='url' class='form-control' name='url' value='<?php echo $ligne['video']; ?>' />
              </div>
              <!-- Bouton-->
              <div>
                <input type='submit' class='btn btn-primary' name='creer_offre' value='<?php echo $str[36] ?>'/>
              </div>
        </form>
      </div>
      <?php
        }
      ?>
    </body>
    <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</html>
<?php } ?>
