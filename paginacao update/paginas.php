<!-- Chama a biblioteca jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
jQuery(document).ready(function(){
var pagina = 'pagina';
var param = 10;

jQuery.ajax({
        url: 'teste2.php',
        ascyn: false,
        data:{
            'pagina': pagina,
            'param':param
        },
        type: 'POST',
        dataType: 'html',
        success: function (data){
            var condicao = parseInt(data);
            var link = [];
            for(i = 1; i <= (condicao); i++){
                link.push(`
                   <a href = 'index.php?pagina=${i}'> ${i} </a>
                `);
            }
            jQuery(".link").html(link.join(''));
        }
});
});
</script>