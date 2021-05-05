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
            $sql = "Select * from mascota inner join tipoMascota on mascota.idTipoMascota = tipoMascota.idTipoMascota left join cliente on cliente.idCliente = mascota.idCliente where nombre like :dato";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':dato' => "%$dato%"));
            return $this->objetos = $query->fetchAll();
            print_r($this->objetos);
        }else{
            $sql = "Select * from mascota inner join tipoMascota on mascota.idTipoMascota = tipoMascota.idTipoMascota left join cliente on cliente.idCliente = mascota.idCliente";
            $query = $this->acceso->prepare($sql);
            $query->execute(array());
            $this->objetos = $query->fetchAll();
            return $this->objetos;
            print_r($this->objetos);
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

    function editar_mascota($idM,$nombre,$raza, $tipo, $edad, $fechaNac, $idDueño){

        if($idDueño != 'null'){

           $sql = "UPDATE mascota SET nombre=:nombre, raza=:raza, idTipoMascota=:idTipoM, edad=:edad, fechaNacimiento=:fechaNac, idCliente=:idDueno WHERE idMascota=:idM";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':nombre'=>$nombre, ':raza'=>$raza, ':idTipoM'=>$tipo, ':edad'=>$edad, ':fechaNac'=>$fechaNac, ':idDueno'=>$idDueño, ':idM'=>$idM));
            $this->objetos = $query->fetchAll();
            echo 1;
        }else{

            $sql = "UPDATE mascota SET nombre=:nombre, raza=:raza, idTipoMascota=:idTipoM, edad=:edad, fechaNacimiento=:fechaNac WHERE idMascota=:idM";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':idM'=>$idM, ':nombre'=>$nombre, ':raza'=>$raza,':idTipoM'=>$tipo, ':edad'=>$edad, ':fechaNac'=>$fechaNac));
            $this->objetos = $query->fetchAll();
            echo 1;
        }

    }

    function borrar_mascota($id){
        $sql = "delete from mascota where idMascota=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        echo 1;
    }
}
?>

