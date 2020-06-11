<?php session_start();

  /*-------------------------
	Autor: Jesús Caballero P.
	Web: integramosweb.pro
	Correo: web@integramosweb.pro
  ---------------------------*/

  if (isset($_SESSION['user_system'])) {
    header('location: escritorio.php');
  }

  $errores = '';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = filter_var(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING);
    $password = hash('sha256', $_POST['password']);
    $departamento = $_POST['depto'];

    // Reemplaza el codigo de abajo try{}catch
    require_once('gt-config/conexion.php');

    $statement = $con->prepare('
      SELECT * FROM tbl_users_system WHERE user_system = :usuario AND pass_system = :password AND depto_user = :depto'
    );
    $statement->execute(array(
      ':usuario' => $usuario,
      ':password' => $password,
      ':depto' => $departamento
    ));

    $resultado = $statement->fetch();
    if ($resultado !== false) {
      $_SESSION['user_system'] = $usuario;
      $_SESSION['type_user'] = $resultado['type_user'];
      // Para ingreso normal
      header('Location: escritorio.php');
    } else {
      $errores .= '<div class="alert alert-danger">
                      <ul>
                        <li>Datos Incorrectos, vuelva a intentarlo, recuerda seleccionar el depto. al que perteneces.</li>
                      </ul>
                  </div>';
    }
  }

?>