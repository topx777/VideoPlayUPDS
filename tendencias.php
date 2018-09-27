<?php
require('app/config/init.config.php');
require('app/helpers/class.Conexion.php');

if(!isset($_SESSION['user']))
{
    header('Location: login.php');
}
$db = new Conexion();

$videosNuevosQ = $db->query("SELECT * FROM video WHERE DAY(fechaSubida) = DAY(NOW()) ORDER BY cantVistas DESC LIMIT 8");
if($db->rows($videosNuevosQ) > 0)
{
    while($vnewRes = $db->recorrer($videosNuevosQ))
    {
        $idUser = $vnewRes['usuario'];
        $susTmpQ = $db->query("SELECT idUsuario, nombreUsuario FROM usuario WHERE idUsuario = $idUser LIMIT 1");
        $usuarioRes = $db->recorrer($susTmpQ);

        $videosn[] = array(
            'id' => $vnewRes['idVideo'],
            'nombre' => $vnewRes['nombreVideo'],
            'fechaSubida' => $vnewRes['fechaSubida'],
            'vistas' => $vnewRes['cantVistas'],
            'duracion' => $vnewRes['duracion'],
            'imagen' => $vnewRes['imagen'],
            'idUsuario' => $usuarioRes['idUsuario'],
            'nombreUsuario' => $usuarioRes['nombreUsuario'],
        );
    }
    $db->liberar($videosNuevosQ);
}
$db->close();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?=NOMBRE_APP?> – Tendencias, Tu Portal De Videos Favoritos</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Owl Carousel Assets -->
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"  type="text/css" />

        <!--Google Fonts-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800|Raleway:400,500,700|Roboto:300,400,500,700,900|Ubuntu:300,300i,400,400i,500,500i,700" rel="stylesheet">
        <!-- Main CSS -->
        <link rel="stylesheet" href="css/style.css" />
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="css/responsive.css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>
      <!--======= header =======-->
    <?php 
        include('master/header.php');

        include('master/categories.php');
    ?>

	  <div class="site-output">
          
        <?php include('master/sidebar.php') ?>

        <div id="all-output" class="col-md-10">

        	<h1 class="new-video-title"><i class="fa fa-bolt"></i> Tendencias</h1>
            <div class="row">
            <?php
            foreach ($videosn as $key => $video) {
            ?>
                <!-- video-item -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="video-item">
                        <div class="thumb">
                            <div class="hover-efect"></div>
                            <small class="time"><?=$video['duracion']?></small>
                            <a href="vervideo.php?id=<?=$video['id']?>"><img src="uploads/posters/<?=$video['imagen']?>" alt=""></a>
                        </div>
                        <div class="video-info">
                            <a href="vervideo.php?id=<?=$video['id']?>" class="title"><?=$video['nombre']?> </a>
                            <a class="channel-name" href="canal.php?id=<?=$video['idUsuario']?>"><?=$video['nombreUsuario']?><span>
                            <i class="fa fa-check-circle"></i></span></a>
                            <span class="views"><i class="fa fa-eye"></i><?=$video['vistas']?> vistas</span>
                            <span class="date"><i class="fa fa-clock-o"></i><?=$video['fechaSubida']?> </span>
                        </div>
                    </div>
                </div>
                <!-- // video-item -->
            <?php
            }
            ?>

        </div>
        
      </div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/jquery.sticky-kit.min.js"></script>
<script src="js/custom.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/imagesloaded.pkgd.min.js"></script>
<script src="js/grid-blog.min.js"></script>


	</body>
</html>
