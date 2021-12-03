<?php
session_start();

require_once '../Controller/compruebaDB.php';

require_once '../Model/datosHotel.php';


$idImagen = array(
    "img1Galeria", "img2Galeria", "img3Galeria", "img4Galeria", "img5Galeria"
);



$idImgLogo = "logoHotel";

$imagenesGaleria = array(
    'img1' => datosHotel::getNombreImagen($idImagen[0]),
    'img2' => datosHotel::getNombreImagen($idImagen[1]),
    'img3' => datosHotel::getNombreImagen($idImagen[2]),
    'img4' => datosHotel::getNombreImagen($idImagen[3]),
    'img5' => datosHotel::getNombreImagen($idImagen[4]),
);


$logo = datosHotel::getNombreImagen($idImgLogo);
$nombreHotel = datosHotel::getNombreDelHotel();

require_once '../View/index.php';
