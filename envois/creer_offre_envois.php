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

        if(isset($_POST['doc_cv'])){
            $doc_cv = true;
            echo $doc_cv;
            echo '<br />';
        }

        if(isset($_POST['doc_lm'])){
            $doc_cv = true;
            echo $doc_cv;
            echo '<br />';
        }

        if(isset($_POST['doc_video'])){
            $doc_cv = true;
            echo $doc_cv;
            echo '<br />';
        }

        //id du RH
        if(isset($_POST['id_personne'])){
            $idPersonne = $_POST['id_personne'];
            $idPersonne = 0;
            echo $idPersonne;
            echo '<br />';
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
        $requete = "INSERT INTO offre_emplois(date_limite, description, id_personne, libelle, video) VALUES ('.$dateLimite.', '.$description.', '.$idPersonne.', '.$lib.', '.$video.')";
        $resultat = mysqli_query($connexion, $requete);

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
