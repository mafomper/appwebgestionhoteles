<?php

/**
 * Comprobación de DB.
 *
 * @author Miguel Ángel Fombuena Perera
 * @version 1.0.0
 * @copyright Miguel Ángel Fombuena Perera
 * 
 */

if(file_exists("../../Model/bbdd.php")) {
    include '../../Model/bbdd.php';

   if (empty(SERVER) || empty(DB) || empty(USER) /*|| empty(PASSWORD)*/ ){
       
       header("location:administracion/configuracion.php");
   }
} else {
    header("location:../administracion/configuracion.php");
}

