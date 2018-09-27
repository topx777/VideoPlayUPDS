<?php
session_start();
if(isset($_POST["comentario"]))
{
    $video = $_POST["video"];
    $comentario = $_POST["comentario"];
    $idUsuario = $_SESSION["user"]["id"];
    
    if(!empty($comentario))
    {
        require_once('../helpers/class.Conexion.php');
        $db = new Conexion();
        
        $newcomment = $db->query("INSERT INTO comentariovideo(idUsuario, idVideo, comentario) VALUES($idUsuario, $video, '$comentario')");
        if($newcomment)
        {
            echo 1;
        }
        else {
            echo 'error';
        }
    }
    else
    {
        echo 'comentario vacio';
    }
}
?>