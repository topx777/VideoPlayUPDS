<?php
require('app/config/init.config.php');
require('app/helpers/class.Conexion.php');

$miUsuario = $_SESSION['user']['id'];

if(!isset($_SESSION['user']))
{
    header('Location: login.php');
}
$db = new Conexion();

if(isset($_GET['id']))
{
    $idVideo = $_GET['id'];
    $videoQ = $db->query("SELECT * FROM video WHERE idVideo = $idVideo");
    $video = $db->recorrer($videoQ);
    
    $verificarFav = $db->query("SELECT * FROM usuariofavorito WHERE idUsuario = $miUsuario AND idVideo = $idVideo LIMIT 1");
    $favorito = $db->rows($verificarFav) > 0 ? true : false;

    $idUsuarioV = $video['usuario'];
    $usuarioQ = $db->query("SELECT idUsuario, nombreUsuario, cantSuscriptores FROM usuario WHERE idUsuario = $idUsuarioV LIMIT 1");
    $usuario = $db->recorrer($usuarioQ);

    $verificarSus = $db->query("SELECT * FROM usuariosucripcion WHERE idUsuario = $miUsuario AND idSuscripcion = $idUsuarioV LIMIT 1");
    $suscrito = $db->rows($verificarSus) > 0 ? true : false;


    //Comentarios
    $comentariosQ = $db->query("SELECT idUsuario, comentario, fechaComentario FROM comentariovideo WHERE idVideo = $idVideo");
    $cantComentarios = $db->rows($comentariosQ);
    if($cantComentarios > 0)
    {
        while($resCmt = $db->recorrer($comentariosQ))
        {
            $idUsuarioC = $resCmt['idUsuario'];
            $usuarioQC = $db->query("SELECT nombreUsuario FROM usuario WHERE idUsuario = $idUsuarioC LIMIT 1");
            $usuarioC = $db->recorrer($usuarioQC);
            
            $comentarios[] = array(
                'usuario' => $usuarioC['nombreUsuario'],
                'comentario' => $resCmt['comentario'],
                'fecha' => $resCmt['fechaComentario']
            );
        }
    }

    $videosNuevosQ = $db->query("SELECT * FROM video WHERE usuario = $idUsuarioV AND idVideo NOT IN($idVideo) ORDER BY cantVistas DESC");
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
}

