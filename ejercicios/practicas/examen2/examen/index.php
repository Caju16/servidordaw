<?php
session_start();

// Iniciar las sesiones para empezar el juego

if (!isset($_SESSION['nuevoJuego'])) {
    $_SESSION['mesa'] = generarBaraja();
    $_SESSION['cartasJugador'] = [];
    $_SESSION['cartasBanca'] = [];
    $_SESSION['jugadorPuntos'] = 0;
    $_SESSION['puntosBanca'] = 0;

    // Iniciamos el riesgo de la banca de forma aleatoria

    $_SESSION['riesgo'] = rand(17, 21);

    // Llamamos a la función de repartir cartas iniciales

    repartirCartasIniciales();
}


// Generamos la baraja y cargamos la mesa

function generarBaraja() {
    $posibilidades = ['C', 'P', 'T', 'D'];
    $numeros = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
    $mesa = [];
    foreach ($posibilidades as $posibilidad) {
        foreach ($numeros as $value) {
            $mesa[] = $value . $posibilidad;
        }
    }
    shuffle($mesa);
    return $mesa;
}

// Función de repartir las cartas iniciales

function repartirCartasIniciales() {

    // Agregamos en los arrays de las sesiones, el array que haya en la mesa en
    // ese momento

    $_SESSION['cartasJugador'][] = array_shift($_SESSION['mesa']);
    $_SESSION['cartasJugador'][] = array_shift($_SESSION['mesa']);
    $_SESSION['cartasBanca'][] = array_shift($_SESSION['mesa']);
    $_SESSION['cartasBanca'][] = array_shift($_SESSION['mesa']);
    calcularPuntuacion();
}

// Calculamos la puntuación en función de lo que tenga en la mano el jugador y la banca
function calcularPuntuacion() {
    $_SESSION['puntosJugador'] = calcularMano($_SESSION['cartasJugador']);
    $_SESSION['puntosBanca'] = calcularMano($_SESSION['cartasBanca']);
}


// función para calcular la mano, ya sea de la banca o del usuario

function calcularMano($cards) {

    // guardamos en values un mapeo del array del argumento pasado anteriormente

    $values = array_map(function($card) {
        return substr($card, 0, -1);
    }, $cards);

    // inicializamos los puntos y los ases

    $score = 0;
    $ases = 0;

    // Recorremos los valores comprobando si el valor es númerico.
    // Si lo es, lo suma

    foreach ($values as $value) {
        if (is_numeric($value)) {
            $score += intval($value);
        } elseif ($value === 'J' || $value === 'Q' || $value === 'K') {
            $score += 10;
        } elseif ($value === 'A') {
            $ases++;
        }
    }

    // Mientras que los ases sean mayor que 0
    // se va comprobando la condición de victoria
    // que la suma de los puntos de los ases no llegue
    // o se pase de 21

    while ($ases > 0) {
        if ($score + 11 <= 21) {
            $score += 11;
        } else {
            $score += 1;
        }
        $ases--;
    }

    return $score;
}






?>




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<h1>Blackjack</h1>
    <h2>Jugador</h2>
    <p>Cartas: <?php echo implode(', ', $_SESSION['cartasJugador']); ?></p>
    <p>Puntuación: <?php echo $_SESSION['puntosJugador']; ?></p>

    <h2>Banca</h2>
    <p>Cartas: <?php echo $_SESSION['cartasBanca'][0] . ', ?'; ?></p>

    <?php if (isset($ganador)): ?>
        <h2>Resultado</h2>
        <p><?php echo $ganador; ?></p>
    <?php endif; ?>

    <form method="post">
        <?php if (!isset($ganador)): ?>
            <button type="submit" name="pedir" value="Pedir carta">Pedir carta</button>
            <button type="submit" name="plantarse" value="Plantarse">Plantarse</button>
        <?php endif; ?>
        <button type="submit" name="reiniciar" value="Reiniciar">Reiniciar</button>
    </form>


</html>