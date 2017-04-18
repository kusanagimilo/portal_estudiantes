<?php

/*
 * en la definida de motor de base de datos 
 * MYSQL para utlizar mysql
 * ORACLE para utlizar oracle
 * SQL_SERVER para utlizar sql_server
 */

//define('MOTOR', 'ORACLE');
define('MOTOR', 'MYSQL');



/* Descomentar estas lineas si se quiere conectar a oracle */

define('HOST', 'localhost');
define('BD', 'portal_estudiantes');
define('USUARIO', 'root');
define('PASSWORD', 'Camilo@64');

define('LDAP_USR', "sisfito@ica.gov.co"); // en esta linea de tiene que ir el nombre de usuario destinado para este proyecto ejemplo juan.cruz@javeriana.edu.co
define('LDAP_PASS', "Sirin201413");// en esta linea de tiene que ir la clave de el usuario ingreasado en la linea anterior

?>
