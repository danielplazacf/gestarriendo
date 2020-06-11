<?php session_start();

  /*-------------------------
  Autor: Jesús Caballero P.
  Web: www.betahost.cl
  Correo: uebeats@gmail.com
  ---------------------------*/

  if(!$_SESSION['user_system']){
    header('Location: login.php');
  }

  //Solicitamos Conexion
  require_once 'gt-config/conexion.php';
  
  //Solicitamos Funciones
  require_once 'model/functions.php';

  $titulo = "Panel Administración";
  $sidebar = " ";

  $active_escritorio = "";
  $active_inmuebles = "active";
  $active_owner = "";
  $active_leaser = "";
  $active_pay = "";

  include 'vistas/listProperty.view.php';
?>