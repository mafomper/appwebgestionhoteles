<?php

/**
 * Métodos para gestión de reservas de hotel.
 *
 * @author Miguel Ángel Fombuena Perera
 * @version 1.0.0
 * @copyright Miguel Ángel Fombuena Perera
 * 
 */

require_once 'HotelDB.php';

class Reserva
{
    private $codHabitacion;
    private $codCliente;
    private $fechaEntrada;
    private $fechaSalida;
    private $dni;
    private $nombre;
    private $apellido1;
    private $apellido2;

    function __construct($codHabitacion, $codCliente, $fechaEntrada, $fechaSalida, $dni, $nombre, $apellido1, $apellido2)
    {
        $this->codHabitacion = $codHabitacion;
        $this->codCliente = $codCliente;
        $this->fechaEntrada = $fechaEntrada;
        $this->fechaSalida = $fechaSalida;
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
    }

    function getCodHabitacion()
    {
        return $this->codHabitacion;
    }

    function getCodCliente()
    {
        return $this->codCliente;
    }

    function getFechaEntrada()
    {
        return $this->fechaEntrada;
    }

    function getFechaSalida()
    {
        return $this->fechaSalida;
    }

    function getDni()
    {
        return $this->dni;
    }

    function getNombre()
    {
        return $this->nombre;
    }

    function getApellido1()
    {
        return $this->apellido1;
    }

    function getApellido2()
    {
        return $this->apellido2;
    }

    /**
     * Devuelve total de reservas.
     * @return Int
     */

    public static function getTotalReservas()
    {
        $conexion = HotelDB::connectDB();
        $seleccion = "SELECT * FROM reserva";
        $consulta = $conexion->query($seleccion);
        $total = $consulta->rowCount();

        return $total;
    }

    /**
     * Devuelve lista de reservas + paginación
     * @param String $orderBy
     * @param Int $inicio
     * @param Int $tamanyoPagina
     * @return Array 
     */

    public static function getReservas($orderBy, $inicio, $tamano_pagina)
    {
        $conexion = HotelDB::connectDB();
        $seleccion = "SELECT * FROM reserva r "
            . "JOIN habitacion h ON (r.codHabitacion = h.codHabitacion) "
            . "JOIN cliente c ON (c.codCliente = r.codCliente) "
            . $orderBy . " LIMIT " . $inicio . "," . $tamano_pagina;

        $consulta = $conexion->query($seleccion);

        $reservas = [];

        while ($registro = $consulta->fetchObject()) {
            $reservas[] = new Reserva(
                $registro->codHabitacion,
                $registro->codCliente,
                $registro->fechaEntrada,
                $registro->fechaSalida,
                $registro->DNI,
                $registro->nombre,
                $registro->apellido1,
                $registro->apellido2
            );
        }


        return $reservas;
    }

    /**
     * Borrar reserva que contenga código de habitacion + cliente + fecha de reserva
     * pasada por parámetros
     * @param String $codHabitacion
     * @param String $codCliente
     * @param String $fecha
     */
    
    public static function deleteReserva($codHabitacion, $codCliente, $fecha)
    {
        $conexion = HotelDB::connectDB();
        $borrado = "DELETE FROM reserva WHERE codHabitacion=" . $codHabitacion
            . " AND codCliente=" . $codCliente . " AND " . $fecha;
        $conexion->query($borrado);
    }

    /**
     * Actualizar datos de la reserva
     * @param String $fechaOriginal
     */

    public function modReserva($fechaOriginal)
    {
        $conexion = HotelDB::connectDB();
        $modificacion = "UPDATE reserva SET  fechaEntrada=\"$this->fechaEntrada\", "
            . "fechaSalida=\"$this->fechaSalida\" "
            . "WHERE codHabitacion=\"$this->codHabitacion\" "
            . "AND codCliente=\"$this->codCliente\" "
            . "AND fechaEntrada=\"$fechaOriginal\"";

        $conexion->query($modificacion);
    }

    /**
     * Registrar reserva por admministración
     * Uso por administración.
     */

    public function reservar()
    {
        $conexion = HotelDB::connectDB();
        $reserva = "INSERT INTO RESERVA (codCliente, codHabitacion, fechaEntrada, "
            . "fechaSalida) VALUES ('$this->codCliente',"
            . "'$this->codHabitacion','$this->fechaEntrada' ,'$this->fechaSalida')";

        var_dump($reserva);
        $conexion->query($reserva);
    }

    /**
     * Registrar reserva por usuario
     * Uso por usuario.
     */

    public function reservarUsuario()
    {
        $conexion = HotelDB::connectDB();
        $reserva = "INSERT INTO RESERVA (codCliente, codHabitacion, fechaEntrada, "
            . "fechaSalida) VALUES ('$this->codCliente',"
            . "'$this->codHabitacion',$this->fechaEntrada ,$this->fechaSalida)";

        var_dump($reserva);
        $conexion->query($reserva);
    }
}
