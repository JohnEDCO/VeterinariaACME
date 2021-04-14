<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css"  href="Css/style.css">
    <title>Iniciar sesion</title>
</head>
<?php
    session_start();
    if(!empty($_SESSION['idRol'])){
        header('location: Controllers/loginController.php');
    }else{
        session_destroy();
?>

<body>
    <img class="wave" src="Img/waveRojo.png" alt="">

    <div class="contenedor">
        <div class="img">
            <img src="Img/team.svg" alt="">
        </div>
        <div class="contenido-login">
            <form action="Controllers/loginController.php" method="post">
                <img src="Img/logoAcme.png" alt="">
                <h2>Veterinaria ACME</h2>
                <div class="input-div email">
                    <div class="i">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="div">
                        <h5>Email</h5>
                        <input type="text" name="user" class="input">
                    </div>
                </div>
                <div class="input-div password">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Contraseña</h5>
                        <input type="password" name="pass" class="input">
                    </div>
                </div>

                <input type="submit" class="btn" value="Iniciar Sesion">
            </form>
        </div>
    </div>
</body>
    <script src="Js/app.js"></script>

</html>
<?php
}
?>