<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title><?= $nombreHotel->nombreHotel?> - Inicio</title>
        <link rel="stylesheet" type="text/css" href="../View/css/main.css">
        <link rel="stylesheet" type="text/css" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="../View/img/favicon.png">
        <script>
           function myFunction() {
              var x = document.getElementById("myTopnav");
              if (x.className === "topnav") {
                  x.className += " responsive";
              } else {
                  x.className = "topnav";
              }
          }
          
          $(document).ready(function(){
            $( ".inputFecha" ).datepicker({
              dateFormat: "dd-mm-yy",
              minDate: 0
            });
            var salida = new Date();
            salida.setDate(salida.getDate() + 2);
            
            $(".fechaEntradaPicker").datepicker("setDate",new Date());
            $(".fechaSalidaPicker").datepicker("setDate",salida);
          });
        </script>    
    </head>
    <body class="fondoCuerpo">
        <div class="cabecera">
            <div class="logoCabecera">
                <img src="../View/img/uploads/<?=$logo->nombre?>" class="imgLogoResponsive"> 
            </div>
            <div class="ocultar flex-container space-between">
              <a href="index.php" class="flex-item seleccionado"><p>Inicio</p></a>
              <a href="usuario/tiposHabitaciones.php" class="flex-item"><p>Habitaciones</p></a>
              <a href="usuario/login.php" class="flex-item"><p>Mi cuenta</p></a>
              <a href="usuario/contacto.php" class="flex-item"><p>Contacto</p></a>
            </div>
        </div>
        
        <div class="contenedor">
            <ul class="topnav" id="myTopnav">
              <li><a class="active" href="index.php">Inicio</a></li>
              <li><a href="usuario/tiposHabitaciones.php">Habitaciones</a></li>
              <li><a href="usuario/login.php">Mi cuenta</a></li>
              <li><a href="usuario/contacto.php">Contacto</a></li>
              <li class="icon">
                  <a href="javascript:void(0);" class="barrasMenu" onclick="myFunction()"><span class="ion-navicon-round"></span></a>
              </li>
            </ul>
            
            
            <div class="contenedorTexto">
                <span class="textoHotel"><?= $nombreHotel->nombreHotel?></span>
            </div>
             
            <div class="formularioReserva">
                <div class="cabeceraReservar">
                  <span class="tituloReservar">¡Reserva ahora!</span>
                  <form action="usuario/habitaciones.php" method="get">
                      <span class="labelFecha">Fecha Entrada:</span><br>
                    <input type="text" class="inputFecha fechaEntradaPicker" name="fechaEntrada" autocomplete="off">
                    <br>
                      <span>Fecha Salida:</span><br>
                    <input type="text" class="inputFecha fechaSalidaPicker" name="fechaSalida" autocomplete="off">
                    <br>
                    <span class="labelFecha">Nº personas:</span><br>
                    <select class="inputPersonas" name="personas">
                        <option value="0" selected="">Seleccione</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select><br>
                    <input type="submit" class="btnEnvioReserva" value="Comprobar">
                  </form> 
                </div>
            </div>       
            <div class="contenedorCarusel">
                <div id="galeriaAnimada">
                  <img src = "../View/img/uploads/<?=$imagenesGaleria[img1]->nombre?>" alt = "Imagen hotel habitacion">
                  <img src = "../View/img/uploads/<?=$imagenesGaleria[img2]->nombre?>" alt = "Piscina">
                  <img src = "../View/img/uploads/<?=$imagenesGaleria[img3]->nombre?>" alt = "Habitacion superior">
                  <img src = "../View/img/uploads/<?=$imagenesGaleria[img4]->nombre?>" alt = "Pasillos">
                  <img src = "../View/img/uploads/<?=$imagenesGaleria[img5]->nombre?>" alt = "Salon">
                </div>
                <div class="footerCarousel">
                  <div class="lemaCarouselDiv">
                    <span class="lemaCarousel">Un mundo ideal, aunque sólo sea por una noche</span> 
                  </div>
                </div>
            </div>
        </div>
    </body>
</html>


