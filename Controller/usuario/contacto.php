<?php
require_once 'compruebaDB.php';
if ($_POST[accion] == enviar) {
    $para = "miguelfombuena@hotmail.com";
    $titulo = 'Contacto Hotel';
    $mensaje = "Nombre: " . $_POST[nombre] . "apellido1: " . $_POST[apellido1] .
        "apellido2: " . $_POST[apellido2] . $_POST[comentario];
    $cabeceras = 'From: ' . $_POST[email] . "\r\n" .
        'Reply-To: ' . $_POST[email] . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    $bol = mail($para, $titulo, $mensaje, $cabeceras);

    if ($bol) {
        $estado = "enviado";
    } else {
        $estado = "No enviado";
    }
}

require_once '../../Model/datosHotel.php';

$idImgLogo = "logoHotel";

$logo = datosHotel::getNombreImagen($idImgLogo);

$nombreHotel = datosHotel::getNombreDelHotel();

require_once '../../View/usuario/contactoView.php';
