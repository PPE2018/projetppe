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
        }

        //// TODO: FAIRE DES ATTRIBUTS DANS BDD : Lieu, Type de contrat, et vrai decription
        if(isset($_POST['description'])){
            $description = $_POST['description'];
            echo $description
        }

        //Id qui relie à la table docs (avec bool)
        if(isset($_POST['id_docs_offre'])){
            $idDocsOffre = $_POST['id_docs_offre'];
        }

        //id du RH
        if(isset($_POST['id_personne'])){
            $idPersonne = $_POST['id_personne'];
            $idPersonne = 0;
        }

        //Titre
        if(isset($_POST['nom_post'])){
            $lib = $_POST['nom_post'];
        }

        if(isset($_POST['url'])){
            $video = $_POST['url'];
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
            echo 'Le fournisseur a bien été ajouté !<br />';
        }
        echo '<a href="../ajout.php">Retour</a>';
    ?>
</body>
</html>
