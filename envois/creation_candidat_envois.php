  <?php
// upluad
  include '../bdd/bdd.php';
  if(isset($_POST ['creer_candidat'])){
    //echo $_FILES['1']['name']." -- ".$_FILES['2']['name']." -- ".$_FILES['3']['name'] ;
    if((isset($_FILES['patate']) or isset($_FILES['2']) or isset($_FILES['3'])) and isset($_POST['offre']) and isset($_POST['session'])){
      echo "string";
      die();
      $offre=$_POST['offre'];
      $id_session=$_POST['session'];


      $datenow= now();
      $rqt="INSERT INTO candidature (date_candidature, reception, id_offre, id_personne) VALUES ($datenow,'false',$offre, $id_session) ;";
      $resultat = mysqli_query($connexion, $rqt);

      $requete="SELECT id_candidature FROM candidature WHERE date_candidature=$datenow AND reception= 'false'AND id_offre=$offre AND id_personne= $id_session;  ";
      $resultat = mysqli_query($connexion, $requete);
      while($ligne=mysqli_fetch_array($resultat,MYSQLI_BOTH)){
        $id=$ligne['id_candidature'];
      }
      $target_dir = "../upload/candidature/$id/";
      mkdir($target_dir);

      if(isset($_FILES['1'])){
        $target_file = $target_dir . basename($_FILES["1"]["name"]);
        $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if($_FILES['1']['size']<50000000 && $FileType="pdf"){
          move_uploaded_file($_FILES["1"]["tmp_name"], $target_file);
        }
        $requete = "INSERT INTO deposer(id,id_candidature,url) VALUES (1,$id,$target_file)";
        $resultat = mysqli_query($connexion, $requete);
      }

      if(isset($_FILES['2'])){
        $target_file = $target_dir . basename($_FILES["2"]["name"]);
        $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if($_FILES['2']['size']<50000000 && $FileType="pdf"){
          move_uploaded_file($_FILES["2"]["tmp_name"], $target_file);
        }
        $requete = "INSERT INTO deposer(id,id_candidature,url) VALUES (2,$id,$target_file)";
        $resultat = mysqli_query($connexion, $requete);
      }

      if(isset($_FILES['3'])){
        $target_file = $target_dir . basename($_FILES["3"]["name"]);
        $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if($_FILES['3']['size']<50000000 && $FileType="mp4"){
          move_uploaded_file($_FILES["3"]["tmp_name"], $target_file);
        }
        $requete = "INSERT INTO deposer(id,id_candidature,url) VALUES (3,$id,$target_file)";
        $resultat = mysqli_query($connexion, $requete);
      }

      echo "string";

    }
  }
   ?>
