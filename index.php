<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    *{
        margin:0;
        padding:0;
    }


    body{
        background: #1c1c1c;
        color: white;
    }

    .container{
        width:100vw;
        height:100vh;
        display:flex;
        align-items:center;
        justify-content:space-around;
        flex-direction: column;
        font-size: 1.5rem;
    }

    .container > a:hover{
        transform: scale(1.2);
        text-decoration: underline white;
    }

    .container > a{
        color: white;
        text-decoration: none;
        transition: all 300ms;
    }
</style>
<body>
    
    <div class="container">
        <a href="ejercicios/practicas">Prácticas</a>
        <a href="ejercicios/random">Ruleta alumno</a>
    </div>

</body>
</html>