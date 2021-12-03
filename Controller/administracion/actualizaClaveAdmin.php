<?php
require_once 'compruebaDB.php';
session_start();
include_once '../../Model/Login.php';
if ($_SESSION['logueadoAdmin'] == true) {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    Login::cambiaClaveAdmin($usuario, $clave);
    $mensaje = "<div class='mensaje1'>
                    <span>Clave Actualizada. Vuelva a iniciar sesión.</span>
                </div>";
    session_destroy();
    echo $mensaje;
} else {
    header("location:../../Controller/administracion/login.php");
}
