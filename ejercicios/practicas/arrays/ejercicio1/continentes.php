
<?php
$potencias = [
    [
        'continente' => 'América del Norte',
        'pais' => 'Estados Unidos',
        'capital' => 'Washington D.C.',
        'bandera' => 'https://www.banderasphonline.com/wp-content/uploads/2020/05/comprar-bandera-estados-unidos-para-mastil-exterior-interior.png'
    ],
    [
        'continente' => 'Asia',
        'pais' => 'China',
        'capital' => 'Pekín',
        'bandera' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/fa/Flag_of_the_People%27s_Republic_of_China.svg/800px-Flag_of_the_People%27s_Republic_of_China.svg.png'
    ],
    [
        'continente' => 'Europa',
        'pais' => 'Alemania',
        'capital' => 'Berlín',
        'bandera' => 'https://upload.wikimedia.org/wikipedia/commons/b/ba/Flag_of_Germany.svg' 
    ],
    [
        'continente' => 'Asia',
        'pais' => 'Japón',
        'capital' => 'Tokio',
        'bandera' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9e/Flag_of_Japan.svg/2560px-Flag_of_Japan.svg.png' 
    ],
    [
        'continente' => 'Europa',
        'pais' => 'Reino Unido',
        'capital' => 'Londres',
        'bandera' => 'https://upload.wikimedia.org/wikipedia/commons/a/a5/Flag_of_the_United_Kingdom_%281-2%29.svg' 
    ],
    [
        'continente' => 'América del Sur',
        'pais' => 'Brasil',
        'capital' => 'Brasilia',
        'bandera' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Flag_of_Brazil.svg/300px-Flag_of_Brazil.svg.png' 
    ],
    [
        'continente' => 'Asia',
        'pais' => 'India',
        'capital' => 'Nueva Delhi',
        'bandera' => 'https://miviajealaindia.com/wp-content/uploads/2021/05/la-bandera-de-la-india-hoy.png' 
    ],
    [
        'continente' => 'Europa',
        'pais' => 'Francia',
        'capital' => 'París',
        'bandera' => 'https://upload.wikimedia.org/wikipedia/commons/c/c3/Flag_of_France.svg' 
    ],
    [
        'continente' => 'América del Norte',
        'pais' => 'Canadá',
        'capital' => 'Ottawa',
        'bandera' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d9/Flag_of_Canada_%28Pantone%29.svg/640px-Flag_of_Canada_%28Pantone%29.svg.png' 
    ],
    [
        'continente' => 'Asia',
        'pais' => 'Corea del Sur',
        'capital' => 'Seúl',
        'bandera' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/09/Flag_of_South_Korea.svg/800px-Flag_of_South_Korea.svg.png' 
    ]
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Potencias Económicas Mundiales</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>

<h1>Las 10 Primeras Potencias Mundiales Económicas</h1>

<table>
    <thead>
        <tr>
            <th>Continente</th>
            <th>País</th>
            <th>Capital</th>
            <th>Bandera</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($potencias as $potencia): ?>
            <tr>
                <td><?php echo $potencia['continente']; ?></td>
                <td><?php echo $potencia['pais']; ?></td>
                <td><?php echo $potencia['capital']; ?></td>
                <td><img src="<?php echo $potencia['bandera']; ?>" alt="Bandera de <?php echo $potencia['pais']; ?>" width="50"></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
