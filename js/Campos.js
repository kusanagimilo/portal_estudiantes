/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function ListaCampos() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/Campos/Controlador/CamposController.php",
        async: false,
        dataType: 'json',
        data: {
            opcion: 'ListaCampos'
        },
        success: function (retu) {
            data = retu;
        }
    });
    
    return data;
}

