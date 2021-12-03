<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?= $nombreHotel->nombreHotel ?> - Contacto</title>
    <link rel="stylesheet" type="text/css" href="../../View/css/main.css">
    <link rel="stylesheet" type="text/css" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../../View/img/favicon.png">
    <script>
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }
    </script>
</head>

<body class="fondoCuerpo">

    <div class="cabecera">
        <div class="logoCabecera">
            <img src="../../View/img/uploads/<?= $logo->nombre ?>" class="imgLogoResponsive">
        </div>
        <div class="flex-container space-between">
            <a href="../index.php" class="flex-item">
                <p>Inicio</p>
            </a>
            <a href="tiposHabitaciones.php" class="flex-item">
                <p>Habitaciones</p>
            </a>
            <a href="login.php" class="flex-item">
                <p>Mi cuenta</p>
            </a>
            <a href="contacto.php" class="flex-item seleccionado">
                <p>Contacto</p>
            </a>
        </div>
    </div>

    <div class="contenedor">
        <ul class="topnav" id="myTopnav">
            <li><a href="../index.php">Inicio</a></li>
            <li><a class="active" href="tiposHabitaciones.php">Habitaciones</a></li>
            <li><a href="login.php">Mi cuenta</a></li>
            <li><a href="contacto.php">Contacto</a></li>
            <li class="icon">
                <a href="javascript:void(0);" class="barrasMenu" onclick="myFunction()"><span class="ion-navicon-round"></span></a>
            </li>
        </ul>
        <div class="contenedorTexto">
            <span class="textoHotel"><?= $nombreHotel->nombreHotel ?></span>
        </div>
        <div class="login-block marginLogin">
            <h1>Contacto</h1>
            <h2> <?= $estado ?></h2>
            <form action="contacto.php" method="post">
                <input type="hidden" name="accion" value="enviar" />
                <input type="text" name="nombre" required placeholder="Nombre" autofocus />
                <input type="text" name="apellido1" required placeholder="Apellido 1" />
                <input type="text" name="apellido2" required placeholder="Apellido 2" />
                <input type="email" name="email" required placeholder="Email" />
                <textarea rows="4" cols="37" id="textArea" name="comentario" placeholder="Comentario"></textarea>
                <button type="submit">Enviar</button>
            </form>
        </div>
    </div>
</body>

</html>