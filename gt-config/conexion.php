<?php
	/*-------------------------
    Autor: Jesús Caballero P.
    Web: integramosweb.pro
    Correo: web@integramosweb.pro
    ---------------------------*/
    /*Datos de conexion a la base de datos*/
    define('DB_HOST', 'localhost');//DB_HOST:  generalmente suele ser "127.0.0.1"
    define('DB_USER', 'root');//Usuario de tu base de datos
    define('DB_PASS', '');//Contraseña del usuario de la base de datos
    define('DB_NAME', 'db_gestarriendo');//Nombre de la base de datos
    
	# conectare la base de datos
    global $con;
    try {
        $con = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASS);
      } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
    // $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    // if(!$con){
    //     die("imposible conectarse: ".mysqli_error($con));
    // }
    // if (@mysqli_connect_errno()) {
    //     die("Conexion fallo: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    // }
    // $con->set_charset('utf8');
?>