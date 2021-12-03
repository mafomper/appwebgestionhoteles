<?php

/**
 * Obtención de datos de reservas + usuario
 * 
 * @author Miguel Ángel Fombuena Perera
 * @version 1.0.0
 * @copyright Miguel Ángel Fombuena Perera
 * 
 */

include_once 'HotelDB.php';

class ReservaHabitacion
{

    private $codHabitacion;
    private $tipo;
    private $capacidad;
    private $planta;
    private $tarifa;
    private $fechaEntrada;
    private $fechaSalida;

    function __construct($codHabitacion, $tipo, $capacidad, $planta, $tarifa, $fechaEntrada, $fechaSalida)
    {
        $this->codHabitacion = $codHabitacion;
        $this->tipo = $tipo;
        $this->capacidad = $capacidad;
        $this->planta = $planta;
        $this->tarifa = $tarifa;
        $this->fechaEntrada = $fechaEntrada;
        $this->fechaSalida = $fechaSalida;
    }

    function getCodHabitacion()
    {
        return $this->codHabitacion;
    }

    function getTipo()
    {
        return $this->tipo;
    }

    function getCapacidad()
    {
        return $this->capacidad;
    }

    function getPlanta()
    {
        return $this->planta;
    }

    function getTarifa()
    {
        return $this->tarifa;
    }

    function getFechaEntrada()
    {
        return $this->fechaEntrada;
    }

    function getFechaSalida()
    {
        return $this->fechaSalida;
    }

    /**
     * Devuelve datos de habitación + fecha de reserva en el panel del usuario
     * un vez registrado
     * @param String $usuario
     * @return Array 
     */

    public static function getDatosReservaHab($usuario)
    {
        $conexion = HotelDB::connectDB();
        $seleccion = "SELECT h.codHabitacion, h.tipo, h.capacidad, h.planta,h.tarifa,"
            . "DATE_FORMAT(r.fechaEntrada, '%d/%m/%Y') as fechaEntrada,"
            . "DATE_FORMAT(r.fechaSalida, '%d/%m/%Y') as fechaSalida "
            . "FROM reserva r , login l , habitacion h "
            . "WHERE r.codCliente = l.codCliente "
            . "AND l.usuario = '$usuario' AND h.codHabitacion = r.codHabitacion";
        $consulta = $conexion->query($seleccion);
        $datos = [];

        while ($registro = $consulta->fetchObject()) {
            $datos[] = new ReservaHabitacion($registro->codHabitacion, $registro->tipo, $registro->capacidad, $registro->planta, $registro->tarifa, $registro->fechaEntrada, $registro->fechaSalida);
        }
        return $datos;
    }
}
