<?php
  session_start();
  if($_SESSION['admin'] != 10){
    header("location: consultation_offre.php");
  }
  else{
?>
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
              <a class='nav-link' href='consultation_offre.php?langue=$langue'>$str[2]</a>
            </li>
            <li class='nav-item active'>
              <a class='nav-link' href='consulter_profil_candidat.php?langue=$langue'>$str[444]</a>
            </li>
          </ul>
          <ul class='navbar-nav ml-auto'>
            <li class='nav-item dropdown'>
              <a class='nav-link dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>$str[5]</a>
              <div class='dropdown-menu' aria-labelledby='dropdown05'>
                <a class='dropdown-item' href='consulter_profil_candidat.php?langue=fr'>$str[6]</a>
                <a class='dropdown-item' href='consulter_profil_candidat.php?langue=en'>$str[7]</a>
              </div>
            </li>";
            if(isset($_SESSION['admin']) == 10){
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
            ?>
          </ul>
        </div>
      </nav>
      <div class='container'>
        <div class='row'>
          <div class='col-lg-12'>
            <table class="table table-striped">
              <thead class="thead-dark">
                <tr>
                  <th scope="col"><?php echo "$str[52]"?></th>
                  <th scope="col"><?php echo "$str[53]"?></th>
                  <th scope="col"><?php echo "$str[54]"?></th>
                  <th scope="col"><?php echo "$str[55]" ?></th>
                  <th scope="col"><?php echo "$str[56]"?></th>
                  <th scope="col"><?php echo "$str[57]"?></th>
                  <th scope="col"><?php echo "$str[58]"?></th>
                  <th scope="col"><?php echo "$str[59]"?></th>


                </tr>
              </thead>
            <tbody>


      <!--  les offres avec sa fiche -->
      <?php
      $id_perso=1;
      $id=-1;
      $i=0;
      include 'bdd/bdd.php';

      $_SESSION["id_personne"]=1;
      if(isset($_SESSION["id_personne"])){
        $id_perso = $_SESSION["id_personne"];

        $resultat= mysqli_query($connexion,"SELECT offre_emplois.id_offre,offre_emplois.libelle, offre_emplois.type_contrat, offre_emplois.salaire, offre_emplois.date_limite, DE.url, DE.id, C.reception
                                            FROM offre_emplois
                                            INNER JOIN candidature C ON C.id_offre= offre_emplois.id_offre
                                            INNER JOIN deposer DE ON DE.id_candidature=C.id_candidature
                                            WHERE C.id_personne=$id_perso
                                            ORDER BY offre_emplois.id_offre , DE.id;" );
        while($ligne = mysqli_fetch_array($resultat, MYSQLI_BOTH)){
          $id_offre=$ligne['id_offre'];
          if ($id_offre!=$id){
            // if($id!=-1){
            //
            // }
            // affiche l'offre

            $libelle = $ligne['libelle'];
            $typecontr=$ligne['type_contrat'];
            $salaire= $ligne['salaire'];
            $date= $ligne['date_limite'];
            $url= $ligne['url'];
            $reception =$ligne ['reception'];

            echo "<tr>";
              if ($reception==1) {
                echo"<td><div class='container'>
                       <button type='button' class='btn btn-primary disabled'>$str[60]</button>
                       </div>
                     </td>";
              }
              else {
                echo"<td><div class='container'>
                       <button type='button' class='btn btn-danger disabled'>$str[61]</button>
                       </div>
                     </td>";
              }


               echo"<td>$libelle</td>
                    <td>$date</td>
                    <td>$salaire</td>
                    <td>$typecontr</td>
                    <td>$url</td>

                 ";



          }
          else{
            $url=$ligne ['url'];
            echo"<td>$url</td>
            ";

          }
          $id=$id_offre;

      }

      }

       ?>
     </tr>
     </tbody>
   </table>
 </div>
</div>
  </body>
  <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
</html>
<?php } ?>
