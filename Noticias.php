
<link type="text/css" href="css/noticias.css" rel="stylesheet" />
<script type="text/javascript">


    function paginar(e) {
        $('#content').html('<div class="loading"><img src="img/loading.gif" width="70px" height="70px"/></div>');

        var page = $(e).attr('data');
        var dataString = 'page=' + page;

        $.ajax({
            type: "GET",
            url: "lib/pagination.php",
            data: dataString,
            success: function (data) {
                $('#content').fadeIn(1000).html(data);
            }
        });
    }

</script>


<div id="central">
    <div class="service_category">Noticias</div>
    <div id="content"><?php require('lib/pagination.php'); ?></div>

</div>
