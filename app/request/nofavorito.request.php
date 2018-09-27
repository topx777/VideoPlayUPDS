<?php
session_start();

if(isset($_GET["video"]))
{
    require_once('../helpers/class.Conexion.php');
    $db = new Conexion();
    
    $idVideo = $_GET["video"];
    $idUsuario = $_SESSION['user']['id'];

    $eliminarFavorito = $db->query("DELETE FROM usuariofavorito WHERE idUsuario = $idUsuario AND idVideo = $idVideo");
    if($eliminarFavorito)
    {
        echo 1;
    }
    else
    {
        echo 'error';
    }
}
?>