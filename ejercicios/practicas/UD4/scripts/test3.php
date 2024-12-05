<?php
$mActual = date("m");
$aActual = date("Y");
$check = false;

include "conf/config.php";
$av_array = [];


for ($i = A_INICIO; $i <= A_FINAL; $i++){
    $anno = $i . "/" . $i+1;
    if (($i == $aActual && $mActual >= 8) || ($i+1==$aActual && $mActual<=8)){
        $check = true;
        $av_array[] = [$anno, $check];
    } else {
        $check = false;
        $av_array[] = [$anno, $check];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="procesa3.php" method="post" enctype="multipart/form-data">

    Grupo: <select name="grupo">
        <?php 
            foreach($grupos as $grupo){
                echo "<option value=\"$grupo\">$grupo</option>";
            }
        ?>
    </select><br/><br/>

    Formato: <select name="formato">
        <?php 
            foreach($formatos as $formato){
                echo "<option value=\"$formato\">$formato</option>";
            }
        ?>

    </select><br/><br/>


    Curso: <select name="curso">

        <?php foreach ($av_array as $curso): ?>
                <option value="<?php echo htmlspecialchars($curso[0]); ?>" <?php echo $curso[1] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($curso[0]); ?>
                </option>
        <?php endforeach; ?>

    </select><br/><br/>

    <input type="file" name="file" id="file"> <br/>

    <input type="submit" name="enviar" value="Enviar">


</form>

</body>
</html>



