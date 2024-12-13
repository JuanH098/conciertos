<?php
include(ROOT_PATH."/DAO/eventosBBDD.php");

try {

    $daoEventos = new eventosBBDD();
    $eventosCompletos = $daoEventos->obtenerTodosLosEventos();
    
    if (empty($eventosCompletos)) {
        header("Location:../Vista/GenericErr.php?message=" . urlencode("No hay eventos"));
    } else {
        $datosEventos = $eventosCompletos;
    }
   

} catch (Exception $e) {

    header("Location:../Vista/GenericErr.php?message=" . urlencode($e->getMessage()));
}

?>