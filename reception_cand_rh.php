<?php
session_start();
if($_SESSION['admin'] != 20){
  header("location: consultation_offre.php");
}
else{
  ?>
<html>
    <head>
        <title>Réception candidatures  :</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="style/consultation_offre_rh.css" rel="stylesheet">
    </head>
    <body>
      <?php
      $langue = 'fr';
      if (isset($_GET['langue']))
        $langue = $_GET['langue'];
      include "langue_".$langue.".php";
      ?>
      <nav class='navbar sticky-top navbar-expand-lg navbar-dark bg-dark'>
      <a class='navbar-brand' href='#'><?php echo $str[1] ?></a>
      <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarsExample05' aria-controls='navbarsExample05' aria-expanded='false' aria-label='Toggle navigation'>
        <span class='navbar-toggler-icon'></span>
      </button>

      <div class='collapse navbar-collapse' id='navbarsExample05'>
        <ul class='navbar-nav mr-auto'>
          <li class='nav-item'>
            <a class='nav-link' href='consultation_offre.php?langue=<?php echo $langue ?>'><?php echo $str[2] ?></a>
          </li>
          <li class='nav-item'>
            <a class='nav-link' href='creation_offre.php?langue=<?php echo $langue ?>'><?php echo $str[3] ?></a>
          </li>
          <li class='nav-item active'>
            <a class='nav-link' href='reception_cand_rh.php?langue=<?php echo $langue ?>'><?php echo $str[4] ?></a>
          </li>
        </ul>
        <ul class='navbar-nav ml-auto'>
          <li class='nav-item dropdown'>
            <a class='nav-link dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><?php echo $str[5] ?></a>
            <div class='dropdown-menu' aria-labelledby='dropdown05'>
              <a class='dropdown-item' href='reception_cand_rh.php?langue=fr'><?php echo $str[6] ?></a>
              <a class='dropdown-item' href='reception_cand_rh.php?langue=en'><?php echo $str[7] ?></a>
            </div>
          </li>
          <li class='nav-item'>
            <a class='nav-link' href='#'><?php echo $str[8] ?></a>
          </li>
        </ul>
      </div>
    </nav>
    <br />
    <div class='container'>
      <div class='row'>
        <?php
        include "bdd/bdd.php";
        //ID de l'offre
        if(isset($_GET['id'])){
            $id_offre = $_GET['id'];
            $requete =
            $resultat=mysqli_query($connexion, "SELECT id_candidature, date_candidature, libelle, nom, prenom, reception FROM candidature INNER JOIN PERSONNE ON personne.id_personne = candidature.id_personne INNER JOIN offre_emplois ON offre_emplois.id_offre = candidature.id_offre WHERE offre_emplois.id_offre = $id_offre GROUP BY date_candidature DESC");
        }
        else{
          $resultat=mysqli_query($connexion, 'SELECT id_candidature, date_candidature, libelle, nom, prenom, reception FROM candidature INNER JOIN PERSONNE ON personne.id_personne = candidature.id_personne INNER JOIN offre_emplois ON offre_emplois.id_offre = candidature.id_offre GROUP BY date_candidature DESC');
        }
        ?>
        <table class="table table-striped">
          <thead class="thead-dark">
            <tr>
              <th scope="col"><?php echo $str[37] ?></th>
              <th scope="col"><?php echo $str[38] ?></th>
              <th scope="col"><?php echo $str[39] ?></th>
              <th scope="col"><?php echo $str[40] ?></th>
              <th scope="col"><?php echo $str[41] ?></th>
              <th scope="col"><?php echo $str[42] ?></th>
            </tr>
          </thead>
          <tbody>
            <?php
            while($ligne = mysqli_fetch_array($resultat, MYSQLI_BOTH)){
              echo '<tr>';
              $date = $ligne['id_candidature'];
              $date = date("d/m/Y");
              $id = $ligne['id_candidature'];
              echo '<td>'.$id.'</td>';
              echo '<td>'.$date.'</td>';
              echo '<td>'.$ligne['libelle'].'</td>';
              echo '<td>'.$ligne['nom'].'</td>';
              echo '<td>'.$ligne['prenom'].'</td>';
              if($ligne['reception'] == 0){
                echo "<td><a href='crud/offre_vu.php?id=$id&amp;langue=$langue' id='$id' class='a_verifier'>$str[43]</a></td>";
              }
              else{
                echo "<td><a href='#?id=$id' id='$id' class='verifie'>$str[44]</a></td>";
              }
              echo '</tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

  </body>
  <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
</html>
<?php } ?>
