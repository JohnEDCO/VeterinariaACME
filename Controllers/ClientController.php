<?php
include_once '../Models/Cliente.php';

$cliente = new Cliente();

if($_POST['funcion'] == 'crear-cliente'){

    $json = array();

    $documento = $_POST['documentoC'];
    $tipoDoc = $_POST['tipoDocC'];
    $nombre = $_POST['nombreC'];
    $apellido = $_POST['apellidoC'];
    $telefono = $_POST['telefonoC'];
    $email = $_POST['emailC'];
    $direccion= $_POST['direccionC'];

    $cliente->registrar_cliente($nombre, $apellido, $telefono, $email, $direccion, $tipoDoc, $documento);
}

if($_POST['funcion'] == 'obtener-clientes'){
    $json = array();
    $cliente->obtener_clientes();

    foreach ($cliente->objetos as $objeto){

        $json[]=array(
            'idCliente'=>$objeto->idcliente,
            'nombre'=>$objeto->nombrecliente,
            'apellido'=>$objeto->apellidocliente,
            'email'=>$objeto->email,
            'telefono'=>$objeto->telefono,
            'direccion'=>$objeto->direccion,
            'tipoDoc'=>$objeto->tipodocumento,
            'numeroDoc' => $objeto->numerodocumento
        );
    }
    $jsonString = json_encode($json);
    echo $jsonString;

}
//Editar cliente seleccionado
if ($_POST['funcion'] == 'editar-cliente'){

    $id = $_POST['idCliente'];
    $documento = $_POST['documentoC'];
    $tipoDoc = $_POST['tipoDocC'];
    $nombre = $_POST['nombreC'];
    $apellido = $_POST['apellidoC'];
    $telefono = $_POST['telefonoC'];
    $email = $_POST['emailC'];
    $direccion= $_POST['direccionC'];

    $cliente->editar_cliente($id,$documento, $tipoDoc, $nombre, $apellido, $telefono, $email,$direccion );

    echo 1; //significa que fue editado

}

//Borra cliente seleccionado
if($_POST['funcion'] == 'borrar-cliente'){

    $id = $_POST['idCliente'];

    $cliente->borrar_cliente($id);

}
?>