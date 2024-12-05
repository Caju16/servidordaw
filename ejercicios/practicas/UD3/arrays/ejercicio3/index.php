<?php
/**
 *  Array alumno aleatorio con su foto
 *  @author Miguel Carmona
 * 
 */

$alumnos = [
    'Raúl Bermúdez González' => 'https://adoma.es/wp-content/uploads/2013/07/gustavo.jpg',
    'Carlos Borreguero Redondo' => 'https://toughpigs.com/wp-content/uploads/2015/09/Gonzo-sweater-vest1.png',
    'Álvaro Cañas González' => 'https://www.clarin.com/2011/12/02/Hybym5G0Xg_1200x0.jpg',
    'Miguel Carmona Cicchetti' => 'https://ih1.redbubble.net/image.4552025982.0438/flat,750x,075,f-pad,750x1000,f8f8f8.jpg',
    'Alejandro Carrasco Castellano' => 'https://i.pinimg.com/550x/5b/70/7c/5b707c442f808a09099bb48019e3c7e1.jpg',
    'Mostafa Cherif Mouaki Almabouada' => 'https://www.giantbomb.com/a/uploads/square_small/0/5768/687221-animal.jpg',
    'Alejandro Coronado Ortega' => 'https://themuppetstudy.com/images/muppetImages/floydPepper.png',
    'Juan Diego Delgado Morente' => 'https://kids.kiddle.co/images/6/6d/Walter_%28Muppet%29.jpg',
    'Marlon Jafet Escoto García' => 'https://www.giantbomb.com/a/uploads/square_small/17/174460/2794979-4232898384-Dr._B.jpg',
    'Ángel Fernández Ariza' => 'https://static.tvtropes.org/pmwiki/pub/images/fozzie_transparent.png',
    'Alejandro Fernández Arrayás' => 'https://static.tvtropes.org/pmwiki/pub/images/samjpg0bd0c34e6e5fa7e7976038398d51219e.jpg',
    'Daniel Fernández Balsera' => 'https://pyxis.nymag.com/v1/imgs/9a9/cbe/e06bca977f374429724184157e41c0b951-muppets-Dr-Teeth-.2x.rsquare.w570.jpg',
    'Jesús Ferrer López' => 'https://tiermaker.com/images/media/template_images/2024/17259123/the-muppets-characters-17259123/img2139.png',
    'Jesús Frías Rojas' => 'https://tiermaker.com/images/media/template_images/2024/17259123/the-muppets-characters-17259123/img2181.png',
    'Manuel Galán Navas' => 'https://i.ebayimg.com/images/g/4UkAAOSw2SJlKtOr/s-l1200.jpg',
    'Víctor García Báez' => 'https://www.giantbomb.com/a/uploads/square_small/17/174460/2796317-0020890722-statl.jpg',
    'Lucía García Díaz' => 'https://pyxis.nymag.com/v1/imgs/096/8eb/385980dd83957a2e42914e014684877ddd-muppets-waldorf.2x.rsquare.w570.jpg',
    'Adrián González Martínez' => 'https://comicvine.gamespot.com/a/uploads/square_small/11/111746/7229641-crazy_harry.jpg.jpg',
    'Jesús López Funes' => 'https://upload.wikimedia.org/wikipedia/en/thumb/e/e7/The_Swedish_Chef.jpg/220px-The_Swedish_Chef.jpg',
    'Enrique Mariño Jiménez' => 'https://i.pinimg.com/236x/13/8f/d0/138fd0f99ee7f2ad4394992eb6fd0ac3.jpg',
    'Oscar Martín-Castaño Carrillo' => 'https://i.pinimg.com/originals/c4/a7/0d/c4a70d5e498646f156bc574a6696b0bd.png',
    'José María Mayén Pérez' => 'https://www.postavy.cz/foto/cookie-monster-foto.jpg',
    'Pablo Mérida Velasco' => 'https://sesameworkshop.org/wp-content/uploads/2023/03/presskit_ss_bio_bigbird.png',
    'Héctor Mora Sánchez' => 'https://i.pinimg.com/1200x/2a/e8/d7/2ae8d7ad561818c049bf697b84925c9c.jpg',
    'Luis Pérez Cantarero' => 'https://yofuiaegb.com/wp-content/uploads/2014/05/Traque.jpg',
    'Carlos Romero Romero' => 'https://yofuiaegb.com/wp-content/uploads/2014/05/Profesor-Lumbrera-Barrio-Se.jpg',
    'Javier Ruiz Molero' => 'https://yofuiaegb.com/wp-content/uploads/2014/05/Juan-Olvido.jpg',
    'Alejandro Vaquero Abad' => 'https://i.pinimg.com/236x/69/dd/d3/69ddd3b32534d35a0874b3a1774dcfa0.jpg',
    'Luis Miguel Villén Moyano' => 'https://i.pinimg.com/550x/cb/3a/d9/cb3ad9f66d7a15b870851b1445935994.jpg'
];

$alumnoSeleccionado = '';
$imagenSeleccionada = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombres = array_keys($alumnos);
    $indiceAleatorio = array_rand($nombres);
    $alumnoSeleccionado = $nombres[$indiceAleatorio];
    $imagenSeleccionada = $alumnos[$alumnoSeleccionado];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Alumno</title>
    <style>
        #resultado {
            margin-top: 20px;
            font-size: 24px;
            font-weight: bold;
        }
        img {
            margin-top: 10px;
            max-width: 200px; 
        }
    </style>
</head>
<body>

    <form method="post">
        <button type="submit">Seleccionar Alumno</button>
    </form>

    <?php if ($alumnoSeleccionado): ?>
        <div id="resultado"><?php echo $alumnoSeleccionado; ?></div>
        <img id="imagenAlumno" src="<?php echo $imagenSeleccionada; ?>" alt="Imagen del Alumno">
    <?php endif; ?>

</body>
</html>
