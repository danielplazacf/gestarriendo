<?php session_start();

  /*-------------------------
  Autor: Jesús Caballero P.
  Web: www.integramosweb.pro
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
  $sidebar = "";

  $active_escritorio = "";
  $active_inmuebles = "";
  $active_owner = "";
  $active_leaser = "";
  $active_pay = "active";
  
  include 'vistas/historialCobros.view.php';
