<?php

/**
 * Listado de clientes.
 *
 * @author Miguel Ángel Fombuena Perera
 * @version 1.0.0
 * @copyright Miguel Ángel Fombuena Perera
 * 
 */

require_once 'HotelDB.php';

class Cliente
{
    private $codCliente;
    private $dni;
    private $nombre;
    private $apellido1;
    private $apellido2;

    function __construct($codCliente, $dni, $nombre, $apellido1, $apellido2)
    {
        $this->codCliente = $codCliente;
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
    }

    public function getCodCliente()
    {
        return $this->codCliente;
    }

    public function getDni()
    {
        return $this->dni;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellido1()
    {
        return $this->apellido1;
    }

    public function getApellido2()
    {
        return $this->apellido2;
    }

    /**
     * Método total de clientes
     * @return Int
     * 
     */

    public static function getTotalClientes()
    {
        $conexion = HotelDB::connectDB();
        $seleccion = "SELECT * FROM cliente";
        $consulta = $conexion->query($seleccion);
        $total = $consulta->rowCount();

        return $total;
    }

    /**
     * Método total clientes por DNI
     * @param String $dni
     * @return Int.
     * 
     */

    public static function getTotalClientesByDni($dni)
    {
        $conexion = HotelDB::connectDB();
        $seleccion = "SELECT * FROM cliente WHERE dni LIKE '%" . $dni . "%'";
        $consulta = $conexion->query($seleccion);
        $total = $consulta->rowCount();

        return $total;
    }


    /**
     * Método lista clientes por DNI + página
     * @param String $dni
     * @param String $orderBy
     * @param Int $inicio
     * @param Int $tamanyoPagina
     * @return Array
     * 
     */

    public static function getClientesByDni($dni, $orderBy, $inicio, $tamano_pagina)
    {
        $conexion = HotelDB::connectDB();
        $seleccion = "SELECT * FROM cliente WHERE dni LIKE '%" . $dni . "%' " . $orderBy . " LIMIT " . $inicio . "," . $tamano_pagina;
        $consulta = $conexion->query($seleccion);

        $clientes = [];

        while ($registro = $consulta->fetchObject()) {
            $clientes[] = new Cliente(
                $registro->codCliente,
                $registro->DNI,
                $registro->nombre,
                $registro->apellido1,
                $registro->apellido2
            );
        }

        return $clientes;
    }

    /**
     * Método lista de clientes con página
     * @param String $orderBy
     * @param Int $inicio
     * @param Int $tamanyoPagina
     * @return Array
     * 
     */

    public static function getClientes($orderBy, $inicio, $tamano_pagina)
    {
        $conexion = HotelDB::connectDB();
        $seleccion = "SELECT * FROM cliente " . $orderBy . " LIMIT " . $inicio . "," . $tamano_pagina;
        $consulta = $conexion->query($seleccion);

        $clientes = [];

        while ($registro = $consulta->fetchObject()) {
            $clientes[] = new Cliente($registro->codCliente, $registro->DNI, $registro->nombre, $registro->apellido1, $registro->apellido2);
        }

        return $clientes;
    }

    /**
     * Método que elimina el cliente que tenga el código que se pase por parámetro
     * @param String $codCliente
     */

    public static function deteleCliente($codCliente)
    {
        $conexion = HotelDB::connectDB();
        $borrado = "DELETE FROM cliente WHERE codCliente=" . $codCliente;
        $conexion->query($borrado);
    }

    /**
     * Método que modifica los datos del cliente creado (new Cliente())
     */

    public function modCliente()
    {
        $conexion = HotelDB::connectDB();
        $modificacion = "UPDATE cliente SET  DNI=\"$this->dni\", "
            . "nombre=\"$this->nombre\", apellido1=\"$this->apellido1\", "
            . "apellido2=\"$this->apellido2\""
            . " WHERE codCliente=\"$this->codCliente\"";
        $conexion->query($modificacion);
    }

    /**
     * Método que agrega un nuevo cliente
     */

    public function addCliente()
    {
        $conexion = HotelDB::connectDB();
        $insercion = "INSERT INTO cliente (codCliente, DNI, nombre, apellido1, "
            . "apellido2) VALUES ('$this->codCliente',"
            . "'$this->dni','$this->nombre' ,'$this->apellido1' ,"
            . "'$this->apellido2')";
        $conexion->query($insercion);
    }

    /**
     * Devuelve cliente pasado DNI por parámetros sin paginación
     * @param String $dni
     * @return Array
     * 
     */

    public static function getClienteByDniNoPag($dni)
    {
        $conexion = HotelDB::connectDB();
        $seleccion = "SELECT codCliente FROM cliente WHERE DNI=\"$dni\"";
        $consulta = $conexion->query($seleccion);

        $clientes = [];

        while ($registro = $consulta->fetchObject()) {
            $clientes[] = new Cliente(
                $registro->codCliente,
                $registro->DNI,
                $registro->nombre,
                $registro->apellido1,
                $registro->apellido2
            );
        }

        return $clientes;
    }
}
