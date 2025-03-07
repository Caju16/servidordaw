<style>
    body {
        background-color:#1f1f1f;
        font-family: Arial, sans-serif;
        color: #fff;
    }

    .error{
        color: red;
        font-weight: bold;
    }

    a{
        color: white;
    }
</style>



<?php if(empty($_SESSION['user'])): ?>

<h1>LOGIN</h1>

<form action="" method="post">
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" value="<?php echo $data['email'];?>">
    <div class="error"><?php echo $data['msjErrorEmail']; ?></div>
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" value="<?php echo $data['password'];?>">
    <div class="error"><?php echo $data['msjErrorPassword']; ?></div>
    <br>
    <label for="captcha"><?php echo $data['num1'] . " + " . $data['num2'] . " = "; ?></label>
    <input type="text" id="captcha" name="captcha">
    <div class="error"><?php echo $data['msjErrorCaptcha']; ?></div>
    <input type="submit" name="enviar" value="Login">
</form>


<h1>REGISTER</h1>

<form action="" method="post" enctype="multipart/form-data">

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" value="<?php echo $data['nombre'];?>">
    <div class="error"><?php echo $data['msjErrorNombre']; ?></div>
    <br>
    <label for="apellidos">Apellidos:</label>
    <input type="text" id="apellidos" name="apellidos" value="<?php echo $data['apellidos'];?>">
    <div class="error"><?php echo $data['msjErrorApellidos']; ?></div>
    <br>
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" value="<?php echo $data['registerEmail'];?>">
    <div class="error"><?php echo $data['msjErrorRegisterEmail']; ?></div>
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" value="<?php echo $data['registerPassword'];?>">
    <br>
    <div class="error"><?php echo $data['msjErrorRegisterPassword']; ?></div>
    <label for="repassword">Repetir password:</label>
    <input type="password" id="repassword" name="repassword" value="<?php echo $data['repassword'];?>">
    <br>
    <div class="error"><?php echo $data['msjErrorRepassword']; ?></div>
    <label for="resumen_perfil">Resumen Perfil:</label>
    <input type="text" id="resumen_perfil" name="resumen_perfil" value="<?php echo $data['resumen_perfil'];?>">
    <div class="error"><?php echo $data['msjErrorResumenPerfil']; ?></div>
    <br>
    <label for="foto">Foto:</label>
    <input type="file" class="form-control" id="pic" name="pic"/>
    <br>
    <div class="error"><?php echo $data['msjErrorFoto']; ?></div>
    <input type="submit" name="register" value="Register">

</form>



<?php else: ?>

<a href="/logout">Logout</a>
<a href="/sistema">Acceso</a>

<?php endif; ?>

<?php

// var_dump($_SESSION);

foreach ($data['usuarios'] as $usuario) {
    echo "<h2>Usuario: " . $usuario['nombre'] . "</h2>";
    if (isset($data['notas'][$usuario['id']])) {
        echo "<ul>";
        foreach ($data['notas'][$usuario['id']] as $nota) {
            echo "<li>Nota: " . $nota['nota'] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No hay notas disponibles para este usuario.</p>";
    }
    if (isset($usuario['foto'])) {
        echo "<img src=" . $usuario['foto'] . " alt='Foto de " . $usuario['nombre'] . "' style='width:100px;height:auto;'>";
    }
}
?>