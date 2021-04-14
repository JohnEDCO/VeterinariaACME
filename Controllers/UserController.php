<?php
    include_once '../Models/Usuario.php';

    $usuario = new Usuario();

    if ($_POST['funcion'] == 'buscar_usuario'){
        $json = array();
        $usuario->obtener_datos($_POST['dato']);

        foreach($usuario->objetos as $objeto){
            $json[]=array(
                'nombre'=>$objeto->nombre,
                'apellido'=>$objeto->apellido,
                'telefono'=>$objeto->telefono,
                'email'=>$objeto->email,
                'password'=>$objeto->password,
                'idRol'=>$objeto->idrol,
                'tipo'=>$objeto->tipo
            );
        }
        $jsonString = json_encode($json[0]);
        echo $jsonString;
    }

    if ($_POST['funcion'] == 'capturar_datos'){
    $json = array();
    $idUsuario = $_POST['idUsuario'];
    $usuario->obtener_datos($idUsuario);

    foreach($usuario->objetos as $objeto){
        $json[]=array(
            'nombre'=>$objeto->nombre,
            'apellido'=>$objeto->apellido,
            'telefono'=>$objeto->telefono,
            'email'=>$objeto->email,

        );
    }
    $jsonString = json_encode($json[0]);
    echo $jsonString;
    }

if ($_POST['funcion'] == 'editar_usuario'){

    $idUsuario = $_POST['idUsuario'];
    $nombre = $_POST['nombreU'];
    $apellido = $_POST['apellidoU'];
    $telefono = $_POST['telefonoU'];
    $email = $_POST['emailU'];

    $usuario->editar($idUsuario, $nombre, $apellido, $telefono, $email);

    echo 1; //significa que fue editado

}

if($_POST['funcion'] == 'cambiar-contraseña'){

    $oldPass = $_POST['oldPass'];
    $newPass = $_POST['newPass'];
    $idUsuario = $_POST['idUsuario'];

    $usuario->cambiar_contraseña($idUsuario, $newPass, $oldPass);

}
?>