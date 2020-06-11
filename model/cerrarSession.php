<?php session_start();
  /*-------------------------
  Autor: Jesús Caballero P.
  Web: integramosweb.pro
  Correo: web@integramosweb.pro
  ---------------------------*/

  // Borra todas las variables de sesión
  $_SESSION = array();
  // Borra la cookie que almacena la sesión
  if(isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 999999, '/');
  }
  // Finalmente, destruye la sesión
  session_destroy();

    header('Location: ../login.php');

?>