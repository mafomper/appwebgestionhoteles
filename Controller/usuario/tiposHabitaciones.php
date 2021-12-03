<?php
require_once 'compruebaDB.php';
session_start();
include_once '../../Model/HotelDB.php';


$conexion = HotelDB::connectDB();
$seleccion = "SELECT habIndividual, habDoble FROM texto";
$consulta = $conexion->query($seleccion);
$texto = $consulta->fetchObject();

require_once '../../Model/datosHotel.php';

$nombreHotel = datosHotel::getNombreDelHotel();
$idImgLogo = "logoHotel";
$logo = datosHotel::getNombreImagen($idImgLogo);

if ($_SESSION['logueadoAdmin']) {
    $logued = "<div class='elementosOcultos' id='admLog'>true</div>";
}

require_once '../../View/usuario/tiposHabitacionesView.php';
