<?php
session_start();
session_destroy();
$langue = 'fr';
if (isset($_GET['langue']))
  $langue = $_GET['langue'];
include "../langue_".$langue.".php";
header("location: connexion.php?langue=$langue");

?>
