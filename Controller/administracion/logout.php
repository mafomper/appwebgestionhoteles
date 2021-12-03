<?php

/**
 * Funcionalidad que destruye la sesión una vez cerrada.
 * 
 * @author Miguel Ángel Fombuena Perera
 * @version 1.0.0
 * @copyright Miguel Ángel Fombuena Perera
 * 
 */

require_once 'compruebaDB.php';
session_start();
session_destroy();
require_once './login.php';

