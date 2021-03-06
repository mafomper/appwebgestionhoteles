<?php

/**
 * Actualizar información de la reserva.
 *
 * @author Miguel Ángel Fombuena Perera
 * @version 1.0.0
 * @copyright Miguel Ángel Fombuena Perera
 * 
 */

session_start();
if ($_SESSION['logueadoAdmin'] == true) {
    require_once 'compruebaDB.php';
    require_once '../../Model/Reserva.php';

    $reservaAux = new Reserva($_POST[codHabitacion], $_POST[codCliente], $_POST[fechaEntrada], $_POST[fechaSalida], "", "", "", "");

    $reservaAux->modReserva($_POST[fechaEntradaHidden]);

    require_once '../../Controller/administracion/obtieneListaReservas.php';
} else {
    header("location:../../Controller/administracion/login.php");
}
