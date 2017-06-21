<input type="button" class="btn btn-success" name="crear_tipo_proceso" value="Crear noticia" onclick="CrearNoticia()">
<br>
<br>
<table id="tab_noticias" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Noticia</th>
            <th>Fecha creacion</th>
            <th>Eliminar noticia</th>           
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Noticia</th>
            <th>Fecha creacion</th>
            <th>Eliminar noticia</th>  
        </tr>
    </tfoot>
</table>
<script>
    var json = GridNoticias();

    //console.log(json);


    $(document).ready(function () {
        $('#tab_noticias').DataTable({
            data: json
        });
    });
</script>