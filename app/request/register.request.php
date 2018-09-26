<?php
session_start();
if(isset($_POST["nombre"]))
{
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $password = $_POST["password"];
    $respassword = $_POST["respassword"];

    if(!empty($nombre) and !empty($correo) and !empty($password) and !empty($respassword))
    {
        if($password == $respassword)
        {
            require_once('../helpers/class.Conexion.php');

            $db = new Conexion();
            $sqlVerificar = $db->query("SELECT * FROM usuario WHERE nombreUsuario = '$nombre' OR email = '$correo'");
            if($db->rows($sqlVerificar) == 0)
            {
                $sqlIngresar = $db->query("INSERT INTO usuario(nombreUsuario, email, password) VALUES('$nombre', '$correo', '$password')");
                if($sqlIngresar)
                {
                    $_SESSION['user'] = array(
                        'id' => $db->ultimaId(),
                        'nombre' => $nombre
                    );
                    echo 1;
                }
                else 
                {
                    echo "No se pudo registrar, intentelo mas tarde";
                }
            }
            else
            {
                echo "El nombre de usuario o correo ya estan siendo usados";
            }
        }
        else 
        {
            echo "Las contraseñas no coinciden";    
        }
    }
    else
    {
        echo "Todos los campos son requeridos";
    }
}
?>