<?php
include_once "Conexion.php";
class Mascota{
    var $objetos;

    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }
    function registrar_mascota($nombreM, $razaM, $idTipo, $edadM, $fechaNacM, $idClienteM){

        if($idClienteM == ""){
            $sql = "INSERT INTO mascota (nombre, idTipoMascota, raza, edad, fechaNacimiento) VALUES(:nombre, :idtipo, :raza, :edad, :fechanac)";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':nombre'=>$nombreM, ':idtipo'=>$idTipo, ':raza'=>$razaM, ':edad'=>$edadM, ':fechanac'=>$fechaNacM));
            echo 1;
        }else{
            $sql = "INSERT INTO mascota (nombre, idTipoMascota, raza, edad, fechaNacimiento, idCliente) VALUES(:nombre, :idtipo, :raza, :edad, :fechanac, :idcliente)";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':nombre'=>$nombreM, ':idtipo'=>$idTipo, ':raza'=>$razaM, ':edad'=>$edadM, ':fechanac'=>$fechaNacM, ':idcliente'=>$idClienteM));
            echo 1;
        }

    }

    function obtener_mascotas(){

        if(!empty($_POST['dato'])) {
            $dato = $_POST['dato'];
            $sql = "Select * from mascota inner join tipoMascota on mascota.idTipoMascota = tipoMascota.idTipoMascota where nombre like :dato";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':dato' => "%$dato%"));
            return $this->objetos = $query->fetchAll();
        }else{
            $sql = "Select * from mascota inner join tipoMascota on mascota.idTipoMascota = tipoMascota.idTipoMascota";
            $query = $this->acceso->prepare($sql);
            $query->execute(array());
            $this->objetos = $query->fetchAll();
            return $this->objetos;
        }
    }
    function obtener_dueños(){

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
    function obtener_tipos_mascota(){
        $sql = "Select * from tipoMascota";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        return $this->objetos = $query->fetchAll();
    }

    function editar_mascota($id,$documento, $tipoDoc, $nombre, $apellido, $telefono, $email,$direccion ){

        $sql = "UPDATE cliente SET nombre=:nombre, apellido=:apellido, telefono=:telefono, email=:email, direccion=:direccion, tipoDocumento=:tipoDoc, numeroDocumento=:documento WHERE idCliente=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id, ':nombre'=>$nombre, ':apellido'=>$apellido,':telefono'=>$telefono, ':email'=>$email, ':direccion'=>$direccion, ':tipoDoc'=>$tipoDoc,':documento'=>$documento));
        $this->objetos = $query->fetchAll();
    }

    function borrar_mascota($id){
        $sql = "delete from cliente where idCliente=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));

        echo 1;
    }
}
?>

