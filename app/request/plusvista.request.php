<?php
session_start();
if(isset($_GET["video"]))
{
    $idVideo = $_GET["video"];
    require_once('../helpers/class.Conexion.php');

    $db = new Conexion();

    $plusVista = $db->query("UPDATE video SET cantVistas = cantVistas + 1 WHERE idVideo = $idVideo");
    if($plusVista)
    {
        echo 1;
    }
    else {
        echo 'error';
    }
}
?>