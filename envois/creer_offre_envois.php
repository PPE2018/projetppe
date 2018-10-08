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
        if(isset($_POST['libelle'])){
            $lib = $_POST['libelle']
        }

        //
        //TODO
        //id_personne dependra de la session de l'utilisateur
        $requete = "INSERT INTO offre_emplois(id_offre, date_limite, description, id_candidature, id_docs_offre, id_personne, libelle, video) VALUES ('.$lib.', 0)";
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
