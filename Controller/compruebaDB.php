<?php

if (file_exists("../Model/bbdd.php")) {
    include '../Model/bbdd.php';

    if (empty(SERVER) || empty(DB) || empty(USER)) {

        header("location:administracion/configuracion.php");
    }
} else {
    header("location:administracion/configuracion.php");
}
