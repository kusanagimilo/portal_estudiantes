
<script>
    $("#frm_forms").validate({
        rules: {
            nombre_responsable_empresa: {required: true},
            cargo_responsable_empresa: {required: true},
            nombre_empresa: {required: true},
            nombre_asignatura: {required: true},
            nombre_profesor: {required: true},

        },
        invalidHandler: function () {

            alert('Hay información en el formulario sin diligenciar por favor completarla');
            return false;
        },
        submitHandler: function (form) {
            AlmacenaCartaPresentacion();
        }
    });
</script>
<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title">Tipo proceso : CARTA DE PRESENTACION A EMPRESA</h3>
    </div>

    <div class="panel-body">
        <form id="frm_forms" enctype="multipart/form-data" method="post">


            <table class="table table-bordered table-striped">

                <tbody><tr>
                        <td>NOMBRE DEL RESPONSABLE EN LA EMPRESA</td>
                        <td><input type="text" name="nombre_responsable_empresa" id="nombre_responsable_empresa"></td>
                    </tr>

                    <tr>
                        <td>CARGO DEL RESPONSABLE EN LA EMPRESA</td>
                        <td><input type="text" name="cargo_responsable_empresa" id="cargo_responsable_empresa"></td>
                    </tr>

                    <tr>
                        <td>NOMBRE EMPRESA</td>
                        <td><input type="text" name="nombre_empresa" id="nombre_empresa"></td>
                    </tr>


                    <tr>
                        <td>NOMBRE(S) ASIGNATURA(S)</td>
                        <td>
                            <textarea name="nombre_asignatura" id="nombre_asignatura">                                
                            </textarea>
                        </td>

                    </tr>

                    <tr>
                        <td>NOMBRE DEL PROFESOR</td>
                        <td><input type="text" name="nombre_profesor" id="nombre_profesor"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <td colspan="2"><center>Alumnos &nbsp; <input onclick="DialogAdiconaAlumno()" type="button" class="btn btn-success" value="Adicionar alumno"></center></td>
                    </tr>
                    <tr>
                        <td>Alumno</td>
                        <td>Eliminar</td>
                    </tr>
                    </thead>
                <tbody id="add_alumnos">

                </tbody>

            </table>
            </td>
            </tr>



            <tr>
                <td>ADJUNTAR ARCHIVO</td>
                <td><input type="file" name="archivo" id="archivo"></td>
            </tr>




            <tr>
                <td colspan="2" id="contenedor_cargando"><center>

                <input type="submit" id="btn_almacenar_caso" class="btn btn-default" value="Almacenar caso" >
            </center>
            </td>
            </tr>
            </tbody></table>
        </form>
    </div>
</div>
<div id="adicion_alumno">

</div>