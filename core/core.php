<?php
/*
  EL NÚCLEO DE LA APLICACIÓN!
*/

date_default_timezone_set('America/Caracas');
session_start();

// Estos son los parametros de conexion para el Servidor
#Constantes de conexión
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','root');
define('DB_NAME','banco_de_dados');

#Constantes de la APP
define('HTML_DIR','html/');
define('APP_TITLE','Prototipo');
define('APP_COPY','&copy; Copyright ' . date('Y',time()) . ' Prototipo V.1');
define('APP_URL','localhost/Prototipo/');

#Constantes de PHPMailer
define('PHPMAILER_HOST','');
define('PHPMAILER_USER','');
define('PHPMAILER_PASS','');
define('PHPMAILER_PORT',587);

# models para la conexion1
require('core/models/class.Conexion.php');
require('core/bin/functions/Consultores.php');

#Variables de funciones Globales

$_consultores = Consultores();

?>
