
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
