<?php

/**
 * Funcionalidad para la página de habitaciones.
 *
 * @author Miguel Ángel Fombuena Perera
 * @version 1.0.0
 * @copyright Miguel Ángel Fombuena Perera
 * 
 */

session_start();
if ($_SESSION['logueadoAdmin'] == true) {
require_once 'compruebaDB.php';
require_once '../../View/administracion/inicioHabitaciones.php';
}else {
    header("location:../../Controller/administracion/login.php");
}