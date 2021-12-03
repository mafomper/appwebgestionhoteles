<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?= $nombreHotel->nombreHotel ?> - Habitaciones y tarifas</title>
    <link rel="stylesheet" type="text/css" href="../../View/css/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../../View/img/favicon.png">
</head>

<body class="fondoCuerpo">
    <div class="cabecera">
        <div class="logoCabecera">
            <img src="../../View/img/uploads/<?= $logo->nombre ?>" class="imgLogoResponsive">
        </div>
        <div class="ocultar flex-container space-between">
            <a href="../index.php" class="flex-item seleccionado">
                <p>Inicio</p>
            </a>
            <a href="tiposHabitaciones.php" class="flex-item">
                <p>Habitaciones</p>
            </a>
            <a href="login.php" class="flex-item">
                <p>Mi cuenta</p>
            </a>
            <a href="contacto.php" class="flex-item">
                <p>Contacto</p>
            </a>
        </div>
    </div>

    <div class="contenedor">
        <div class="contenedorTexto">
            <span class="textoHotel"><?= $nombreHotel->nombreHotel ?></span>
        </div>

        <div class="tituloTabla">
            <span class="spanTituloTabla">Habitaciones | tarifas</span>
        </div>
        <?php
        if ($totalHabsDisp > 0) {
        ?>
            <div class="wrap">
                <table class="tablaHabitaciones">
                    <th class="tablahabitacionesTh">Habitación</th>
                    <th class="tablahabitacionesTh">Tipo</th>
                    <th class="tablahabitacionesTh">Capacidad</th>
                    <th class="tablahabitacionesTh">Planta</th>
                    <th class="tablahabitacionesTh">Precio/Noche</th>
                    <th class="tablahabitacionesTh">Reservar</th>
                    <?php
                    foreach ($data['habitaciones'] as $hab) {
                    ?>
                        <tr>
                            <td>
                                Habitación Nº <?= $hab->GetCodHabitacion() ?>
                            </td>
                            <td>
                                Habitacion <?= $hab->GetTipo() ?>
                            </td>
                            <td>
                                Capacidad <?= $hab->GetCapacidad() ?>
                            </td>
                            <td>
                                Planta <?= $hab->GetPlanta() ?>
                            </td>
                            <td>
                                Precio <?= $hab->GetTarifa() ?>€
                            </td>
                            <td>
                                <form name="reservar" action="confirmarReserva.php" method="GET">
                                    <input type="hidden" name="codHabitacion" value="<?= $hab->GetCodHabitacion() ?>">
                                    <input type="hidden" name="fechaEntrada" value="<?= $fechaEntrada ?>">
                                    <input type="hidden" name="fechaSalida" value="<?= $fechaSalida ?>">
                                    <input type="submit" class="btnEnvio2NoMargin" value="Reservar" />
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        <?php
        } else {
        ?>
            <div class="mensaje1">
                <span>No hay disponibilidad en las fechas indicadas.</span>
            </div>
        <?php
        }
        ?>
    </div>
</body>

</html>