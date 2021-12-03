<?php
require_once 'compruebaDB.php';
session_start();
include_once '../../Model/Login.php';


if ($_SESSION['logueadoUser'] == true) {

  Login::cambiaClaveUsuario($_POST[usuario], $_POST[clave]);

  $mensaje = "<div class='mensaje1'>
                  <span>Clave Actualizada. Vuelva a iniciar sesión.</span>
                  </div>";
  session_destroy();
  echo $mensaje;
} else {
  //script para devolver al login
}
