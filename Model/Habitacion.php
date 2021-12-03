<?php

/**
 * Listado de habitaciones.
 *
 * @author Miguel Ángel Fombuena Perera
 * @version 1.0.0
 * @copyright Miguel Ángel Fombuena Perera
 * 
 */

require_once 'HotelDB.php';

class Habitacion
{
    private $codHabitacion;
    private $tipo;
    private $capacidad;
    private $planta;
    private $tarifa;

    function __construct($codHabitacion, $tipo, $capacidad, $planta, $tarifa)
    {
        $this->codHabitacion = $codHabitacion;
        $this->tipo = $tipo;
        $this->capacidad = $capacidad;
        $this->planta = $planta;
        $this->tarifa = $tarifa;
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


    /**
     * Método que devuelve el total de filas de la consulta de Habitaciones.
     * @return Int Cantiad de filas.
     * 
     */
    public static function getTotalHabitaciones()
    {
        $conexion = HotelDB::connectDB();
        $seleccion = "SELECT * FROM habitacion";
        $consulta = $conexion->query($seleccion);
        $total = $consulta->rowCount();

        return $total;
    }

    /**
     * Método que devuelve una lista de habitaciones con paginación
     * @param String $orderBy 
     * @param Int $inicio 
     * @param Int $tamano_pagina 
     * @return Array Array
     * 
     */
    public static function getHabitaciones($orderBy, $inicio, $tamano_pagina)
    {
        $conexion = HotelDB::connectDB();
        $seleccion = "SELECT * FROM habitacion " . $orderBy . " LIMIT " . $inicio . "," . $tamano_pagina;
        $consulta = $conexion->query($seleccion);

        $habitaciones = [];

        while ($registro = $consulta->fetchObject()) {
            $habitaciones[] = new Habitacion($registro->codHabitacion, $registro->tipo, $registro->capacidad, $registro->planta, $registro->tarifa);
        }

        return $habitaciones;
    }

    /**
     * Método que devuelve una lista de habitaciones disponibles según una fecha
     * @param String $fechaEntradaEsp 
     * @param Int $fechaSalidaEsp 
     * @param Int $personas 
     *  por página
     * @return Array Array 
     * 
     */
    public static function getHabitacionesDisp($fechaEntradaEsp, $fechaSalidaEsp, $personas)
    {
        $conexion = HotelDB::connectDB();
        $seleccion = "SELECT h.codHabitacion, h.tipo, h.planta, h.tarifa, h.capacidad"
            . " FROM habitacion h "
            . "WHERE EXISTS (SELECT * FROM reserva r WHERE r.codHabitacion = h.codHabitacion"
            . " AND (((r.fechaEntrada <= $fechaEntradaEsp AND r.fechaSalida > $fechaEntradaEsp) "
            . "OR (r.fechaEntrada < $fechaSalidaEsp AND r.fechaSalida >= $fechaSalidaEsp)))"
            . " OR EXISTS (SELECT * FROM reserva r WHERE r.codHabitacion = h.codHabitacion "
            . "AND ((r.fechaEntrada > $fechaEntradaEsp AND r.fechaSalida < $fechaSalidaEsp)))) = FALSE "
            . "AND h.capacidad=$personas ";
        $consulta = $conexion->query($seleccion);
        $habitaciones = [];

        while ($registro = $consulta->fetchObject()) {
            $habitaciones[] = new Habitacion($registro->codHabitacion, $registro->tipo, $registro->capacidad, $registro->planta, $registro->tarifa);
        }

        return $habitaciones;
    }

    /**
     * Método que elimina la habitación que tenga el código que se pase por parámetro.
     * @param String $codHabitacion 
     */
    public static function deleteHabitacion($codHabitacion)
    {
        $conexion = HotelDB::connectDB();
        $borrado = "DELETE FROM habitacion WHERE codHabitacion=" . $codHabitacion;
        $conexion->query($borrado);
    }

    /**
     * Método que modifica los datos de la habitación creada (new Habitación()).
     */
    public function modHabitacion()
    {
        $conexion = HotelDB::connectDB();
        $modificacion = "UPDATE habitacion SET  tipo=\"$this->tipo\", "
            . "capacidad=\"$this->capacidad\", planta=\"$this->planta\", tarifa=\"$this->tarifa\" "
            . " WHERE codHabitacion=\"$this->codHabitacion\"";
        $conexion->query($modificacion);
    }

    /**
     * Método que agrega una nueva habitación
     */
    public function addHabitacion()
    {
        $conexion = HotelDB::connectDB();
        $insercion = "INSERT INTO habitacion (tipo, capacidad, planta, tarifa)"
            . " VALUES ('$this->tipo','$this->capacidad'"
            . " ,'$this->planta' ,'$this->tarifa')";
        $conexion->query($insercion);
    }
}
