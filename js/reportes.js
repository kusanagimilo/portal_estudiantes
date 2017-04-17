function VerReportes() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/Reportes/Vista/VerReportes.php",
        async: false,
        success: function (retu) {
            data = retu;
        }
    });

    $("#contenido").html(data);

}

function DescargarReporte() {
    var tipo_reporte = $("#tipo_reporte").val();

    if (tipo_reporte != "") {
        if (tipo_reporte == "casos_r") {
            location.href = "excel/com_excel/casos_realizados.php";
        }
    } else {
        alert("Seleccione un tipo de reporte");
    }

}



function EntregaInfoGrafica() {

    var tipo_grafica = $("#tipo_grafica").val();
    var opcion;

    if (tipo_grafica == 1) {


        google.charts.setOnLoadCallback(GraficaTipoProceso());


    } else if (tipo_grafica == "") {
        alert("seleccione un tipo de grafica");
    }




}

function GraficaTipoProceso() {

    var data;
    $.ajax({
        type: "POST",
        url: "lib/Reportes/Controlador/ReportesController.php",
        async: false,
        dataType: 'json',
        data: {
            opcion: "InfoGraficaTipoProceso"
        },
        success: function (retu) {
            data = retu;
        }
    });

    //console.log(data);
    var datica = [];

    var i = 0;
    $.each(data, function (key, data_j) {
        datica[i] = [data_j[0], parseInt(data_j[1])];
        i++;
    });



    // Create the data table.
    var data_google = new google.visualization.DataTable();
    data_google.addColumn('string', 'Tipo solicitud');
    data_google.addColumn('number', 'Tipo solicitud');
    data_google.addRows(datica);

    // Set chart options
    var options = {'title': 'Solucitudes por tipo',
        'width': 600,
        'height': 300};

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
    chart.draw(data_google, options);


}