<input type="button" class="btn btn-default" name="crear_tipo_proceso" value="Ver noticias" onclick="VerNoticias()">
<br>
<br>
<script>
    $('#frm_noticia').validate({
        rules: {
            titulo_noticia: {required: true},
            contenido_noticia: {required: true}
        },
        messages: {
            titulo_noticia: {required: 'Ingrese el titulo de la noticia.'},
            contenido_noticia: {required: 'Ingrese el contenido de la noticia'}
        },
        debug: true,
        invalidHandler: function () {

            alert('Hay información en el formulario sin diligenciar por favor completarla');
            return false;
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
</script>


<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title">Nueva noticia</h3>
    </div>

    <div class="panel-body" >
        <form enctype='multipart/form-data' action="lib/Noticia/Controlador/NoticiaController.php" method='post' name='fileinfo' id='frm_noticia'> 
            <table class="table table-bordered table-striped">

                <tr>
                    <td>Ingrese el titulo de la noticia</td>
                    <td><input type="text" id="titulo_noticia" name="titulo_noticia"></td>
                </tr>

                <tr>
                    <td>Ingrese el contenido de la noticia</td>
                    <td>
                        <textarea name="contenido_noticia" id="contenido_noticia" rows="10" cols="80">
                        Ingrese el contenido
                        </textarea>
                    </td>
                </tr>







                <td colspan="2">
                <center>
                    <!--<input type="button" value="Guardar" class="btn btn-success" onclick="">-->
                    <button id="btoGuardarUsuario" name="btoGuardarUsuario" class="btn btn-success" type="submit" >Guardar</button>
                </center>
                </td>
                </tr>
            </table>
            <input type="hidden" name="opcion" id="opcion" value="NuevaNoticia">
        </form>
    </div>
</div>

<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('contenido_noticia');
</script>

