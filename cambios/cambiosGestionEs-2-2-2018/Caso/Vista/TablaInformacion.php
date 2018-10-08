<?php
$id_caso = $_POST['id_caso'];
?>
<div id="infor_cas_t">

</div>

<script>
    var retorno_caso = TablaCaso(<?php echo $id_caso; ?>);
    $("#infor_cas_t").html(retorno_caso);



    $("#contenido_caso").removeAttr("style");

</script>