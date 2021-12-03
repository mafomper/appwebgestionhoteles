<?php
require_once 'compruebaDB.php';
session_start();
include_once '../../Model/ReservaHabitacion.php';

if ($_SESSION['logueadoUser'] == true) {
    $usuario = $_SESSION[nombreUser];

    $data['datos'] = ReservaHabitacion::getDatosReservaHab($usuario);

    $numeroHabs = count($data);
    require_once '../../Model/datosHotel.php';

    $nombreHotel = datosHotel::getNombreDelHotel();
    $idImgLogo = "logoHotel";
    $logo = datosHotel::getNombreImagen($idImgLogo);

    include_once '../../View/usuario/index.php';
} else {
    header("location:../../Controller/usuario/login.php");
}
