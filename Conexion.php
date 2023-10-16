<?php 
    class Conexion extends PDO{
      
        private $hostDB = 'localhost';
        private $nombreBD= 'CasoPractico4';
        private $usuarioBD ='root';
        private $passBD ='';

        public function __construct(){
            try {
                parent::__construct('mysql:host='.
                $this->hostDB.';dbname='.
                $this->nombreBD.';charset=UTF8',$this->usuarioBD,
                $this->passBD,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
                echo"Conectado con exito a:";

            } catch (Exception $th) {
            echo "error".$th->getMessage();
            }
        

        }
    }


?>