<script>
    google.charts.load('current', {packages: ['corechart', 'bar']});
</script>
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> Reportes Excel</a></li>
    <li><a data-toggle="tab" href="#menu1"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Gráficas</a></li>
</ul>

<div class="tab-content">
    <div id="home" class="tab-pane fade in active">
        <br>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">REPORTES EXCEL</h3>
            </div>

            <div class="panel-body">



                <table class="table table-bordered table-striped">
                    <tr>
                        <td>Seleccione el tipo de reporte que desea descargar</td>
                        <td>
                            <select id="tipo_reporte">
                                <option value="">-seleccione-</option>
                                <option value="casos_r">Casos realizados</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                    <center><input onclick="DescargarReporte()" type="button" class="btn btn-default" value="Descargar excel"></center>
                    </td>
                    </tr>
                </table>

            </div>
        </div>


    </div>
    <div id="menu1" class="tab-pane fade">
        <br>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">GRÁFICAS</h3>
            </div>

            <div class="panel-body">

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th colspan="2">Seleccion de gráficas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Seleccione el tipo de gráfica a generear</td>
                            <td>
                                <select id="tipo_grafica">
                                    <option value="">-seleccione-</option>
                                    <option value="1">cuantas solicitudes estan en cada tipo de solicitud</option>
                                </select>
                                <input type="button" class="btn btn-default" name="genera_grafica" value="Generar grafica" onclick="EntregaInfoGrafica()">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                    <center><div id="chart_div"></div></center>
                    </td>
                    </tr>
                    </tr>
                    </tbody>   

                </table>

            </div>
        </div>

    </div>

</div>
