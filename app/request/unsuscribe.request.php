<?php
session_start();

if(isset($_GET["usuario"]))
{
    require_once('../helpers/class.Conexion.php');
    $db = new Conexion();
    
    $idSubcribe = $_GET["usuario"];
    $idUsuario = $_SESSION['user']['id'];

    $unsuscribirse = $db->query("DELETE FROM usuariosucripcion WHERE idUsuario = $idUsuario AND idSuscripcion = $idSubcribe");
    if($unsuscribirse)
    {
        $modSus = $db->query("UPDATE usuario SET cantSuscriptores = cantSuscriptores - 1 WHERE idUsuario = $idSubcribe");
        echo 1;
    }
    else
    {
        echo 'error';
    }
}
?>