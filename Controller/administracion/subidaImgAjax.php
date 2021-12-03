<?php
session_start();
if ($_SESSION['logueadoAdmin'] == true) {
    require_once 'compruebaDB.php';
    include_once '../../Model/datosHotel.php';
    $idImagen = $_POST["id"];
    if (isset($_FILES[$idImagen]) || $_FILES[$idImagen] != null) {
        $file = $_FILES[$idImagen];
        $nombre = $file["name"];

        switch ($idImagen) {
            case "logoHotel":
                $nombre = "logoHotelHeader.jpg";
                break;
            case "img1Galeria":
                $nombre = "img1Galeria.jpg";
                break;
            case "img2Galeria":
                $nombre = "img2Galeria.jpg";
                break;
            case "img3Galeria":
                $nombre = "img3Galeria.jpg";
                break;
            case "img4Galeria":
                $nombre = "img4Galeria.jpg";
                break;
            case "img5Galeria":
                $nombre = "img5Galeria.jpg";
                break;
            default:
                break;
        }

        $tipo = $file["type"];
        $ruta_provisional = $file["tmp_name"];
        $size = $file["size"];
        $dimensiones = getimagesize($ruta_provisional);
        $width = $dimensiones[0];
        $height = $dimensiones[1];
        $carpeta = "../../View/img/uploads/";

        if ($tipo != 'image/jpg' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif') {
            echo "Error - El archivo no es una imagen JPG. JPGE. PNG. GIF.";
        } else if ($size > 10024 * 10024) {
            echo "Error - Tamaño máximo permitido: 10MB";
        } else if ($width > 5000 || $height > 5000) {
            echo "Error - Anchura|Altura máxima permitida: 5000 px.";
        } else if ($width < 20 || $height < 20) {
            echo "Error - Anchura|Altura máxima permitida: 20 px.";
        } else {
            $src = $carpeta . $nombre;
            unlink($src);
            move_uploaded_file($ruta_provisional, $src);
            datosHotel::setImagenHotel($idImagen, $src);
            datosHotel::setNombreImagen($idImagen, $nombre);
            echo $src;
        }
    }
} else {
    header("location:../../Controller/administracion/login.php");
}
