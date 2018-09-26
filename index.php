<?php
require_once('app/config/init.config.php');

if(!isset($_SESSION['user']))
{
    header('Location: login.php');
}
?>
<h1>Inicio</h1>
