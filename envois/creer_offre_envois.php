<html>
<head>
    <title>Bootstrap template</title>
    <meta charset="utf-8">
    <link href="style/style.css" rel="stylesheet">
</head>
<body>
    <?php
        include '../bdd/bdd.php';
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
        $idPersonne = 4; //A CHANGGGGGGEEEEERRRR
        if(isset($_POST['id_personne'])){
            $idPersonne = $_POST['id_personne'];
        }

        //Titre
        if(isset($_POST['nom_post'])){
            $lib = $_POST['nom_post'];
        }

        //URL
        if(isset($_POST['url'])){
            $video = $_POST['url'];
        }

        //TODO
        //id_personne dependra de la session de l'utilisateur
        $requete = "INSERT INTO offre_emplois(date_limite, description, id_personne, libelle, video, lieu, salaire, type_contrat) VALUES ('$dateLimite', '$description', $idPersonne, '$lib', '$video', '$lieu', $salaire, '$contrat')";
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

        //Récupération de l'id de la dernière offre publié pour l'associer avec les documents
        $requete = "SELECT id_offre FROM OFFRE_EMPLOIS ORDER BY id_offre DESC LIMIT 1;";
        $resultat = mysqli_query($connexion, $requete);
        while ($ligne = mysqli_fetch_array($resultat, MYSQLI_BOTH)){
            $idOffre = $ligne['id_offre'];
        }

        if($doc_cv){
            $requete = "INSERT INTO NECESSITE(id, id_offre) VALUES (1, $idOffre)";
            $resultat = mysqli_query($connexion, $requete);
        }

        if($doc_lm){
            $requete = "INSERT INTO NECESSITE(id, id_offre) VALUES (2, $idOffre)";
            $resultat = mysqli_query($connexion, $requete);
        }

        if($doc_video){
            $requete = "INSERT INTO NECESSITE(id, id_offre) VALUES (3, $idOffre)";
            $resultat = mysqli_query($connexion, $requete);
        }

        //Réupération des compétences
        if(isset($_POST['competences']) && !empty($_POST['competences'])){
          $Col1_Array = $_POST['competences'];
          foreach($Col1_Array as $selectValue){
            $requete = "INSERT INTO POSSEDER(id_competence, id_offre) VALUES ($selectValue, $idOffre)";
            $resultat = mysqli_query($connexion, $requete);
           }
         }



        $erreur = false;
        if(!$resultat)
            $erreur = true;

        //Message de réussite
        if($erreur){
            echo 'L\'envoi a échoué';
        }
        else{
            echo 'L\'offre d\'emploi a bien été crée !<br />';
        }
        echo '<a href="../creation_offre.php">Retour</a>';
    ?>
</body>
</html>
