<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Portal_estudiantes JAVERIANA</title>
        <link rel="stylesheet" href="css/bootstrap-3.3.7/css/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="css/ini.css" type="text/css">

        <script src="js/jquery.js"></script>
        <script src="js/ini.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">

                    <a class="navbar-brand" href="#"><img src="img/logo_puj.png" width="40%" ></a>
                    <br>
                    <br>
                    <br>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#" onclick="VerFormLogin()">Inicio</a></li>
                        <li><a href="#" onclick="VerNoticiasIni()">Noticias</a></li>
                        <li><a href="#" onclick="VerContacto()">Contactenos</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <div class="container" id="contenido_ini">    

        </div>

        <div id="particles"></div>

        <script>
            VerFormLogin();
        </script>
    </body>
</html>