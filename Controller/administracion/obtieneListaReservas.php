<?php

/**
 * Genera el listado de reservas en la web.
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

    $totalFilas = Reserva::getTotalReservas();

    $tamano_pagina = 10;
    $pagina = $_REQUEST["pagina"];

    if (empty($pagina)) {
        $pagina = 1;
    }

    if (!isset($pagina)) {
        $inicio = 0;
        $pagina = 1;
    } else {
        $inicio = ($pagina - 1) * $tamano_pagina;
    }
    //calculo el total de páginas >>
    $totalPaginas = ceil($totalFilas / $tamano_pagina);
    //>>

    $orderBy = "ORDER BY r.fechaEntrada ASC, r.codHabitacion"; //Orden por defecto
    $orden = $_REQUEST["orden"];

    if (!empty($orden)) {
        $orderBy = "ORDER BY " . $orden;
    }

    $tipoOrden = $_REQUEST["tipoOrden"];

    if (!empty($tipoOrden)) {
        $orderBy .= " " . $tipoOrden;
    } else {
        $orderBy .= " ASC"; //Orden por defecto
    }

    $data['reservas'] = Reserva::getReservas($orderBy, $inicio, $tamano_pagina);

    require_once '../../View/administracion/listaReservas.php';
} else {
    header("location:../../Controller/administracion/login.php");
}
