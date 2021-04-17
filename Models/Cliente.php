<?php
include_once "Conexion.php";
 class Cliente{
    var $objetos;

    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }
    function registrar_cliente($nombre, $apellido, $telefono, $email, $direccion, $tipoDoc, $documento){

        $sql = "INSERT INTO cliente (nombre, apellido, telefono, email, direccion, tipoDocumento, numeroDocumento) VALUES(:nombre, :apellido, :telefono, :email, :direccion, :tipoDoc, :documento)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre, ':apellido'=>$apellido, ':telefono'=>$telefono, ':email'=>$email, ':direccion'=>$direccion, ':tipoDoc'=>$tipoDoc, ':documento'=>$documento));
        echo 1;
    }

    function obtener_clientes(){

        if(!empty($_POST['dato'])) {
            $dato = $_POST['dato'];
            $sql = "Select * from cliente where nombre like :dato or numeroDocumento like :dato";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':dato' => "%$dato%"));
            return $this->objetos = $query->fetchAll();
        }else{
            $sql = "Select * from cliente";
            $query = $this->acceso->prepare($sql);
            $query->execute(array());
            $this->objetos = $query->fetchAll();
            return $this->objetos;
        }
    }

    function editar_cliente($id,$documento, $tipoDoc, $nombre, $apellido, $telefono, $email,$direccion ){

        $sql = "UPDATE cliente SET nombre=:nombre, apellido=:apellido, telefono=:telefono, email=:email, direccion=:direccion, tipoDocumento=:tipoDoc, numeroDocumento=:documento WHERE idCliente=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id, ':nombre'=>$nombre, ':apellido'=>$apellido,':telefono'=>$telefono, ':email'=>$email, ':direccion'=>$direccion, ':tipoDoc'=>$tipoDoc,':documento'=>$documento));
        $this->objetos = $query->fetchAll();
    }

    function borrar_cliente($id){
        $sql = "delete from cliente where idCliente=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));

        echo 1;
    }
}
?>

