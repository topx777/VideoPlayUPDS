<?php
session_start();

if(isset($_GET["usuario"]))
{
    require_once('../helpers/class.Conexion.php');
    $db = new Conexion();
    
    $idSubcribe = $_GET["usuario"];
    $idUsuario = $_SESSION['user']['id'];

    $suscribirse = $db->query("INSERT INTO usuariosucripcion(idUsuario, idSuscripcion) VALUES($idUsuario, $idSubcribe)");
    if($suscribirse)
    {
        $modSus = $db->query("UPDATE usuario SET cantSuscriptores = cantSuscriptores + 1 WHERE idUsuario = $idSubcribe");
        echo 1;
    }
    else
    {
        echo 'error';
    }
}
?>