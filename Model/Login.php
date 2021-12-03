<?php

/**
 * Métodos para gestión de usuarios de administradores y clientes.
 *
 * @author Miguel Ángel Fombuena Perera
 * @version 1.0.0
 * @copyright Miguel Ángel Fombuena Perera
 * 
 */

require_once 'HotelDB.php';

require_once 'UsuarioLogin.php';

class Login {

    private $usuario;
    private $clave;
    private $rol;
    private $codCliente;

    function __construct($usuario, $clave, $rol, $codCliente) {
        $this->usuario = $usuario;
        $this->clave = $clave;
        $this->rol = $rol;
        $this->codCliente = $codCliente;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getClave() {
        return $this->clave;
    }

    function getRol() {
        return $this->rol;
    }

    function getCodCliente() {
        return $this->codCliente;
    }

    /**
     * Devuelve total de filas
     * Método utilizable para sección de Administración
     * @param String $usuario
     * @param String $clave
     * @return Array
     */

    public static function getTotalFilas($usuario, $clave) {
        $conexion = HotelDB::connectDB();
        $seleccion = "SELECT * FROM login WHERE usuario='$usuario' and clave='$clave'";
        $consulta = $conexion->query($seleccion);
        $registro = $consulta->fetchObject();
        $datos = [];
        $datos['filas'] = $consulta->rowCount();
        $datos['rol'] = $registro->rol;
        $datos['codCliente'] = $registro->codCliente;

        return $datos;
    }

    /**
     * Devuelve total de filas
     * Método utilizable para sección de Usuario
     * @param String $usuario
     * @param String $clave
     * @return Array
     */
    
    public static function getTotalFilasUsuario($usuario, $clave) {
        $conexion = HotelDB::connectDB();
        $seleccion = "SELECT * FROM login WHERE usuario='$usuario' and clave='$clave' and rol='usuario'";
        $consulta = $conexion->query($seleccion);
        $registro = $consulta->fetchObject();
        $datos = [];
        $datos['filas'] = $consulta->rowCount();
        $datos['rol'] = $registro->rol;
        $datos['codCliente'] = $registro->codCliente;

        return $datos;
    }

    public static function registrarUsuario($nombre, $dni, $apellido1, $apellido2, $usuario, $clave) {
        $conexion = HotelDB::connectDB();

        //Inserta el cliente
        $insercion = "INSERT INTO cliente (codCliente, DNI, nombre, apellido1, "
                . "apellido2) VALUES ('NULL',"
                . "'$dni','$nombre' ,'$apellido1' ,"
                . "'$apellido2')";
        $conexion->exec($insercion);

        //Obtiene el código del cliente
        $seleccion = "SELECT codCliente FROM cliente WHERE DNI='$dni' and nombre='$nombre'";
        $consulta = $conexion->query($seleccion);
        $registro = $consulta->fetchObject();
        $codClienteRegistro = $registro->codCliente;

        //Inserta el usuario
        $insercion2 = "INSERT INTO login (usuario, clave, rol, codCliente)"
                . "  VALUES ('$_POST[usuario]',"
                . "'$_POST[clave]','usuario' ,'$codClienteRegistro')";
        $conexion->exec($insercion2);
    }

    /**
     * Devuelve datos del cliente + usuario.
     * Muestra los datos del cliente logueado durante el proceso de reserva
     * @param String $usuario
     * @return Array
     * 
     */

    public static function getDatosUsuario($usuario) {
        $conexion = HotelDB::connectDB();
        $seleccion = "SELECT * FROM cliente c, login lo "
                . "WHERE c.codCliente = lo.codCliente AND lo.usuario ='$usuario' ";
        $consulta = $conexion->query($seleccion);
        $datos = [];

        while ($registro = $consulta->fetchObject()) {
            $datos[] = new UsuarioLogin($registro->usuario, $registro->rol, $registro->codCliente, $registro->DNI, $registro->nombre, $registro->apellido1, $registro->apellido2);
        }

        return $datos;
    }
    
    public static function cambiaClaveUsuario($usuario, $clave){
        $conexion = HotelDB::connectDB();
        $modificacionClave = "UPDATE login SET clave=\"$clave\" "
            . " WHERE usuario=\"$usuario\"";
        $conexion->query($modificacionClave);
    }

    public static function cambiaClaveAdmin($usuario, $clave){
        $conexion = HotelDB::connectDB();
        $modificacionClave = "UPDATE login SET clave=\"$clave\" "
            . " WHERE usuario=\"$usuario\"";
        $conexion->query($modificacionClave);
    }
    
    // public static function creaAdmin($usuario, $clave){
    //     $conexion = HotelDB::connectDB();
    //      $insercion2 = "INSERT INTO login (usuario, clave, rol, codCliente)"
    //             . "  VALUES ('$usuario',"
    //             . "'$clave','administrador' ,NULL)";
    //     $conexion->query($insercion2);
    // }

    public static function creaAdmin($usuario, $clave){
        $conexion = HotelDB::connectDB();
         $insercion2 = "INSERT INTO login (usuario, clave, rol, codCliente)"
         . "  VALUES ('$_POST[usuario]',"
         . "'$_POST[clave]','administrador', NULL)";
        $conexion->query($insercion2);
    }

}
