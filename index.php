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
                        <li><a href="#">Inicio</a></li>
                        <li><a href="#">Contactenos</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <div class="container">    

            <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3"> 

                <div class="row">                
                    <br>
                    <br>
                    <br>
                    <br>
                    <center> <img src="img/logo_puj.png"></center>

                </div>


                <div class="panel panel-default" >
                    <div class="panel-heading">
                        <div class="panel-title text-center">Portal Estudiantes</div>
                    </div>     

                    <div class="panel-body" >

                        <form name="form" id="form" class="form-horizontal" enctype="multipart/form-data" method="POST" action="lib/Usuario/Controlador/UsuarioController.php">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="nombre_usuario" type="text" class="form-control" name="nombre_usuario" value="" placeholder="User">                                        
                            </div>

                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="pass" type="password" class="form-control" name="pass" placeholder="Password">
                            </div>                                                                  

                            <div class="form-group">
                                <!-- Button -->
                                <div class="col-sm-12 controls">
                                    <button type="submit" href="#" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-log-in"></i> Log in</button>                          
                                </div>
                            </div>
                            <input type="hidden" name="opcion" value="LogIN">

                        </form>     

                    </div>                     
                </div>  
            </div>
        </div>

        <div id="particles"></div>


    </body>
</html>
