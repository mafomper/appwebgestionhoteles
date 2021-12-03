<!DOCTYPE html>
<html lang="es">

<head>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="../../View/css/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
    <script src="../../View/js/usuario/registroView.js"></script>
    <link rel="icon" type="image/png" href="../../View/img/favicon.png">
    <meta charset="UTF-8">
    <title>Configuración Inicial BBDD</title>
</head>

<body class="configuradorInicial">
    <div class="contenedorTexto">
        <span class="textoHotel">Instalación</span>
    </div>
    <div class="login-block">
        <h1>Configuración Inicial</h1>
        <?= !empty($error) ? '<h3>' . $error . '</h3>' : '' ?>
        <form action="../../Controller/administracion/configuracion.php" method="post" id="formConfigInicial">
            <input type="text" name="server" class="camposRegistroUsusarios" placeholder="Datos Servidor" autofocus="" />
            <input type="text" name="db" class="camposRegistroUsusarios" placeholder="Nombre BBDD" />
            <input type="text" name="user" class="camposRegistroUsusarios" placeholder="Usuario" />
            <input type="text" name="password" class="camposRegistroUsusarios" placeholder="Contraseña" />
            <hr>
            <h1>Datos administrador</h1>
            <input type="text" name="nameAdmin" class="camposRegistroUsusarios" placeholder="Usuario" />
            <input type="text" name="passAdmin" class="camposRegistroUsusarios" placeholder="Contraseña" />
            <button type="submit">Crear</button>
        </form>
    </div>
</body>

</html>