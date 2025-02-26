<?php

session_start();

$_POST['enviar'] = $_POST['enviar'] ?? null;
$_POST['intentar'] = $_POST['intentar'] ?? null;
$_POST['historial'] = $_POST['historial'] ?? null;
$_POST['reiniciar'] = $_POST['reiniciar'] ?? null;
$i = 0;

echo "<h1>Mastermind</h1>";

echo "<form action='' method='post'>";
echo "<input type='submit' name='enviar' value='Empezar juego'>";
echo "<input type='submit' name='reiniciar' value='Reiniciar juego'>";
echo "</form>";

$colores = ['Rojo', 'Verde', 'Azul', 'Amarillo'];

if (isset($_POST['enviar'])) {
    if(!isset($_SESSION['mastermind'])){
        $_SESSION['mastermind'] = [
            'combinacion' => [],
            'intentos' => 0,
            'historial' => []
        ];
    }

    echo "Combinacion secreta: ";

    if(count($_SESSION['mastermind']['combinacion']) > 0){
        $_SESSION['mastermind']['combinacion'] = [];
    }

    for($i = 0; $i < 4; $i++){
        $numero = rand(0, 3);
        $color = $colores[$numero];
        echo $color . " ";
        $_SESSION['mastermind']['combinacion'][] = $color;
    }

    $_SESSION['mastermind']['intentos'] += 1;

    echo "<br>Intentos: " . $_SESSION['mastermind']['intentos'];
}

if(isset($_POST['intentar'])){
    $combinacionUsuario = [];
    for($i = 0; $i < 4; $i++){
        $combinacionUsuario[] = $_POST["casilla_$i"];
    }

    $_SESSION['mastermind']['historial'][] = $combinacionUsuario;

    $aciertos = 0;
    $casiAciertos = 0;

    for($i = 0; $i < 4; $i++){
        if($combinacionUsuario[$i] == $_SESSION['mastermind']['combinacion'][$i]){
            $aciertos += 1;
        } else if(in_array($combinacionUsuario[$i], $_SESSION['mastermind']['combinacion'])){
            $casiAciertos += 1;
        }
    }

    echo "Aciertos: $aciertos<br>";
    echo "Casi aciertos: $casiAciertos<br>";

    if($aciertos == 4){
        echo "Has ganado!";
    }
}


    echo "<form action='' method='post'>";
    foreach ($_SESSION['mastermind']['historial'] as $intento) {
        foreach ($intento as $color) {
            echo "<select name='casilla_$i' disabled>";
            echo "<option value='$color' selected>$color</option>";
            echo "</select> ";
        }
        echo "<br>";
    }
    
    for ($i = 0; $i < 4; $i++) {
        echo "<select name='casilla_$i'>";
        foreach ($colores as $color) {
            echo "<option value='$color'>$color</option>";
        }
        echo "</select> ";
    }
    echo "<input type='submit' name='intentar' value='Intentar'>";
    echo "</form>";




if (isset($_POST['reiniciar'])) {
    $_SESSION['mastermind'] = [
        'combinacion' => [],
        'intentos' => 0,
        'historial' => []
    ];


}

echo "<br/>";
// var_dump($_SESSION['mastermind']);

?>