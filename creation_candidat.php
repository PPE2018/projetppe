<?php
  session_start();
  if($_SESSION['admin'] != 10){
    header("location: consultation_offre.php");
  }
  else{
?>
<html>
    <head>
        <title>Création_Candidature :</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style/style.css">
        <link rel="stylesheet" href="creation_candidat.css">
        <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
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
                <a class='dropdown-item' href='creation_candidat.php?langue=fr'>$str[6]</a>
                <a class='dropdown-item' href='creation_candidat.php?langue=en'>$str[7]</a>
              </div>
            </li>";
            if($_SESSION['admin'] == 10){
            ?>
            <li class='nav-item dropdown'>
              <a class='nav-link dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><?php echo $str[8] ?></a>
              <div class='dropdown-menu' aria-labelledby='dropdown05'>
                <a class='dropdown-item' href=consulter_profil_candidat.php><?php echo $str[63] ?></a>
                <a class='dropdown-item' href='login/disconnect.php?langue=<?php echo $langue ?>'><?php echo $str[62] ?></a>
              </div>
            </li>
            <?php
            }
            ?>
          </ul>
        </div>
      </nav>
<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-4">
    </div>
    <div class="col-sm-4 text-left">
    <form action="envois/creation_candidat_envois.php" method="post" enctype="multipart/form-data">
      <!-- <div classe="contener">
        <div classe="boxe"> -->
            <h2> <?php echo" $str[51]" ?> </h2>
            <?php
            include 'bdd/bdd.php';
            $id = -1;
            if (isset ($_GET["id"])){

              $id_offre=$_GET["id"];
              // affiche l'offre
              $resul=mysqli_query($connexion, "SELECT offre_emplois.id_offre, offre_emplois.libelle as libelle_offre, description, lieu, type_contrat, salaire, date_limite, video, competence.libelle FROM offre_emplois INNER JOIN posseder ON offre_emplois.id_offre = posseder.id_offre INNER JOIN competence ON posseder.id_competence = competence.id_competence WHERE offre_emplois.id_offre=$id_offre;");

              while ($ligne=mysqli_fetch_array($resul,MYSQLI_BOTH)){
                if($id_offre!=$id){
                  if($id!=-1){

                  }

                $libelle = $ligne['libelle_offre'];
                $desc=$ligne['description'];
                $lieu=$ligne['lieu'];
                $typecontr=$ligne['type_contrat'];
                $salaire= $ligne['salaire'];
                $datelim=$ligne['date_limite'];
                $video=$ligne['video'];
                $competence =$ligne['libelle'];

                echo "
                          <h3>$libelle</h3><br/>
                          $desc
                            <br/> $str[9] : $lieu
                            <br/> $str[10] : $typecontr
                            <br/> $str[11] : $salaire
                            <br/> $str[12] : $datelim
                            <br/><a href='$video'> $str[13] </a>
                            <br/> $str[14] : <br/> - $competence";
              }
              else{
                $competence = $ligne['libelle'];
                echo "<br/>- $competence";
            }
            $id=$id_offre;
          }

          //afficher le nom du candidat
          if(isset($_SESSION["Candidat"])){
            $id_personne = $_SESSION["Candidat"];
            include 'bdd/bdd.php';

            $resultat= mysqli_query($connexion, "SELECT nom, prenom FROM candidat C WHERE id_personne=$id_personne ;");
            while($ligne = mysqli_fetch_array($resultat, MYSQLI_BOTH)){
              $nom=$ligne['nom'];
              $prenom=$ligne['prenom'];

              echo "<h3>".$nom." ".$prenom."</h3><br/>" ;

            }
          }

            //récupère cv video et lm en fonction de l'offre nagivate
            $re= mysqli_query($connexion, "SELECT docs.libelle, docs.id FROM docs INNER JOIN necessite N ON docs.id=N.id INNER JOIN offre_emplois O ON O.id_offre= N.id_offre WHERE O.id_offre= $id_offre;");

            while ($ligne=mysqli_fetch_array($re,MYSQLI_BOTH)){
              $ids=$ligne['id'];
              $libel=$ligne['libelle'];

              echo "<div>
                    <h3>$libel :</h3>

                    <input type='hidden' name='MAX_FILE_SIZE' value='30000000000000' >
                    <input type='file' name='$ids' ><br />

                  </div> </br>";
              }

        }

             ?>
             <input type="hidden" name="offre" value ="<?php echo "$id_offre"?>">
             <input type="hidden" name="session" value ="<?php echo "  $id_personne "?>">
             <div>
               <input type="submit" name="creer_candidat" value="<?php echo" $str[50]" ?>">
             </div>

  </form>
</div>
</div>
</body>

</html>
<?php }?>
