<?php
session_start();
$usuario = $_SESSION['Usuario'];

//$perfil = $usuario['PERFIL'];

if ($usuario['nombre_usuario'] != NULL || $usuario['nombre_usuario'] != '') {
    ?>
    <!DOCTYPE html>
    <!--
    To change this license header, choose License Headers in Project Properties.
    To change this template file, choose Tools | Templates
    and open the template in the editor.
    -->


    <html>
        <head>
            <meta charset="UTF-8">
            <title>Portal_estudiantes</title>
            <link rel="stylesheet" href="css/bootstrap-3.3.7/css/bootstrap.css" type="text/css">
            <link rel="stylesheet" href="css/multi-select.css" type="text/css">
            <link rel="stylesheet" href="css/jquery.dataTables.css" type="text/css">
            <link rel="stylesheet" href="js/jquery-ui-1.11.4.custom/jquery-ui.css" type="text/css">
            <link rel="stylesheet" href="css/aplicacion.css" type="text/css">

            <script src="js/jquery.js"></script>
            <script src="js/jquery-ui-1.11.4.custom/jquery-ui.js"></script>
            <script src="js/jquery.dataTables.js"></script>
            <script src="css/bootstrap-3.3.7/js/bootstrap.js"></script>
            <script src="js/EstadoProceso.js"></script>
            <script src="js/TipoProceso.js"></script>
            <script src="js/Campos.js"></script>
            <script src="js/rol.js"></script>
            <script src="js/Caso.js"></script>
            <script src="js/usuario.js"></script>
            <script src="js/forms.js"></script>
            <script src="js/reportes.js"></script>
            <script src="js/Noticia.js"></script>
            <script src="js/RazonEstado.js"></script>
            <script src="js/jquery_validate.js"></script>
            <script src="js/jquery.multi-select.js"></script>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script src="ckeditor/ckeditor.js"></script>
            <script src="js/jquery_validate.js"></script>
            <script src="js/ini.js"></script>

        </head>
        <body>

            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="Aplicacion.php"><img src="img/logo_puj.png" width="40%" ></a>
                        <br>
                        <br>
                        <br>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                        <ul class="nav navbar-nav navbar-right" id="menu_siste">


                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>

            <div class="container">
                <div class="iconcontainer">
                    <div class="row">

                        <div class="iconbox">
                            <div class="iconbox-icon">
                                <span class="glyphicon glyphicon-book"></span>
                            </div>

                            <div id="contenido" class="container" style="width: auto;">







                            </div>

                            <!--                            <div class="featureinfo">
                                                            <h4 class="text-center">Title</h4>
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti atque, tenetur quam aspernatur corporis at explicabo nulla dolore necessitatibus doloremque exercitationem sequi dolorem architecto perferendis quas aperiam debitis dolor soluta!
                                                            </p>
                                                           
                                                        </div>-->
                        </div>


                    </div>

                </div>
            </div>

            <script>
                MenuUsuario();
                VerNoticiasIni();
            </script>

        </body>
    </html>
    <?php
    //var_dump($usuario);
} else {
    header('Location: index.php');
}
?>
