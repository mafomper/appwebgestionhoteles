<?php

/**
 * Clase para crear nuevas habitaciones.
 *
 * @author Miguel Ángel Fombuena Perera
 * @version 1.0.0
 * @copyright Miguel Ángel Fombuena Perera
 * 
 */

session_start();
if ($_SESSION['logueadoAdmin'] == true) {
require_once 'compruebaDB.php';
require_once '../../Model/Habitacion.php';

$habitacionAux = new Habitacion("",$_POST[tipo], $_POST[capacidad], $_POST[planta], $_POST[tarifa]);

$habitacionAux->addHabitacion();

require_once './obtieneListaHabitaciones.php';
}else {
    header("location:../../Controller/administracion/login.php");
}