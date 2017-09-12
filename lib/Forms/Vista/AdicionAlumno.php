<table class="table table-bordered table-striped">
    <tr>
        <td>NOMBRE COMPLETO DE EL ALUMNO</td>
        <td><input type="text" name="nombre_al" id="nombre_al"></td>
    </tr>

    <tr>
        <td>TIPO DOCUMENTO ALUMNO</td>

        <td>
            <select style="width:100px;" id="tipo_documento_al" name="tipo_documento_al">
                <option value="">-seleccione-</option>
                <option value="T.I">T.I</option>
                <option value="C.C">C.C</option>
                <option value="C.E">C.E</option>
                <option value="PASAPORTE">PASAPORTE</option>
            </select>
        </td>

    </tr>

    <tr>
        <td>NUMERO DOCUMENTO ALUMNO</td>


        <td><input type="text" name="numero_documento_al" id="numero_documento_al"></td>
    </tr>

    <tr>
        <td>ID INSTITUCIONAL ALUMNO</td>


        <td><input type="text" name="id_javeriana_al" id="id_javeriana_al"></td>
    </tr>

    <tr>
        <td>TELEFONO ALUMNO</td>


        <td><input type="text" name="telefono_al" id="telefono_al"></td>
    </tr>

    <tr>
        <td>CORREO ELECTRONICO INSTITUCIONAL</td>


        <td><input type="text" name="correo_electronico_al" id="correo_electronico_al"></td>
    </tr>
    <tr>
        <td colspan="2">
                <center>
                    <input type="button" class="btn btn-default" onclick="AdicionarAlumno()" value="Adicionar alumno">
                </center>
        </td>
    </tr>
</table>

