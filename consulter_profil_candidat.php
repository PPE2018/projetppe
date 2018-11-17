<html>
    <head>
        <title>Consulter profils :</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style/style.css">
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
            <li class='nav-item'>
              <a class='nav-link' href='consultation_offre_rh.php?langue=$langue'>$str[2]</a>
            </li>
            <li class='nav-item active'>
              <a class='nav-link' href='consulter_profil_candidat.php?langue=$langue'>$str[444]</a>
            </li>
          </ul>
          <ul class='navbar-nav ml-auto'>
            <li class='nav-item dropdown'>
              <a class='nav-link dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>$str[5]</a>
              <div class='dropdown-menu' aria-labelledby='dropdown05'>
                <a class='dropdown-item' href='creation_offre.php?langue=fr'>$str[6]</a>
                <a class='dropdown-item' href='creation_offre.php?langue=en'>$str[7]</a>
              </div>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='#'>$str[8]</a>
            </li>
          </ul>
        </div>
      </nav>";

      ?>

      <table class="table table-striped">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Offre :</th>
            <th scope="col">Date limite :</th>
            <th scope="col">Salaire</th>
            <th scope="col">Type de contrat</th>
            <th scope="col">CV :</th>
            <th scope="col">Lettre de motivation :</th>
            <th scope="col">Vidéo :</th>
            <th scope="col">Reçu :</th>

          </tr>
        </thead>
        <tbody>
      <!--  les offres avec sa fiche -->
      <?php

      //affiche le nom et prenom du candidat
      include 'bdd/bdd.php';
      $_SESSION["Candidat"]=1;
      if(isset($_SESSION["Candidat"])){
        $id_personne = $_SESSION["Candidat"];
        include 'bdd/bdd.php';

        $resultat= mysqli_query($connexion, "SELECT nom, prenom FROM candidat C WHERE id_personne=$id_personne ;");
        while($ligne = mysqli_fetch_array($resultat, MYSQLI_BOTH)){
          $nom=$ligne['nom'];
          $prenom=$ligne['prenom'];

          echo $nom."<br/>" .$prenom."<br/>" ;

        }
      }
      $id = -1;
      $_GET["id_offre"]=1;
      if (isset ($_GET["id_offre"])){

        $id_offre=$_GET["id_offre"];
        // affiche l'offre
        $resul=mysqli_query($connexion, "SELECT offre_emplois.id_offre, offre_emplois.libelle as libelle_offre, description, lieu, type_contrat, salaire, date_limite, video, competence.libelle FROM offre_emplois INNER JOIN posseder ON offre_emplois.id_offre = posseder.id_offre INNER JOIN competence ON posseder.id_competence = competence.id_competence WHERE offre_emplois.id_offre=$id_offre;");

        while($ligne = mysqli_fetch_array($resul, MYSQLI_BOTH)){
          echo '<tr>';
          $libelle = $ligne['libelle_offre'];
          $typecontr=$ligne['type_contrat'];
          $salaire= $ligne['salaire'];
          $date= $ligne['date_limite'];
          echo '<td>'.$libelle.'</td>';
          echo '<td>'.$date.'</td>';
          echo '<td>'.$salaire.'</td>';
          echo '<td>'.$typecontr.'</td>';
          echo '</tr>';

        }

    //
    //     while ($ligne=mysqli_fetch_array($resul,MYSQLI_BOTH)){
    //
    //       $libelle = $ligne['libelle_offre'];
    //       $typecontr=$ligne['type_contrat'];
    //       $salaire= $ligne['salaire'];
    //
    //       echo "
    //                 $libelle<br/>
    //                 $desc
    //                   <br/> $str[9] : $lieu
    //                   <br/> $str[10] : $typecontr
    //                   <br/> $str[11] : $salaire
    //                   <br/> $str[12] : $datelim
    //                   <br/> $str[13] : $video
    //                   <br/> $str[14] : <br/> - $competence";
    //     }
    //     else{
    //       $competence = $ligne['libelle'];
    //       echo "<br />- $competence";
    //   }
    //   $id=$id_offre;
    // }

  }
       ?>
     </tbody>
   </table>
<script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>


  </body>
</html>
