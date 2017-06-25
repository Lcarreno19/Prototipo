<?php

if($_POST) {

  require('core/core.php');

  switch (isset($_GET['mode']) ? $_GET['mode'] : null) {
    case 'consulta1':
      require('html/estructura/consulta1.php');
    break;
        case 'consulta3':
      require('html/estructura/consulta3.php');
    break;
    default:
      header('location: index.php');
    break;
  }
} else {
  header('location: index.php');
}

?>
