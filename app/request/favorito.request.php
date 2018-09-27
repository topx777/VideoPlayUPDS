<?php
session_start();

if(isset($_GET["video"]))
{
    require_once('../helpers/class.Conexion.php');
    $db = new Conexion();
    
    $idVideo = $_GET["video"];
    $idUsuario = $_SESSION['user']['id'];

    $agregarFavorito = $db->query("INSERT INTO usuariofavorito(idUsuario, idVideo) VALUES($idUsuario, $idVideo)");
    if($agregarFavorito)
    {
        echo 1;
    }
    else
    {
        echo 'error';
    }
}
?>