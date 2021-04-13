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
    }
?>

