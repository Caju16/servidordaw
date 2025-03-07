<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <?php
        /**
         *
         *  FOTOS Y COLORES SEGÚN LA ESTACIÓN Y HORA
         *  @author Miguel Carmona
         * 
        */
            // OBTENER HORARIO DE ESPAÑA Y TRADUCIR LOS MESES A ESPAÑOL:
            date_default_timezone_set('Europe/Madrid');
            setlocale(LC_TIME, 'es_ES.UTF-8');  

            $mes = strftime('%B'); 

            // INICIALIZAR VARIABLE IMAGEN

            $imagen = '';

            // COMPROBACIÓN SEGÚN LA VARIABLE MES.
            // AJUSTAMOS CADA CASE SEGÚN LOS MESES.

            switch ($mes) {
                case 'marzo': case 'abril': case 'mayo':
                    $imagen = 'primavera.jpg';
                    break;
                case 'junio': case 'julio': case 'agosto':
                    $imagen = 'verano.jpeg';
                    break;
                case 'septiembre': case 'octubre': case 'noviembre':
                    $imagen = 'otonio.jpg';
                    break;
                case 'diciembre': case 'enero': case 'febrero':
                    $imagen = 'invierno.jpeg';
                    break;
                default:
                    $imagen = 'default.jpg';
                    break;
            }

            // OBTENER HORA E INICIALIZAR VARIABLE COLOR DEL FONDO

            $hora = date('H:i');
            $colorFondo = '';

            // SI LA HORA ESTÁ DENTRO DE LAS DEFINIDIAS, REAJUSTA EL COLOR
            // DEL FONDO

            if ($hora >= '06:00' && $hora < '09:00') {
                $colorFondo = '#5087d4ee'; 
            } elseif ($hora >= '09:00' && $hora < '12:00') {
                $colorFondo = '#124996ee';
            } elseif ($hora >= '12:00' && $hora < '18:00') {
                $colorFondo = '#995a2fee';
            } elseif ($hora >= '18:00' && $hora < '21:00') {
                $colorFondo = '#823c05ee';
            } else {
                $colorFondo = '#0d0d47ee';
            }


    ?>
</head>
<body style="background:">
    <div class="container">
        <div class="header">
                 <img src="<?php echo $imagen; ?>" class="estaciones" alt="Estación del año">
        </div>
        <div class="pseudocontainer" style="background: <?php echo $colorFondo?>">
            <h1 class="title">Portfolio</h1>
            <hr class="line"><br>
            <img src="yo.jpg" class="image" alt="Foto personal">
            <hr class="line">
        </div>
        <div class="pseudocontainer second" style="background: <?php echo $colorFondo?>">
            <div class="info">
                <ul>
                    <li>
                        Miguel Carmona Cicchetti
                    </li><br>
                    <li>
                        24 años
                    </li><br>
                    <li>
                        Córdoba | España
                    </li><br>
                </ul>
            </div>
            <div class="info">
                <h2>Experiencias previas</h2><br><br>
                <ul>
                    <li>2012-2017: Educación Secundaria Obligatoria - Colegio Séneca</li><br>
                    <li>2017-2019: Grado Medio - Sistemas Microinformáticos y Redes - I.E.S Fidiana</li><br>
                    <li>2019-2021: Grado Superior - Animaciones 3D, Juegos y Entornos Interactivos - I.E.S Ángel de Saavedra</li><br>
                    <li>2022-2024: Grado Superior - Desarrollo de Aplicaciones Multiplataforma - C.E.S Lope de Vega</li><br>
                    <li>2024-Actual: Grado Superior - Desarrollo de Aplicaciones Web - I.E.S Gran Capitán</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>