<?php
require_once 'compruebaDB.php';
session_start();
if ($_SESSION['logueadoUser'] == true) {
    $usuario = $_SESSION[nombreUser];

    $mensaje = "<div class='mensaje1'>
                  <span>Clave Actualizada. Vuelva a iniciar sesión.</span>
                  </div>";

    require_once '../../Model/datosHotel.php';

    $nombreHotel = datosHotel::getNombreDelHotel();
    $idImgLogo = "logoHotel";
    $logo = datosHotel::getNombreImagen($idImgLogo);

    include_once '../../View/usuario/miCuentaView.php';
} else {
    header("location:../../Controller/usuario/login.php");
}
