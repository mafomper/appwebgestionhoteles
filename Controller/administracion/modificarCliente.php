<?php

/**
 * Actualizar datos del cliente.
 *
 * @author Miguel Ángel Fombuena Perera
 * @version 1.0.0
 * @copyright Miguel Ángel Fombuena Perera
 * 
 */

session_start();
if ($_SESSION['logueadoAdmin'] == true) {
    require_once 'compruebaDB.php';
    require_once '../../Model/Cliente.php';

    $clienteAux = new Cliente(
        $_POST[codCliente],
        $_POST[dni],
        $_POST[nombre],
        $_POST[apellido],
        $_POST[apellido2]
    );

    $clienteAux->modCliente();

    require_once './obtieneListaClientes.php';
} else {
    header("location:../../Controller/administracion/login.php");
}
