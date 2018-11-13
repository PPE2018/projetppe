<html>
    <head>
        <title>Réception candidatures  :</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="style/consultation_offre_rh.css" rel="stylesheet">
    </head>
    <body>
      <?php

      $langue = 'fr';

      if (isset($_GET['langue']))
        $langue = $_GET['langue'];
      include "langue_".$langue.".php";

      echo"
          <nav class='navbar sticky-top navbar-expand-lg navbar-dark bg-dark'>
          <a class='navbar-brand' href='#'>$str[1]</a>
          <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarsExample05' aria-controls='navbarsExample05' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
          </button>

          <div class='collapse navbar-collapse' id='navbarsExample05'>
            <ul class='navbar-nav mr-auto'>
              <li class='nav-item active'>
                <a class='nav-link' href='consultation_offre_rh.php?langue=fr'>$str[2]</a>
              </li>
              <li class='nav-item '>
                <a class='nav-link' href='creation_offre.php?langue=fr'>$str[3]</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='reception_cand_rh.php?langue=fr'>$str[4]</a>
              </li>
            </ul>
            <ul class='navbar-nav ml-auto'>
              <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>$str[5]</a>
                <div class='dropdown-menu' aria-labelledby='dropdown05'>
                  <a class='dropdown-item' href='consultation_offre_rh.php?langue=fr'>$str[6]</a>
                  <a class='dropdown-item' href='consultation_offre_rh.php?langue=en'>$str[7]</a>
                </div>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='#'>$str[8]</a>
              </li>
            </ul>
          </div>
        </nav>";
        ?>
        
