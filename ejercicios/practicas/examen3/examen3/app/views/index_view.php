<style>
    body {
        background-color:#1f1f1f;
        font-family: Arial, sans-serif;
        color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        flex-direction: column;
        height: 80vh;
    }
</style>

<?php if(empty($_SESSION['user'])): ?>

<h1>LOGIN</h1>

<form action="" method="post">
    <label for="usuario">Usuario:</label>
    <input type="text" id="usuario" name="usuario" value="<?php echo $data['usuario'];?>">
    <div class="error"><?php echo $data['msjErrorUser']; ?></div>
    <br/>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" value="<?php echo $data['password'];?>">
    <div class="error"><?php echo $data['msjErrorPassword']; ?></div>
    <br/>
    <label for="captcha">Selecciona un: <?php echo $_SESSION['captcha']; ?></label>
    <div>
        <input type="radio" id="captcha1" name="captcha" value="Coche">
        <label for="captcha1">🚗</label>
    </div>
    <div>
        <input type="radio" id="captcha2" name="captcha" value="Semaforo">
        <label for="captcha2">🚦</label>
    </div>
    <div>
        <input type="radio" id="captcha3" name="captcha" value="Peaton">
        <label for="captcha3">🚷</label>
    </div>
    <div class="error"><?php echo $data['msjErrorCaptcha']; ?></div>
    <br/>
    <input type="submit" name="enviar" value="Login">
    <br/>
</form>



<?php else: ?>
    
    <a href="/logout">Logout</a>
    <a href="/listado">Listado</a>
    
<?php endif; ?>

<iframe width="560" height="315" src="https://www.youtube.com/embed/XyHdFT1OQr4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>