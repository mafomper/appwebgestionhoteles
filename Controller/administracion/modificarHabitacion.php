<?php

/**
 * Actualizar datos de la habitación.
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

    $habitacionAux = new Habitacion($_POST[codHabitacion], $_POST[tipo], $_POST[capacidad], $_POST[planta], $_POST[tarifa]);

    $habitacionAux->modHabitacion();

    require_once '../../Controller/administracion/obtieneListaHabitaciones.php';
} else {
    header("location:../../Controller/administracion/login.php");
}