$db->close();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?=NOMBRE_APP?> – Inicio, Tu Portal De Videos Favoritos</title>
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
        <link href="https://vjs.zencdn.net/7.1.0/video-js.css" rel="stylesheet">

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
            <div class="row">
            	<!-- Watch -->
                <div class="col-md-8">
                	<div id="watch">
                <?php
                if(isset($video))
                {
                ?>
                    <!-- Video Player -->
                    <h1 class="video-title"><?=$video['nombreVideo']?></h1>
                    <!-- <div class="video-code">
                        <iframe width="100%" height="415" src="https://www.youtube.com/embed/e452W2Kj-yg" frameborder="0" allowfullscreen></iframe>
                    </div>// video-code -->
                    <div class="videocontent">
                        <video id="my-video" data-idv="<?=$video['idVideo']?>" class="video-js vjs-default-skin vjs-big-play-centered" controls preload="auto" width="640" height="264"
                        poster="uploads/posters/<?=$video['imagen']?>" data-setup='{"fluid": true}'>
                            <source src="uploads/videos/<?=$video['directorio']?>" type='video/mp4'>
                            <p class="vjs-no-js">
                            To view this video please enable JavaScript, and consider upgrading to a web browser that
                            <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                            </p>
                        </video>
                    </div>

                    <div class="video-share">
                        <ul class="like">
                            <li><b>DESCRIPCION:</b></li>
                            <li><?=$video['descVideo']?></li>
                        </ul>
                        <ul class="social_link">
                        <?php
                        if($favorito){
                            echo '<li><button class="favorito" data-idv="'.$video['idVideo'].'"><i class="fa fa-star" aria-hidden="true"></i></button></li>';
                        } else {
                            echo '<li><button class="nofavorito" data-idv="'.$video['idVideo'].'"><i class="fa fa-star" aria-hidden="true"></i></button></li>';
                        }
                        ?>    
                        </ul><!-- // Social -->
                    </div><!-- // video-share -->
                    <!-- // Video Player -->
    
    
                    <!-- Chanels Item -->
                    <div class="chanel-item">
                        <div id="subdetail">
                            <div class="chanel-thumb">
                                <a href="canal.php?id=<?=$usuario['idUsuario']?>"><img src="demo_img/ch-1.jpg" alt=""></a>
                            </div>
                            <div class="chanel-info">
                                <a class="title" href="canal.php?id=<?=$usuario['idUsuario']?>"><?=$usuario['nombreUsuario']?></a>
                                <span class="subscribers"><?=$usuario['cantSuscriptores']?>  subscriptores</span>
                            </div>
                            <?php
                            if($suscrito) {
                                echo '<button class="subscribed" data-ids="'.$usuario['idUsuario'].'">Suscrito</button>';
                            } else {
                                echo '<button class="subscribe" data-ids="'.$usuario['idUsuario'].'">Suscribirse</button>';                            
                            }
                            ?>
                        </div>
                    </div>
                    <!-- // Chanels Item -->
    
    
                    <!-- Comments -->
                    <div id="comments" class="post-comments">
                        <h3 class="post-box-title"><span><?=$cantComentarios?></span> Comentarios</h3>
                        <ul class="comments-list">
                        <?php
                        if(isset($comentarios)) {
                            foreach ($comentarios as $key => $comentario) {
                            ?>    
                                <li>
                                    <div class="post_author">
                                        <div class="img_in">
                                            <a href="#"><img src="demo_img/c1.jpg" alt=""></a>
                                        </div>
                                        <a href="#" class="author-name"><?=$comentario['usuario']?></a>
                                        <time datetime="2017-03-24T18:18"><?=$comentario['fecha']?></time>
                                    </div>
                                    <p><?=$comentario['comentario']?></p>
                                </li>
                            <?php
                            }
                        } else {
                            echo '<h3>No hay comentarios aun.</h3>';
                        }
                        ?>
                        </ul>
    
    
                        <h3 class="post-box-title">Agregar Comentario</h3>
                        <div>
                           <textarea class="form-control" rows="6" id="mensaje" placeholder="COMENTARIO"></textarea>
                           <button type="button" id="enviarcomentario" data-idv="<?=$idVideo?>" class="btn btn-dm">Publicar Comentario</button>
                        </div>
                    </div>
                    <!-- // Comments -->
                <?php
                }
                else 
                {
                    echo '<h1 class="video-title">No se encontro el video</h1>';    
                }
                ?>

                    </div><!-- // watch -->
                </div><!-- // col-md-8 -->
                <!-- // Watch -->

                <!-- Related Posts-->
                <div class="col-md-4">
                	<div id="related-posts">
                        <h3>Mas Videos</h3>
                <?php
                if(isset($videosn)){
                    foreach ($videosn as $key => $video) {
                ?>
                        <!-- video item -->
                        <div class="related-video-item">
                            <div class="thumb">
                                <small class="time"><?=$video['duracion']?></small>
                                <a href="vervideo.php?id=<?=$video['id']?>"><img src="uploads/posters/<?=$video['imagen']?>" alt=""></a>
                            </div>
                            <a href="vervideo.php?id=<?=$video['id']?>" class="title"><?=$video['nombre']?></a>
                            <a class="channel-name" href="canal.php?id=<?=$video['idUsuario']?>"><?=$video['nombreUsuario']?><span>
                            <i class="fa fa-check-circle"></i></span></a>
                        </div>
                        <!-- // video item -->
                <?php
                    }
                }else{
                    echo 'No tiene mas videos relacionados';
                }
                ?>
                    </div>
                </div><!-- // col-md-4 -->
                <!-- // Related Posts -->
            </div><!-- // row -->
		</div>
        
      </div>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/jquery.sticky-kit.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/grid-blog.min.js"></script>
    <script src="https://vjs.zencdn.net/7.1.0/video.js"></script>

    <script>
        var visto = false;
        var myPlayer = videojs("my-video");

        myPlayer.on("play", function() {
            var video = $(this).attr('data-idv');
            if(!visto){
                $.ajax({
                type: "GET",
                url: "app/request/plusvista.request.php",
                data: { video: video },
                success: function (response) {
                    if(response == 1)
                    {
                        visto = true;
                    }
                }
                });
            }
        })


        $(document).on('click', '.favorito', function(){
            var button = $(this);
            var video = button.attr('data-idv');
            //alert('idvideo: ' + video);
            $.ajax({
                type: "GET",
                url: "app/request/nofavorito.request.php",
                data: { video: video },
                success: function (response) {
                    if(response == 1)
                    {
                        button.removeAttr("style");
                        button.attr("class", "nofavorito")
                    }
                }
            });
        });
        $(document).on('click', '.nofavorito', function(){
            var button = $(this);
            var video = button.attr('data-idv');
            //alert('idvideo: ' + video);
            $.ajax({
                type: "GET",
                url: "app/request/favorito.request.php",
                data: { video: video },
                success: function (response) {
                    if(response == 1)
                    {
                        button.removeAttr("style");
                        button.attr("class", "favorito");
                    }
                }
            });
        });
        $(document).on('click', '.subscribed', function(){
            var button = $(this);
            var usuario = button.attr('data-ids');

            $.ajax({
                type: "GET",
                url: "app/request/unsuscribe.request.php",
                data: { usuario: usuario },
                success: function (response) {
                    if(response == 1)
                    {
                        $("#subdetail").load(location.href + " #subdetail");
                        // button.removeAttr("style");
                        // button.attr("class", "subscribe")
                    }
                }
            });
        });
        $(document).on('click', '.subscribe', function(){
            var button = $(this);
            var usuario = button.attr('data-ids');
            $.ajax({
                type: "GET",
                url: "app/request/suscribe.request.php",
                data: { usuario: usuario },
                success: function (response) {
                    if(response == 1)
                    {
                        $("#subdetail").load(location.href + " #subdetail");
                        // button.removeAttr("style");
                        // button.attr("class", "subscribed");
                    }
                }
            });
        });
        $(document).on('click', '#enviarcomentario', function() {
            var button = $(this);
            var comentario = $('#mensaje').val();
            var video = button.attr('data-idv');
            $.ajax({
                type: "POST",
                url: "app/request/comentario.request.php",
                data: { 
                    comentario: comentario,
                    video: video 
                },
                success: function (response) {
                    if(response == 1)
                    {
                        $("#comments").load(location.href + " #comments");
                    }
                    else
                    {
                        alert(response);
                    }
                }
            });            
        });
    </script>

	</body>
</html>
