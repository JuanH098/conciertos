<?php
class OperacionesBBDD{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new mysqli('localhost','root', '','bd_eventos_2023_php');
        $this->conexion->set_charset("utf8");

        $err = $this->conexion->connect_errno;
        $errMesg = $this->conexion->connect_error;
        if ($err == 0) {
          
        }else{
            die ("Error al conectar: $errMesg");
        }
    }
    public function closeCon(){
        $this->conexion->close();
    }
    public function getCon(){
        return $this->conexion;
    }
}
?>