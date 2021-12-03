<?php

/**
 * Eliminar cliente registrado.
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

$codCliente = $_POST['codCliente'];

Cliente::deteleCliente($codCliente);

require_once './obtieneListaClientes.php';
}else {
    header("location:../../Controller/administracion/login.php");
}