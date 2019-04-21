<html>
<head>
    <title>Bootstrap template</title>
    <meta charset="utf-8">
    <link href="style/style.css" rel="stylesheet">
</head>
<body>
    <?php
        session_start();
        include '../bdd/bdd.php';
        if(isset($_POST['creer_offre'])){
          if(isset($_POST['date_depots'])){
              $dateLimite = $_POST['date_depots'];
          }

          if(isset($_POST['description'])){
              $description = $_POST['description'];
          }

          if(isset($_POST['lieu'])){
              $lieu = $_POST['lieu'];
          }

          if(isset($_POST['salaire'])){
              $salaire = $_POST['salaire'];
          }

          if(isset($_POST['contrat'])){
              $contrat = $_POST['contrat'];
          }

          //id du RH
          if(isset($_SESSION['personne'])){
              $idPersonne = $_SESSION['personne'];
          }

          //Titre
          if(isset($_POST['nom_post'])){
              $lib = $_POST['nom_post'];
          }

          //URL
          if(isset($_POST['url'])){
              $video = $_POST['url'];
          }

          //ID de l'offre à modifier
          if(isset($_GET['id'])){
              $id_offre = $_GET['id'];
          }

          $requete = "UPDATE offre_emplois SET date_limite = '$dateLimite', description = '$description', id_personne = $idPersonne, libelle = '$lib', video = '$video', lieu = '$lieu', salaire = $salaire, type_contrat = '$contrat', supprimer = 0 WHERE id_offre = $id_offre";
          $resultat = mysqli_query($connexion, $requete);


          //Suppression des anciens document à fournir
          $requete = "DELETE FROM necessite WHERE id_offre = $id_offre";
          $resultat = mysqli_query($connexion, $requete);

          if(isset($_POST['doc_cv'])){
              $doc_cv = true;
          }
          else{
            $doc_cv = false;
          }

          if(isset($_POST['doc_lm'])){
              $doc_lm = true;
          }
          else{
            $doc_lm = false;
          }

          if(isset($_POST['doc_video'])){
              $doc_video = true;
          }
          else{
            $doc_video = false;
          }

          if($doc_cv){
              $requete = "INSERT INTO NECESSITE(id, id_offre) VALUES (1, $id_offre)";
              $resultat = mysqli_query($connexion, $requete);
          }

          if($doc_lm){
              $requete = "INSERT INTO NECESSITE(id, id_offre) VALUES (2, $id_offre)";
              $resultat = mysqli_query($connexion, $requete);
          }

          if($doc_video){
              $requete = "INSERT INTO NECESSITE(id, id_offre) VALUES (3, $id_offre)";
              $resultat = mysqli_query($connexion, $requete);
          }

          //Suppression des anciennes compétences requise
          $requete = "DELETE FROM posseder WHERE id_offre = $id_offre";
          $resultat = mysqli_query($connexion, $requete);

          //Réupération des compétences
          if(isset($_POST['competences']) && !empty($_POST['competences'])){
            $Col1_Array = $_POST['competences'];
            foreach($Col1_Array as $selectValue){
              $requete = "INSERT INTO POSSEDER(id_competence, id_offre) VALUES ($selectValue, $id_offre)";
              $resultat = mysqli_query($connexion, $requete);
             }
           }

          $erreur = false;
          if(!$resultat)

          $erreur = true;
          $langue= 'fr';
          if (isset($_GET['langue']))
            $langue = $_GET['langue'];
          include "../langue_".$langue.".php";

          //Message de réussite
          if($erreur){
              echo 'L\'envoi a échoué';
              echo '<br/ >Veuillez remplir tout les champs !';
          }
          else{
              echo 'L\'offre d\'emploi a bien été modifié !<br />';
          }
          echo "<br /><a href='../consultation_offre.php?langue=$langue'>Retour</a>";

        }
        if(isset($_POST['ajoutCompetence'])){
          if(isset($_POST['libelle'])){
              $libelle = $_POST['libelle'];
          }
          $requete = "INSERT INTO competence(libelle) VALUES ('$libelle')";
          $resultat = mysqli_query($connexion, $requete);

          $erreur = false;
          if(!$resultat)
              $erreur = true;

          //Message de réussite
          if($erreur){
              echo 'L\'envoi a échoué';
          }
          else{
              echo 'La compétence à bien été ajouter<br />';
          }
        }
    ?>
</body>
</html>
