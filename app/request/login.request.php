<?php
session_start();
if(isset($_POST["correo"]))
{
    $correo = $_POST["correo"];
    $password = $_POST["password"];

    if(!empty($correo) and !empty($password))
    {
        require_once('../helpers/class.Conexion.php');

        $db = new Conexion();
        $sqlVerificar = $db->query("SELECT * FROM usuario WHERE email = '$correo' AND password = '$password'");
        if($db->rows($sqlVerificar) > 0)
        {
            $usuario = $db->recorrer($sqlVerificar);
            $_SESSION['user'] = array(
                'id' => $usuario['idUsuario'],
                'nombre' => $usuario['nombreUsuario'],
                'subs' => $usuario['cantSuscriptores']
            );
            echo 1;
        }
        else
        {
            echo "Credenciales Incorrectas";
        }
    }
    else
    {
        echo "Todos los campos son requeridos";
    }
}
?>