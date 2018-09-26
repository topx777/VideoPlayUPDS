<?php
require('app/config/init.config.php');

if(!isset($_SESSION['user']))
{
    header('Location: login.php');
}
?>
<h1>Inicio</h1>
<p>Bienvenido</p> <?=$_SESSION['user']['nombre']?>
