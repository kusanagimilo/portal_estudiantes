<?php

include_once 'config/BD.php';

$obj_conexion = new BD();
$link = $obj_conexion->Conectar();

$query_num_noticia = "SELECT id_noticia FROM noticia";
$num_total_registros = $obj_conexion->NumeroFilas($query_num_noticia, $link);

//Si hay registros
if ($num_total_registros > 0) {
    //numero de registros por página
    $rowsPerPage = 3;

    //por defecto mostramos la página 1
    $pageNum = 1;

    // si $_GET['page'] esta definido, usamos este número de página
    if (isset($_GET['page'])) {
        sleep(1);
        $pageNum = $_GET['page'];
    }

    //echo 'page'.$_GET['page'];
    //contando el desplazamiento
    $offset = ($pageNum - 1) * $rowsPerPage;
    $total_paginas = ceil($num_total_registros / $rowsPerPage);


    //$query_services = mysql_query("SELECT service_id, title, description, rating FROM services ORDER BY date_added DESC LIMIT $offset, $rowsPerPage", $conexion);

    $sql = "SELECT no.id_noticia,no.titulo_noticia,no.contenido,no.fecha_creacion,us.nombres,us.apellidos 
            FROM noticia no 
            INNER JOIN usuario us ON us.id_usuario = no.id_usr_creo
            ORDER BY fecha_creacion DESC LIMIT $offset, $rowsPerPage";
    $resul = $obj_conexion->ResultSet($sql, $link);

    foreach ($resul as $key => $row_services) {

        //$service = new Service($row_services['service_id']);

        $descripcion_desformateada = strip_tags($row_services['contenido']);

        $texto = substr($descripcion_desformateada, 0, 100);
        $p_desc = $texto . '...<br>';

        echo '<div class="service_list" id="service' . $row_services['id_noticia'] . '" data="' . $row_services['id_noticia'] . '">                         	
                            <div class="center_block">
                                                         
                                <h3><a title="' . $row_services['titulo_noticia'] . '" onclick="VerDetalleNoticia(' . $row_services['id_noticia'] . ')" href="#">' . $row_services['titulo_noticia'] . '</a></h3>
                                <p class="product_desc">' . $p_desc . '</p>
                                    
                                <br>
                               <span class="label label-primary">Publicada por : ' . $row_services['nombres'] . ' ' . $row_services['apellidos'] . '</span> <span class="label label-warning">El ' . $row_services['fecha_creacion'] . '</span>
                                <br>
                                
                                
                                    
                                   
                            </div>

                        </div>';
    }

    if ($total_paginas > 1) {
        echo '<div class="pagination">';
        echo '<ul>';
        if ($pageNum != 1)
            echo '<li><a class="paginate" onclick="paginar(this)" data="' . ($pageNum - 1) . '">Anterior</a></li>';
        for ($i = 1; $i <= $total_paginas; $i++) {
            if ($pageNum == $i)
            //si muestro el índice de la página actual, no coloco enlace
                echo '<li class="active"><a>' . $i . '</a></li>';
            else
            //si el índice no corresponde con la página mostrada actualmente,
            //coloco el enlace para ir a esa página
                echo '<li><a class="paginate" onclick="paginar(this)" data="' . $i . '">' . $i . '</a></li>';
        }
        if ($pageNum != $total_paginas)
            echo '<li><a class="paginate" onclick="paginar(this)" data="' . ($pageNum + 1) . '">Siguiente</a></li>';
        echo '</ul>';
        echo '</div>';
    }
}