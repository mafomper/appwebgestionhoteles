<?php

/**
 * Métodos para la onfiguración de datos del Hotel.
 *
 * @author Miguel Ángel Fombuena Perera
 * @version 1.0.0
 * @copyright Miguel Ángel Fombuena Perera
 * 
 */

session_start();
if ($_SESSION['logueadoAdmin'] == true) {
    require_once 'compruebaDB.php';
    include_once '../../Model/datosHotel.php';

    $nombreHotel = datosHotel::getNombreDelHotel();

    include_once '../../View/administracion/configuracionHotelView.php';
} else {
    header("location:../../Controller/administracion/login.php");
}
