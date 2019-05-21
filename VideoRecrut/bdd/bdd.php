<html>
    <head>
        <title>Bootstrap template</title>
        <meta charset="utf-8">
        <link href="style/style.css" rel="stylesheet">
    </head>
    <body>
        <?php
            //Connexion au serveur
            $connexion = mysqli_connect('localhost', 'root', '');
            mysqli_set_charset($connexion, "utf8");
            if(!$connexion){
                echo 'Erreur lors de la connexion<br />';
            }
            else{
                //Connexion à la BDD
                $ok = mysqli_select_db($connexion,'ppe');
                if(!$ok)
                    echo 'Echec de la sélection de la base<br />';
            }
        ?>
    </body>
</html>
