<?php
session_start();
require_once 'compruebaDB.php';
include_once '../../Model/HotelDB.php';

$conexion = HotelDB::connectDB();
$seleccion = "SELECT servicios, comedor FROM texto";
$consulta = $conexion->query($seleccion);
$texto = $consulta->fetchObject();

require_once '../../Model/datosHotel.php';
$idImgLogo = "logoHotel";
$logo = datosHotel::getNombreImagen($idImgLogo);
$nombreHotel = datosHotel::getNombreDelHotel();

if ($_SESSION['logueadoAdmin']) {
  $logued = "<div class='elementosOcultos' id='admLog'>true</div>";
}
require_once '../../View/usuario/serviciosView.php';
