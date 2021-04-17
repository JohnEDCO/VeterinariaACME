<?php
    include_once "Conexion.php";
    class Usuario{
        var $objetos;

        public function __construct(){
            $db = new Conexion();
            $this->acceso = $db->pdo;
        }
        function loguearse($email, $pass){
            $sql = "Select * from usuario inner join rol on usuario.idRol = rol.idRol where email =:email and password =:pass";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':email'=>$email, ':pass'=>$pass));
            $this->objetos = $query->fetchAll();
            return $this->objetos;
        }

        function obtener_datos($id){
            $sql = "Select * from usuario inner join rol on usuario.idRol = rol.idRol and idUsuario =:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id));
            $this->objetos = $query->fetchAll();
            return $this->objetos;
        }

        function editar($id, $nombre, $apellido, $telefono, $email){
            $sql = "UPDATE usuario SET nombre=:nombre, apellido=:apellido, telefono=:telefono, email=:email WHERE idUsuario=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id, ':nombre'=>$nombre, ':apellido'=>$apellido,':telefono'=>$telefono, ':email'=>$email));
            $this->objetos = $query->fetchAll();
        }
        function cambiar_contraseña($id, $newPass, $oldPass){

            $sql = "Select * from usuario where idUsuario =:id and password=:oldPass";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id, ':oldPass'=>$oldPass));
            $this->objetos = $query->fetchAll();

            if(!empty($this->objetos)){
                $sql = "UPDATE usuario SET password=:newPass WHERE idUsuario=:id";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':id'=>$id,':newPass'=>$newPass));
                $this->objetos = $query->fetchAll();
                echo 1;
            }else{
                echo 0;
            }

        }
        //------------Funciones de usuarios---------------------
        function obtener_usuarios(){
            if(!empty($_POST['dato'])) {

                $dato = $_POST['dato'];
                $sql = "Select * from usuario inner join rol on usuario.idRol = rol.idRol where nombre like :dato";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':dato' => "%$dato%"));
                return $this->objetos = $query->fetchAll();
            }else{

                $sql = "Select * from usuario inner join rol on usuario.idRol = rol.idRol ";
                $query = $this->acceso->prepare($sql);
                $query->execute(array());
                return $this->objetos = $query->fetchAll();
            }
        }

        function registrar_usuario($nombre, $apellido, $telefono, $email, $password, $idRol){

            $sql = "INSERT INTO usuario (nombre, apellido, telefono, email, password, idRol) VALUES(:nombre, :apellido, :telefono, :email, :password, :idRol)";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':nombre'=>$nombre, ':apellido'=>$apellido, ':telefono'=>$telefono, ':email'=>$email, ':password'=>$password, ':idRol'=>$idRol));
            echo 1;
        }
        function obtener_roles(){
            $sql = "Select * from rol";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            return $this->objetos = $query->fetchAll();
        }
        function borrar_usuario($id){
            $sql = "delete from usuario where idUsuario=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id));

            echo 1;
        }
        function editar_usuario($id, $nombre, $apellido, $telefono, $email, $idRol){
            $sql = "UPDATE usuario SET nombre=:nombre, apellido=:apellido, telefono=:telefono, email=:email, idRol=:idrol WHERE idUsuario=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id, ':nombre'=>$nombre, ':apellido'=>$apellido,':telefono'=>$telefono, ':email'=>$email, ':idrol'=>$idRol));
            $this->objetos = $query->fetchAll();
        }
        //------------Fin funciones de usuario---------------------
    }
?>

