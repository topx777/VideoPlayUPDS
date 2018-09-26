<?php
require('app/config/init.config.php');

if(isset($_SESSION['user']))
{
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?=NOMBRE_APP?> – Inicie Sesion</title>
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

    <body class="log_in_page">
      <!--======= log_in_page =======-->
      <div id="log-in" class="site-form log-in-form">
      
      	<div id="log-in-head">
        	<h1>Inicie Sesion</h1>
            <div id="logo"><a href="index.php"><img src="img/logo.png" alt=""></a></div>
        </div>
        
        <div class="form-output">
        	<div>
				<div class="form-group label-floating">
					<label class="control-label">Tu Correo</label>
					<input class="form-control" id="correo" placeholder="Correo" type="email">
				</div>
				<div class="form-group label-floating">
					<label class="control-label">Tu Contraseña</label>
					<input class="form-control" id="password" placeholder="Contraseña" type="password">
				</div>
        
                
                <button id="login" class="btn btn-lg btn-primary full-width">Iniciar Sesion</button>
                
				<p>No tienes una cuenta? <a href="register.php">Registrate ahora!</a> </p>
            </div>
        </div>
      </div>
      <!--======= // log_in_page =======-->
      <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>    
    
      <script>
		$(document).on('click', '#login', function(){
			var correo = $('#correo').val();
			var password = $('#password').val();
			
			$.ajax({
				type: 'POST',
				url: 'app/request/login.request.php',
				data: {
					correo: correo,
					password: password,
				},
				cache: false,
				success: function (response) {
					if(response == 1)
					{
						$('#AJAXresponse').html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Logeado con Exito, Ingresando...</strong></div>');
                        setTimeout(() => {
                            window.location.href = 'index.php';
                        }, 1500);
					}
					else
					{
						$('#AJAXresponse').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>ERROR! ' + response + '</strong></div>');
					}
				},
				error: function (err) {
					console.log(err);
				}
			});																																								
        });
    
      </script>
	</body>


</html>
