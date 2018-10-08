
<table id="casos_tot" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>No de caso</th>
            <th>Proceso</th>
            <th>Estado</th>
            <th>Usuario creó caso</th>
            <th>Fecha ultima modificación</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th><input type="text" placeholder="No de caso"></th>
            <th><input type="text" placeholder="Proceso"></th>
            <th><input type="text" placeholder="Estado"></th>
            <th><input type="text" placeholder="Usuario creó caso"></th>
            <th><input type="text" placeholder="Fecha ultima modificación"></th>
            <th>Acciones</th>
        </tr>
    </tfoot>
</table>
<div id="dialog_tab_caso"></div>
<div id="mostrar_adjuntos"></div>
<div id="diag_cam_caso"></div>
<div id="dialog_tab_caso_admin"></div>
<script>
    var json = GridCasos();

    //  console.log(json);




    $(document).ready(function () {
        var table = $('#casos_tot').DataTable({
            data: json,
            order: [[0, "desc"]],
            language: {
                url: "js/espanol.json"
            }
        });
        table.columns().every(function () {
            var that = this;

            $('input', this.footer()).on('keyup change', function () {
                if (that.search() !== this.value) {
                    that
                            .search(this.value)
                            .draw();
                }
            });
        });

    });
</script>

