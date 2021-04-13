<?php
    include_once '../Models/Usuario.php';

    session_start();
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $usuario = new Usuario();


    if(!empty($_SESSION['idRol'])){

        switch ($_SESSION['idRol']){
            case 8:
                header('location: ../Views/adm_catalogo.php');
                break;
            case 9:
                header('location: ../Views/vet_catalogo.php');
                break;
            case 10:
                header('location: ../Views/rec_catalogo.php');
                break;
        }

    }else {
            $usuario->loguearse($user, $pass);
            if(!empty($usuario->objetos)){

            foreach ($usuario->objetos as $objeto){
                $_SESSION['idUsuario'] = $objeto->idusuario;
                $_SESSION['idRol'] = $objeto->idrol;
                $_SESSION['nombreUsuario'] = $objeto->nombre;
                $_SESSION['tipoRol'] = $objeto->tipo;
            }
            switch ($_SESSION['idRol']){
                case 8:
                    header('location: ../Views/adm_catalogo.php');
                    break;
                case 9:
                    header('location: ../Views/vet_catalogo.php');
                    break;
                case 10:
                    header('location: ../Views/rec_catalogo.php');
                    break;
            }

        }else{
            header('location: ../index.php');
        }
    }
?>