<html>
    <head>
        <title>Réception candidatures  :</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../style/consultation_offre_rh.css" rel="stylesheet">
    </head>
    <body>
      <?php
      $langue = 'fr';
      if (isset($_GET['langue']))
        $langue = $_GET['langue'];
      include "../langue_".$langue.".php";
      ?>
      <nav class='navbar sticky-top navbar-expand-lg navbar-dark bg-dark'>
      <a class='navbar-brand' href='#'><?php echo $str[1] ?></a>
      <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarsExample05' aria-controls='navbarsExample05' aria-expanded='false' aria-label='Toggle navigation'>
        <span class='navbar-toggler-icon'></span>
      </button>

      <div class='collapse navbar-collapse' id='navbarsExample05'>
        <ul class='navbar-nav mr-auto'>
          <li class='nav-item'>
            <a class='nav-link' href='../consultation_offre_rh.php?langue=<?php echo $langue ?>'><?php echo $str[2] ?></a>
          </li>
          <li class='nav-item'>
            <a class='nav-link' href='../creation_offre.php?langue=<?php echo $langue ?>'><?php echo $str[3] ?></a>
          </li>
          <li class='nav-item'>
            <a class='nav-link' href='../reception_cand_rh.php?langue=<?php echo $langue ?>'><?php echo $str[4] ?></a>
          </li>
        </ul>
        <ul class='navbar-nav ml-auto'>
          <li class='nav-item dropdown'>
            <a class='nav-link dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><?php echo $str[5] ?></a>
            <div class='dropdown-menu' aria-labelledby='dropdown05'>
              <a class='dropdown-item' href='reception_cand_rh.php?langue=fr'><?php echo $str[6] ?></a>
              <a class='dropdown-item' href='reception_cand_rh.php?langue=en'><?php echo $str[7] ?></a>
            </div>
          </li>
          <li class='nav-item active'>
            <a class='nav-link' href='#'><?php echo $str[8] ?></a>
          </li>
        </ul>
      </div>
    </nav>
    <br />
    <div class='container'>
      <div class='row'>
        <!-- Partie connexion-->
        <div class='col-sm-6'>
          <form action='login.php' method='post'>
            <!-- Saisie du nom-->
            <div class='form-group'>
               <label for='nom_post'>Nom :</label>
                <input type='text' class='form-control' name='nom' value=''/>
            </div>
            <!-- Saisie du mot de passe -->
            <div class='form-group'>
               <label for='nom_post'>Mot de passe :</label>
                <input type='text' class='form-control' name='mdp' value=''/>
            </div>

            <!-- Bouton-->
            <div>
              <input type='submit' class=' btn btn-primary' value='Se connecter' />
            </div>
          </form>
        </div>
        <!-- Partie Inscription-->
        <div class='col-sm-6'>
          <form action='register.php' method='post'>

            <!-- Saisie du nom-->
            <div class='form-group'>
               <label for='nom_post'>Nom :</label>
                <input type='text' class='form-control' name='nom' value=''/>
            </div>

            <!-- Saisie du prénom-->
            <div class='form-group'>
               <label for='nom_post'>Prénom :</label>
                <input type='text' class='form-control' name='prenom' value=''/>
            </div>

            <!-- Saisie du mot de passe-->
            <div class='form-group'>
               <label for='nom_post'>Mot de passe :</label>
                <input type='text' class='form-control' name='mdp' value=''/>
            </div>

            <!-- Saisie du mot de passe-->
            <div class='form-group'>
               <label for='nom_post'>Mot de passe : (verification)</label>
                <input type='text' class='form-control' name='mdp' value=''/>
            </div>

            <!-- Bouton-->
            <div>
              <input type='submit' class=' btn btn-primary' value='Créer' />
            </div>
          </form>
        </div>

      </div>
    </div>
  </body>
  <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
</html>
