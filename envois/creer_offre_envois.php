<html>
<head>
    <title>Bootstrap template</title>
    <meta charset="utf-8">
    <link href="style/style.css" rel="stylesheet">
</head>
<body>
    <?php
        include '../bdd/bdd.php';


        //// TODO: Recuperer les données du formulaire via post

        if(isset($_POST['date_depots'])){
            $dateLimite = $_POST['date_depots'];
            echo $dateLimite;
            echo '<br />';
        }

        //// TODO: FAIRE DES ATTRIBUTS DANS BDD : Lieu, Type de contrat, et vrai decription
        if(isset($_POST['description'])){
            $description = $_POST['description'];
            echo $description;
            echo '<br />';
        }

        if(isset($_POST['lieu'])){
            $lieu = $_POST['lieu'];
            echo $lieu;
            echo '<br />';
        }

        if(isset($_POST['salaire'])){
            $salaire = $_POST['salaire'];
            echo $salaire;
            echo '<br />';
        }

        if(isset($_POST['contrat'])){
            $contrat = $_POST['contrat'];
            echo $contrat;
            echo '<br />';
        }

        //id du RH
        $idPersonne = 4;
        if(isset($_POST['id_personne'])){
            $idPersonne = $_POST['id_personne'];
        }

        //Titre
        if(isset($_POST['nom_post'])){
            $lib = $_POST['nom_post'];
            echo $lib;
            echo '<br />';
        }

        if(isset($_POST['url'])){
            $video = $_POST['url'];
            echo $video;
            echo '<br />';
        }

        //TODO
        //id_personne dependra de la session de l'utilisateur
        $requete = "INSERT INTO offre_emplois(date_limite, description, id_personne, libelle, video, lieu, salaire, type_contrat) VALUES ('$dateLimite', '$description', $idPersonne, '$lib', '$video', '$lieu', $salaire, '$contrat')";
        echo $requete;
        $resultat = mysqli_query($connexion, $requete);

        if(isset($_POST['doc_cv'])){
            $doc_cv = true;
            echo '<br />';
        }
        else{
          $doc_cv = false;
        }

        if(isset($_POST['doc_lm'])){
            $doc_lm = true;
            echo '<br />';
        }
        else{
          $doc_lm = false;
        }

        if(isset($_POST['doc_video'])){
            $doc_video = true;
            echo '<br />';
        }
        else{
          $doc_video = false;
        }

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

        $erreur = false;
        if(!$resultat)
            $erreur = true;

        //Message de réussite
        if($erreur){
            echo 'L\'envoi a échoué';
        }
        else{
            echo 'L\'offre d\'emplois a bien été créer !<br />';
        }
        echo '<a href="../ajout.php">Retour</a>';
    ?>
</body>
</html>
