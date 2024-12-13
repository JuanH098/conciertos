<?php
include_once("operacionesBBDD.php");

class eventosBBDD
{

    private $conexion;

    public function __construct()
    {
        $operaciones = new OperacionesBBDD();
        $this->conexion = $operaciones->getCon();
    }

    public function obtenerTodosLosEventos()
    {
     
        $sql = "SELECT * FROM evento";

        $resultado = $this->conexion->query($sql);

        if ($resultado) {
            $eventos = array();

            while ($row = $resultado->fetch_assoc()) {
                $eventos[] = $row;
            }
            $this->conexion->close();

            return $eventos;
        } else {
            return null;;
            
        }
    }
}


?>