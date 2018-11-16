<html>
    <head>
        <title>Création_Candidature :</title>
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
              <a class='nav-link' href='consulter_profil_candidat.php?langue=$langue'>$str[44]</a>
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

    <form action="creation_candidature.php" method="post">
      <h1> Postuler à une offre : </h1>
        <div id='conteneur01'>

    <?php

    //afficher le nom du candidat
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

    include 'bdd/bdd.php';
    $id = -1;
    $_GET["id_offre"]=1;
    if (isset ($_GET["id_offre"])){

      $id_offre=$_GET["id_offre"];
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
                  $libelle<br/>
                  $desc
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

    //récupère cv video et lm en fonction de l'offre
    $re= mysqli_query($connexion, "SELECT docs.libelle, docs.id FROM docs INNER JOIN necessite N ON docs.id=N.id INNER JOIN offre_emplois O ON O.id_offre= N.id_offre WHERE O.id_offre= $id_offre;");

    while ($ligne=mysqli_fetch_array($re,MYSQLI_BOTH)){
      $ids=$ligne['id'];
      $libel=$ligne['libelle'];

      echo "<div>
            <h3>$libel :</h3>

            <input type='hidden' name='MAX_FILE_SIZE' value='1048576' />
            <input type='file' name='$ids' /><br />

          </div>";
      }
}
     ?>

      <div>
        <input type="submit" name="soumettre" value="Ajouter/Valider"/>
      </div>
    </div>
  </form>
</body>
</html>
