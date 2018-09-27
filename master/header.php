<header>
    <div class="container-full">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-12">
                <a id="main-category-toggler" class="hidden-md hidden-lg hidden-md"  href="#">
                    <i class="fa fa-navicon"></i>
                </a>
                <a id="main-category-toggler-close" class="hidden-md hidden-lg hidden-md" href="#">
                    <i class="fa fa-close"></i>
                </a>
                <div id="logo">
                    <a href="index.php"><img src="img/logo.png" alt=""></a>
                </div>
            </div><!-- // col-md-2 -->
            <div class="col-lg-3 col-md-3 col-sm-6 hidden-xs hidden-sm">
                <div class="search-form">
                    <form id="search" action="#" method="post">
                        <input type="text" placeholder="Intenta buscando algo..."/>
                        <input type="submit" value="Keywords" />
                    </form>
                </div>
            </div><!-- // col-md-3 -->
            <div class="col-lg-3 col-md-3 col-sm-5 hidden-xs hidden-sm">
                <ul class="top-menu">
                    <li><a href="index.php">INICIO</a></li>
                    <li><a href="#">TENDENCIAS</a></li>
                </ul>
            </div><!-- // col-md-4 -->
            <div class="col-lg-2 col-md-2 col-sm-4 hidden-xs hidden-sm">
                <ul class="notifications">
                    <li class="dropdown">
                    <a href="#"  data-toggle="dropdown"><i class="fa fa-users"></i>
                        <span class="badge badge-color1 header-badge">3</span>
                    </a>
                            <ul class="dropdown-menu dropdown-menu-friend-requests ">
                            <li>
                                <div class="friend-requests-info">
                                    <div class="thumb"><a href="#"><img src="demo_img/z1.jpg" alt=""></a></div>
                                    <a href="#" class="name">Ahmed Saleh </a>
                                    <span>Ahmed Saleh : Follow you now</span>
                                </div>
                            </li>
                            <li>
                                <a href="#" class="all_notifications">Todos los Suscriptores</a>
                            </li>
                            </ul>
                    </li>
                    <li class="dropdown">
                    <a href="#" data-toggle="dropdown"><i class="fa fa-bell-o"></i>
                        <span class="badge badge-color3 header-badge">9</span>
                    </a>
                    <ul class="dropdown-menu dropdown-notifications-items ">
                        <li>
                            <div class="notification-info">
                                <a href="#"><i class="fa fa-video-camera color-1"></i>
                                <strong>Rabie Elkheir</strong> Add a new <span>Video</span>
                                <h5 class="time">4 hours ago</h5>
                                </a>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="all_notifications">Todas las Notificaciones</a>
                        </li>
                    </ul>

                    </li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-3 hidden-xs hidden-sm">
                    <div class="dropdown">
                    <a data-toggle="dropdown" href="#" class="user-area">
                        <div class="thumb"><img src="demo_img/user-1.png" alt=""></div>
                        <h2><?=$_SESSION['user']['nombre']?></h2>
                        <h3><?=$_SESSION['user']['subs']?> subscriptores</h3>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu account-menu">
                        <li><a href="#"><i class="fa fa-edit color-1"></i>Editar Perfil</a></li>
                        <li><a href="#"><i class="fa fa-video-camera color-2"></i>Subir Video</a></li>
                        <li><a href="#"><i class="fa fa-star color-3"></i>Favoritos</a></li>
                        <li><a href="app/request/logout.request.php"><i class="fa fa-sign-out color-4"></i>Cerrar Sesión</a></li>
                    </ul>
                </div>
            </div>
        </div><!-- // row -->
    </div><!-- // container-full -->
</header><!-- // header -->