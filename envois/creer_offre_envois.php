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

        if(isset($_POST['date_limite'])){
            $dateLimite = $_POST['date_limite'];
        }

        if(isset($_POST['description'])){
            $description = $_POST['description'];
        }

        //Id qui relie à la table docs (avec bool)
        if(isset($_POST['id_docs_offre'])){
            $idDocsOffre = $_POST['id_docs_offre'];
        }

        //id du RH
        if(isset($_POST['id_personne'])){
            $idPersonne = $_POST['id_personne'];
        }

        //Titre
        if(isset($_POST['libelle'])){
            $lib = $_POST['libelle'];
        }

        if(isset($_POST['libelle'])){
            $lib = $_POST['libelle'];
        }

        //TODO
        //id_personne dependra de la session de l'utilisateur
        $requete = "INSERT INTO offre_emplois(id_offre, date_limite, description, id_candidature, id_docs_offre, id_personne, libelle, video) VALUES ('.$dateLimite.', '.$description.', '.'.$idDocsOffre.', '.'.$description.')";
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
