<?php
include_once '../Models/Mascota.php';
include_once '../Models/Cliente.php';

$mascota = new Mascota();
$cliente = new Cliente();

if($_POST['funcion'] == 'crear-mascota'){

    $json = array();
    $nombreM = $_POST['nombreM'];
    $razaM = $_POST['razaM'];
    $idTipo = $_POST['idTipo'];
    $edadM = $_POST['edadM'];
    $fechaNacM = $_POST['fechaNacM'];
    $idClienteM = $_POST['idClienteM'];

    $mascota->registrar_mascota($nombreM, $razaM, $idTipo, $edadM, $fechaNacM, $idClienteM);
}

if($_POST['funcion'] == 'obtener-mascotas'){
    $json = array();
    $mascota->obtener_mascotas();

    foreach ($mascota->objetos as $objeto){

        $json[]=array(
            'idCliente'=> $objeto->idcliente,
            'nombreCliente' => $objeto->nombrecliente,
            'apellidoCliente'=> $objeto->apellidocliente,
            'idMascota'=>$objeto->idmascota,
            'nombre'=>$objeto->nombre,
            'raza'=>$objeto->raza,
            'tipo'=>$objeto->tipo,
            'idTipo' => $objeto->idtipomascota,
            'edad'=>$objeto->edad,
            'fechaNac'=>$objeto->fechanacimiento

        );

    }
    $jsonString = json_encode($json);
    echo $jsonString;

}
if($_POST['funcion'] == 'obtener-dueños'){
    $json = array();
    $mascota->obtener_dueños();

    foreach ($mascota->objetos as $objeto){

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
if($_POST['funcion'] == 'obtener-tipo-mascota') {
    $json = array();
    $mascota->obtener_tipos_mascota();

    foreach ($mascota->objetos as $objeto){

        $json[]=array(
            'idTipoM'=>$objeto->idtipomascota,
            'tipo'=>$objeto->tipo

        );
    }
    $jsonString = json_encode($json);
    echo $jsonString;

}
//Editar mascota seleccionada desde la tabla
if ($_POST['funcion'] == 'editar-mascota'){

    $id = $_POST['idCliente'];
    $documento = $_POST['documentoC'];
    $tipoDoc = $_POST['tipoDocC'];
    $nombre = $_POST['nombreC'];
    $apellido = $_POST['apellidoC'];
    $telefono = $_POST['telefonoC'];
    $email = $_POST['emailC'];
    $direccion= $_POST['direccionC'];

    $mascota->editar_mascota($id,$documento, $tipoDoc, $nombre, $apellido, $telefono, $email,$direccion );

    echo 1; //significa que fue editado

}

//Borra mascota seleccionado
if($_POST['funcion'] == 'borrar-mascota'){

    $id = $_POST['idCliente'];

    $mascota->borrar_mascota($id);

}

?>