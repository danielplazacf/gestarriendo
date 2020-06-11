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

  $active_escritorio = "active";
  $active_inmuebles = "";
  $active_owner = "";
  $active_leaser = "";
  $active_pay = "";

  $rowProperty = $con->query('select count(*) from tbl_property_system')->fetchColumn();
  $rowOwner = $con->query('select count(*) from tbl_owner_system')->fetchColumn();
  $rowLeaser = $con->query('select count(*) from tbl_leaser_system')->fetchColumn();


  $apiUrl = 'https://mindicador.cl/api';
  //Es necesario tener habilitada la directiva allow_url_fopen para usar file_get_contents
  if ( ini_get('allow_url_fopen') ) {
      $json = file_get_contents($apiUrl);
  } else {
      //De otra forma utilizamos cURL
      $curl = curl_init($apiUrl);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      $json = curl_exec($curl);
      curl_close($curl);
  }
  
  $dailyIndicators = json_decode($json);
  
  include 'vistas/escritorio.view.php';
