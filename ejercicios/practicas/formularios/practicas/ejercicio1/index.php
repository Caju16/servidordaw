<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario</title>
    <style>
        .colores {
            display: flex;
            font-weight: bold;
        }
        .nacionales {
            background: red;
            border: 2px solid black;
        }
        .comunidad {
            background: green;
            color: white;
            border: 2px solid black;
        }
        .local {
            background: yellow;
            border: 2px solid black;
        }
        .domingo {
            background: purple;
            color: white;
            border: 2px solid black;
        }
        .actual {
            background: blue;
            color: white;
            border: 2px solid black;
        }
        .semana_santa {
            background: #D2B48C;
            border: 2px solid black;
        }
        div > * {
            padding: 5px;
            margin: 2px;
        }
    </style>
</head>
<body>
    <?php
        function get_easter_datetime($year) {
            $base = new DateTime("$year-03-21");
            $days = easter_days($year);
            return $base->add(new DateInterval("P{$days}D"));
        }

        function get_holy_thursday_friday($year) {
            $easter = get_easter_datetime($year);
            $thursday = clone $easter;
            $friday = clone $easter;
            $thursday->modify('-3 days');
            $friday->modify('-2 days');
            return ['thursday' => $thursday, 'friday' => $friday];
        }

        $monthTranslation = array(
            "January" => "Enero",
            "February" => "Febrero",
            "March" => "Marzo",
            "April" => "Abril",
            "May" => "Mayo",
            "June" => "Junio",
            "July" => "Julio",
            "August" => "Agosto",
            "September" => "Septiembre",
            "October" => "Octubre",
            "November" => "Noviembre",
            "December" => "Diciembre"
        );

        $selectedMonth = isset($_POST['meses']) ? $_POST['meses'] : $monthTranslation[date('F')];
        $selectedYear = isset($_POST['anios']) ? $_POST['anios'] : date('Y');
        $months = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

    ?>
    <form action="" method="post" novalidate>
        <select name="meses">
            <?php 
                foreach ($months as $month) {
                    $selected = ($month == $selectedMonth) ? 'selected' : '';
                    echo '<option value="'. $month .'" '. $selected .'>'.$month.'</option>';
                }
            ?>
        </select>
        <select name="anios">
            <?php 
                for ($year = 1900; $year <= 2150; $year++) { 
                    $selected = ($year == $selectedYear) ? 'selected' : '';
                    echo "<option value='$year' $selected>$year</option>";
                }
            ?>
        </select>
        <input type="submit" name="enviar" value="Enviar">
    </form> <br>
    <div class="colores">
        <div><span class="nacionales">Nacionales</span></div>
        <div><span class="comunidad">Andalucía</span></div>
        <div><span class="local">Locales</span></div>
        <div><span class="domingo">Domingo</span></div>
        <div><span class="actual">Hoy</span></div>
        <div><span class="semana_santa">Semana Santa (Jueves y Viernes)</span></div>
    </div>

    <?php
        $mesElegido = $_POST['meses'];
        $anioElegido = $_POST['anios'];

        if($mesElegido == NULL && $anioElegido == NULL){
            $mesElegido = $monthTranslation[date('F')];
            $anioElegido = date('Y');
        };


        $meses = [
            'Enero' => 1, 'Febrero' => 2, 'Marzo' => 3, 'Abril' => 4,
            'Mayo' => 5, 'Junio' => 6, 'Julio' => 7, 'Agosto' => 8,
            'Septiembre' => 9, 'Octubre' => 10, 'Noviembre' => 11, 'Diciembre' => 12
        ];

        $mesElegido = $meses[$mesElegido];
        $primerDia = mktime(0, 0, 0, $mesElegido, 1, $anioElegido);
        $díasEnMes = date('t', $primerDia);
        $nombreMesEsp = $monthTranslation[date('F', $primerDia)];
        $indicePrimerDia = date('w', $primerDia);

        $festivosNacionales = ['1-1', '6-1', '1-5', '15-8', '12-10', '1-11', '6-12', '25-12'];
        $festivosComunidad = ['28-2'];
        $festivosLocales = ['9-9', '24-10'];
        
        $semanaSanta = get_holy_thursday_friday($anioElegido);
        $juevesSanto = $semanaSanta['thursday']->format('j-n');
        $viernesSanto = $semanaSanta['friday']->format('j-n');

        echo "<h2>Calendario de $nombreMesEsp $selectedYear</h2>";
        echo "<table border='1' cellpadding='10'><tr><th>Lunes</th><th>Martes</th><th>Miércoles</th><th>Jueves</th><th>Viernes</th><th>Sábado</th><th>Domingo</th></tr><tr>";

        $indicePrimerDia = ($indicePrimerDia + 6) % 7; 

        for ($i = 0; $i < $indicePrimerDia; $i++) {
            echo "<td></td>";
        }

        for ($día = 1; $día <= $díasEnMes; $día++) {
            $fecha = "$día-$mesElegido";

            $esHoy = ($día == date('j')) && ($mesElegido == date('n')) && ($anioElegido == date('Y'));
            $esFestivoNacional = in_array($fecha, $festivosNacionales);
            $esFestivoComunidad = in_array($fecha, $festivosComunidad);
            $esFestivoLocal = in_array($fecha, $festivosLocales);
            $esJuevesViernesSanto = ($fecha == $juevesSanto || $fecha == $viernesSanto);

            if ($esHoy) {
                $backgroundColor = 'blue';
                $textColor = 'white';
            } elseif ($esFestivoNacional) {
                $backgroundColor = 'red';
                $textColor = 'white';
            } elseif ($esFestivoComunidad) {
                $backgroundColor = 'green';
                $textColor = 'white';
            } elseif ($esFestivoLocal) {
                $backgroundColor = 'yellow';
                $textColor = 'black';
            } elseif ($esJuevesViernesSanto) {
                $backgroundColor = '#D2B48C';
                $textColor = 'black';
            } elseif (($día + $indicePrimerDia) % 7 == 0) {
                $backgroundColor = 'purple';
                $textColor = 'white';
            } else {
                $backgroundColor = 'white';
                $textColor = 'black';
            }

            echo "<td style='background-color: $backgroundColor; color: $textColor; cursor: pointer;' 
                        onclick=\"window.open('', '', 'width=400,height=200').document.write('<h1>Día: $día-$nombreMesEsp-$anioElegido</h1>');\">
                        $día
                    </td>";

            if (($día + $indicePrimerDia) % 7 == 0) {
                echo "</tr><tr>";
            }
        }

        if (($díasEnMes + $indicePrimerDia) % 7 != 0) {
            for ($i = ($díasEnMes + $indicePrimerDia) % 7; $i < 7; $i++) {
                echo "<td></td>";
            }
        }

        echo "</tr>";
        echo "</table>";
    ?>
</body>
</html>
