<?php

/**
 * Conexión Database.
 *
 * @author Miguel Ángel Fombuena Perera
 * @version 1.0.0
 * @copyright Miguel Ángel Fombuena Perera
 * 
 */

include 'bbdd.php';

abstract class HotelDB
{
  private static $server = SERVER;
  private static $db = DB;
  private static $user = USER;
  private static $password = PASSWORD;

  public static function connectDB()
  {
    try {
      $connection = new PDO("mysql:host=" . self::$server . ";dbname=" . self::$db . ";charset=utf8", self::$user, self::$password);
    } catch (PDOException $e) {
      echo "No se ha podido establecer conexión con el servidor de bases de datos.<br>";
      die("Error: " . $e->getMessage());
    }

    return $connection;
  }
}
