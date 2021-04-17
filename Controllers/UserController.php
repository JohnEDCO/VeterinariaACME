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

if ($_POST['funcion'] == 'editar-usuario-adm'){

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
//---------------------------------USUARIOS------------------------------------------
if($_POST['funcion'] == 'obtener-roles'){
    $json = array();
    $usuario->obtener_roles();

    foreach ($usuario->objetos as $objeto){

        $json[]=array(
            'idRol'=>$objeto->idrol,
            'tipo'=>$objeto->tipo

        );
    }
    $jsonString = json_encode($json);
    echo $jsonString;

}

if($_POST['funcion'] == 'obtener-usuarios'){
    $json = array();
    $usuario->obtener_usuarios();

    foreach ($usuario->objetos as $objeto){

        $json[]=array(
            'idUsuario'=>$objeto->idusuario,
            'nombre'=>$objeto->nombre,
            'apellido'=>$objeto->apellido,
            'email'=>$objeto->email,
            'telefono'=>$objeto->telefono,
            'password'=>$objeto->password,
            'tipoRol'=>$objeto->tipo,
            'idRol' => $objeto->idrol
        );
    }
    $jsonString = json_encode($json);
    echo $jsonString;

}

if($_POST['funcion'] == 'crear-usuario'){

    $json = array();

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $idRol = $_POST['idRol'];

    $usuario->registrar_usuario($nombre, $apellido, $telefono, $email, $password, $idRol);
}

if($_POST['funcion'] == 'borrar-usuario'){

    $id = $_POST['id'];

    $usuario->borrar_usuario($id);

}

if ($_POST['funcion'] == 'editar-usuario'){

    $idUsuario = $_POST['id'];
    $nombre = $_POST['nombreU'];
    $apellido = $_POST['apellidoU'];
    $telefono = $_POST['telefonoU'];
    $email = $_POST['emailU'];
    $idrol = $_POST['idrol'];

    $usuario->editar_usuario($idUsuario, $nombre, $apellido, $telefono, $email, $idrol);

    echo 1; //significa que fue editado

}
//---------------------------------USUARIOS------------------------------------------
?>