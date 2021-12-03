<?php

/**
 * Clase que permite actualizar el nombre del Hotel.
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

$nombreHotel = $_POST['nombre'];

datosHotel::setNombreDelHotel($nombreHotel);

echo "<div id='nuevoNombre'>".$nombreHotel."</div>";
}else {
    header("location:../../Controller/administracion/login.php");
}