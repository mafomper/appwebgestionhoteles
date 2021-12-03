<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?= $nombreHotel->nombreHotel ?> - Mi cuenta</title>
    <link rel="stylesheet" type="text/css" href="../../View/css/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
    <script src="../../View/js/usuario/miCuentaView.js"></script>
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="icon" type="image/png" href="../../View/img/favicon.png">
    <style>
        #dialogoNuevoCliente {
            display: none;
        }

        #dialogoNuevaClave {
            display: none;
        }
    </style>
</head>

<body class="fondoCuerpo">

    <div class="cabecera">
        <div class="logoCabecera">
            <img src="../../View/img/uploads/<?= $logo->nombre ?>" class="imgLogoResponsive">
        </div>
        <div class="flex-container space-between">
            <a href="../index.php" class="flex-item"><p>Inicio</p></a>
            <a href="tiposHabitaciones.php" class="flex-item"><p>Habitaciones</p></a>
            <a href="login.php" class="flex-item seleccionado"><p>Mi cuenta</p></a>
            <a href="contacto.php" class="flex-item"><p>Contacto</p></a>
        </div>
    </div>

    <div class="contenedor">
        <div class="contenedorTexto">
            <span class="textoHotel"><?= $nombreHotel->nombreHotel ?></span>
        </div>

        <ul class="menu1">
            <li class="menu2 esquinaI"><a href="miCuenta.php">Hola, <?= $usuario ?></a></li>
            <li class="menu2"><a href="index.php">Mis reservas</a></li>
            <li class="menu2 seleccionadoMenuUsuario"><a href="miCuenta.php">Mis datos</a></li>
            <li class="menu2 esquinaD"><a href="logout.php">Cerrar sesión</a></li>
        </ul>

        <div id="datosUsuario">
            <?php include "../../Controller/usuario/datosMiCuenta.php" ?>
        </div>
    </div>
    <div id="dialogoNuevoCliente" title="Modificación datos de usuario">
        <?php include "../../Controller/usuario/formModificarDatosUsuario.php" ?>
    </div>

    <div id="dialogoNuevaClave" title="Modificación clave de usuario">
        <?php include "../../Controller/usuario/formModificarClaveUsuario.php" ?>
    </div>
</body>

</html>