<?php

/**
 * Genera el listado de clientes en la web.
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

  $dni = null;
  if (isset($_GET['dni']) && !empty($_GET['dni'])) {
    $dni = $_GET['dni'];
  }

  if (isset($dni)) {  //Consulta para buscador DNI
    $totalFilas = Cliente::getTotalClientesByDni($dni);
  } else { //Consulta sin realizar búsqueda
    $totalFilas = Cliente::getTotalClientes();
  }

  //Paginación >>
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
  //calculo el total de páginas
  $totalPaginas = ceil($totalFilas / $tamano_pagina);
  //>>

  //Ordenación >>
  $orderBy = "ORDER BY apellido1, apellido2, nombre"; //Orden por defecto
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
  //>>

  if (isset($dni)) {  //Consulta para buscador DNI
    $data['clientes'] = Cliente::getClientesByDni($dni, $orderBy, $inicio, $tamano_pagina);
  } else { //Consulta sin realizar búsqueda
    $data['clientes'] = Cliente::getClientes($orderBy, $inicio, $tamano_pagina);
  }

  require_once '../../View/administracion/listaClientes.php';
} else {
  header("location:../../Controller/administracion/login.php");
}
