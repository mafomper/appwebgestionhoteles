<?php
session_start();
if ($_SESSION['logueadoAdmin']) {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Administración Hotel - Configuración</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../../View/css/main.css">
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
        <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="../../View/js/inicioClientes.js"></script>
        <link rel="icon" type="image/png" href="../../View/img/favicon.png">
        <script>
            $(document).ready(function() {
                var nombreHotel;
                $(".fichero").on("change", function() {
                    var formData = new FormData($(this).parent()[0]);
                    var idVuelque = $(this).parent().attr('id');
                    console.log(idVuelque);
                    var ruta = "subidaImgAjaX.php";
                    $.ajax({
                        url: ruta,
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(datos) {
                            console.log(idVuelque);
                            $("#respuesta" + idVuelque + " img").attr("src", datos + "?cachebuster=" + new Date().getTime());
                        }
                    });
                });

                //Dialogo con mensaje cargando
                $("#dialogoCargando").dialog({
                    autoOpen: false,
                    resizable: false,
                    modal: true,
                    show: 'fade',
                    hide: 'fade',
                    width: 'auto'
                });
                //Muestra un dialogo al comenzar una petición ajax
                $(document).ajaxStart(function() {
                    $("#dialogoCargando").dialog("open");
                    $('body').css('cursor', 'wait');
                });

                //Muestra un dialogo al Finalizar una petición ajax
                $(document).ajaxStop(function() {
                    $("#dialogoCargando").dialog("close");
                    $('body').css('cursor', 'auto');
                });

                //Para la primera opción del select
                var seleccionado2 = $('select[name=redesSociales]').val();
                var estado2 = $("#" + seleccionado2).text();
                if (estado2 === "habilitado") {
                    $('#estadoCheck').prop('checked', true);
                    console.log("Facebook Habilitado");
                }

                if (estado2 === "deshabilitado") {
                    $('#estadoCheck').prop('checked', false);
                    console.log("Facebook DESHabilitado")
                }
                $(document).on('change', '#redesSocialesSelect', function() {
                    var seleccionado = $('select[name=redesSociales]').val();
                    var estado = $("#" + seleccionado).text();
                    console.log("Opción..." + estado);
                    if (estado === "habilitado") {
                        $('#estadoCheck').prop('checked', true);
                    }

                    if (estado === "deshabilitado") {
                        $('#estadoCheck').prop('checked', false);
                    }
                });

                $(document).on('change', '#estadoCheck', function() {
                    var continuar = true;
                    var seleccionado = $('select[name=redesSociales]').val();
                    var estado = $("#" + seleccionado).text();
                    if (estado === "habilitado") {
                        estado = 'deshabilitado';
                        continuar = false;
                        console.log("se va a des");
                        console.log(estado);
                        $.post("modEstadoRedesSociales.php", {
                            seleccionado: seleccionado,
                            estado: estado
                        }, function(data, status) {
                            var response = $('<html />').html(data);
                            //                                    response.find('#pag2Texto2 P')
                            $(".estados").html(response.find('.estados'));
                        });
                    }

                    console.log('test ' + continuar);
                    if (estado === "deshabilitado" && continuar === true) {
                        estado = 'habilitado';
                        console.log("se va a hab");
                        console.log(estado);
                        $.post("modEstadoRedesSociales.php", {
                            seleccionado: seleccionado,
                            estado: estado
                        }, function(data, status) {
                            var response = $('<html />').html(data);
                            //                                    response.find('#pag2Texto2 P')
                            console.log(response.find('.estados'));
                            $(".estados").html(response.find('.estados'));
                        });
                    }
                });

                $("#dialogoCorrecto").dialog({
                    autoOpen: false,
                    resizable: false,
                    modal: true,
                    width: 'auto'
                });

                $("#dialogoCorrecto2").dialog({
                    autoOpen: false,
                    resizable: false,
                    modal: true,
                    width: 'auto'
                });

                $("#dialogoCorrecto3").dialog({
                    autoOpen: false,
                    resizable: false,
                    modal: true,
                    width: 'auto'
                });

                $("#formModificarClave").validate({
                    rules: {
                        clave: {
                            required: true,
                            minlength: 6,
                            maxlength: 20
                        },
                        claveComprueba: {
                            equalTo: "#inputClave"
                        }
                    },
                    messages: {
                        clave: "Mínimo 6 carácteres",
                        claveComprueba: "Las claves deben ser iguales"
                    }
                });

                $("#dialogoNuevaClave").dialog({
                    autoOpen: false,
                    resizable: false,
                    minWidth: 200,
                    modal: true,
                    buttons: {
                        "Guardar": function() {
                            if ($('#formModificarClave').valid()) {
                                $.post("actualizaClaveAdmin.php", {
                                    usuario: $("#nombreAdmin").text().trim(),
                                    clave: $("#inputClave").val()
                                }, function(data, status) {
                                    $("#dialogoCorrecto").dialog('open');
                                    setTimeout(function() {
                                        $("#dialogoCorrecto").dialog("close");
                                        setTimeout("location.href = 'login.php';", 500);
                                    }, 4000);
                                }); //get			

                                $(this).dialog("close");
                            }
                        },
                        "Cancelar": function() {
                            $(this).dialog("close");
                        }
                    }
                });

                //Boton Cambiar Clave	
                $(document).on("click", "#cambiarClave", function() {
                    $("#dialogoNuevaClave").dialog("open");
                });


                $("#dialogoNuevoNombre").dialog({
                    autoOpen: false,
                    resizable: false,
                    minWidth: 200,
                    modal: true,
                    buttons: {
                        "Guardar": function() {
                            $.post("actualizaNombreHotel.php", {
                                nombre: $("#inputNombre").val()
                            }, function(data, status) {
                                var response = $('<html />').html(data);
                                $("#nombreHotel").html(response.find('#nuevoNombre'));
                                $("#dialogoCorrecto3").dialog('open');
                                setTimeout(function() {
                                    $("#dialogoCorrecto3").dialog("close");
                                }, 1500);
                            }); //get			

                            $(this).dialog("close");

                        },
                        "Cancelar": function() {
                            $(this).dialog("close");
                        }
                    }
                });

                //Boton Cambiar Nombre	
                $(document).on("click", "#editNombreHotel", function() {
                    $("#dialogoNuevoNombre").dialog("open");
                    $("#inputNombre").val($("#nombreHotel").text());
                });


                $("#dialogoNuevaUrlSocial").dialog({
                    autoOpen: false,
                    resizable: false,
                    minWidth: 200,
                    modal: true,
                    buttons: {
                        "Guardar": function() {
                            $.post("actualizaUrlSocial.php", {
                                url: $("#inputUrl").val(),
                                id: $('select[name=redesSociales]').val()
                            }, function(data, status) {
                                $("#dialogoCorrecto3").dialog('open');
                                setTimeout(function() {
                                    $("#dialogoCorrecto3").dialog("close");
                                }, 1500);
                            });

                            $(this).dialog("close");
                        },
                        "Cancelar": function() {
                            $(this).dialog("close");
                        }
                    }
                });

                //Boton Cambiar Nombre	
                $(document).on("click", "#editSocial", function() {
                    $("#dialogoNuevaUrlSocial").dialog("open");
                });
            });
        </script>
        <style>
            #dialogoborrar {
                display: none;
            }

            #dialogomodificar {
                display: none;
            }

            #dialogoreservar {
                display: none;
            }

            #dialogoNuevoCliente {
                display: none;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav">
                            <li><a href="../../Controller/index.php">Inicio</a></li>
                            <li><a href="index.php">Clientes</a></li>
                            <li><a href="../../Controller/administracion/habitaciones.php">Habitaciones</a></li>
                            <li><a href="reservas.php">Reservas</a></li>
                            <li class="active"><a href="../../Controller/administracion/configuracionHotel.php">Configuración</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="index.php"><span class="glyphicon glyphicon-user"></span> <?= ($_SESSION['nombreAdmin']) ?></a></li>
                            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Cerrar sesión</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <h2>Configuración del Hotel</h2>
            <table class="table table-striped">
                <thead>
                    <tr class="info">
                        <th>Elemento</th>
                        <th>Valor</th>
                        <th>Editar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Nombre del Hotel
                        </td>
                        <td id="nombreHotel"><?= $nombreHotel->nombreHotel ?></td>
                        <td><button type="button" class="btn btn-info" id="editNombreHotel">Editar</button></td>
                    </tr>
                    <tr>
                        <td>Contraseña administrador
                        </td>
                        <td>**************</td>
                        <td><button type="button" class="btn btn-info" id="cambiarClave">Editar</button></td>
                    </tr>

                    <tr>
                        <td>Logotipo del Hotel</td>
                        <td id="respuestalogoHotelForm">
                            <?php
                            $id = "logoHotel";
                            $img = datosHotel::getImagenHotel($id);
                            ?>
                            <img src="<?= $img->ruta ?>" alt="Logo hotel" class="imgMiniaturaConfig">
                        </td>
                        <td>
                            <form method="post" id="logoHotelForm" enctype="multipart/form-data">
                                <input type="file" name="logoHotel" id="imagen" class="btn btn-info fichero" />
                                <input type="hidden" name="id" id="id" value="logoHotel" />
                        </td>

                        </form>
                    </tr>
                    <tr>
                        <td>Galería Hotel. Imagen 1</td>
                        <td id="respuestaimg1GaleriaForm">
                            <?php
                            $id = "img1Galeria";
                            $img = datosHotel::getImagenHotel($id);
                            ?>
                            <img src="<?= $img->ruta ?>" alt="Imagen 1 de la galería" class="imgMiniaturaConfig">
                        </td>
                        <td>
                            <form method="post" id="img1GaleriaForm" enctype="multipart/form-data">
                                <input type="file" name="img1Galeria" id="imagen1Galeria" class="btn btn-info fichero" />
                                <input type="hidden" name="id" id="id" value="img1Galeria" />
                        </td>

                        </form>
                    </tr>

                    <tr>
                        <td>Galería Hotel. Imagen 2</td>
                        <td id="respuestaimg2GaleriaForm">
                            <?php
                            $id = "img2Galeria";
                            $img = datosHotel::getImagenHotel($id);
                            ?>
                            <img src="<?= $img->ruta ?>" alt="Imagen 2 de la galería" class="imgMiniaturaConfig">
                        </td>
                        <td>
                            <form method="post" id="img2GaleriaForm" enctype="multipart/form-data">
                                <input type="file" name="img2Galeria" id="imagen2Galeria" class="btn btn-info fichero" />
                                <input type="hidden" name="id" id="id" value="img2Galeria" />
                        </td>

                        </form>
                    </tr>

                    <tr>
                        <td>Galería Hotel. Imagen 3</td>
                        <td id="respuestaimg3GaleriaForm">
                            <?php
                            $id = "img3Galeria";
                            $img = datosHotel::getImagenHotel($id);
                            ?>
                            <img src="<?= $img->ruta ?>" alt="Imagen 3 de la galería" class="imgMiniaturaConfig">
                        </td>
                        <td>
                            <form method="post" id="img3GaleriaForm" enctype="multipart/form-data">
                                <input type="file" name="img3Galeria" id="imagen3Galeria" class="btn btn-info fichero" />
                                <input type="hidden" name="id" id="id" value="img3Galeria" />
                        </td>

                        </form>
                    </tr>

                    <tr>
                        <td>Galería Hotel. Imagen 4</td>
                        <td id="respuestaimg4GaleriaForm">
                            <?php
                            $id = "img4Galeria";
                            $img = datosHotel::getImagenHotel($id);
                            ?>
                            <img src="<?= $img->ruta ?>" alt="Imagen 4 de la galería" class="imgMiniaturaConfig">
                        </td>
                        <td>
                            <form method="post" id="img4GaleriaForm" enctype="multipart/form-data">
                                <input type="file" name="img4Galeria" id="imagen4Galeria" class="btn btn-info fichero" />
                                <input type="hidden" name="id" id="id" value="img4Galeria" />
                        </td>

                        </form>
                    </tr>

                    <tr>
                        <td>Galería Hotel. Imagen 5</td>
                        <td id="respuestaimg5GaleriaForm">
                            <?php
                            $id = "img5Galeria";
                            $img = datosHotel::getImagenHotel($id);
                            ?>
                            <img src="<?= $img->ruta ?>" alt="Imagen 5 de la galería" class="imgMiniaturaConfig">
                        </td>
                        <td>
                            <form method="post" id="img5GaleriaForm" enctype="multipart/form-data">
                                <input type="file" name="img5Galeria" id="imagen5Galeria" class="btn btn-info fichero" />
                                <input type="hidden" name="id" id="id" value="img5Galeria" />
                        </td>

                        </form>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="dialogoCargando" style="position: relative;" title="Procesando contenido">
            <p>El contenido está siendo procesado.</p>

            <p>Puede tardar unos segundos</p>
        </div>

        <div id="dialogoCorrecto" title="Clave Actualizada">
            <p>
                La clave ha sido guardada correctamente.
            </p>

            <P>
                Vuelve a iniciar sesión con la nueva clave.
            </P>
        </div>

        <div id="dialogoCorrecto2" title="Nombre guardado">
            <p>
                El nombre ha sido guardado
            </p>
        </div>

        <div id="dialogoCorrecto3" title="Gestión HOTEL">
            <p>
                Los datos han sido guardado correctamente
            </p>
        </div>

        <div id="dialogoNuevaClave" title="Modificación clave de admin">
            <?php include "../../View/administracion/formModificarClaveAdmin.php" ?>
        </div>

        <div id="dialogoNuevoNombre" title="Modificación nombre Hotel">
            <?php include "../../View/administracion/formModificarNombreHotel.php" ?>
        </div>

        <div id="dialogoNuevaUrlSocial" title="Modificación URL Botón Social">
            <?php include "../../View/administracion/formModificarURLRedSocial.php" ?>
        </div>

        <div class="estados elementosOcultos">
            <?php
            foreach ($estadoImg as $key => $value) {
            ?>
                <div id="<?= $key ?>"><?= $value->estado ?></div>
            <?php
            }
            ?>

        </div>

        <div id="nombreAdmin" class="elementosOcultos">
            <?= $_SESSION['nombreAdmin']; ?>
        </div>
    </body>

    </html>

<?php
} else {
    echo "Zona Privada - Requiere Inicio de sesión"; //Mensaje de prueba
?>
    <script>
        window.location.href = "../../Controller/administracion/login.php";
    </script>
<?php
}
