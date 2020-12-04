<!-- Chama a biblioteca jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<!-- Estilo -->
<style>
    .paginacao{
        position:relative;
        top:500px;
        font-size:30px;
    }
    .divProdutos{
        position:absolute;
        top:100px;
        width:100%;
    }
    .produtos{
        font-size:20px;
    }
</style>
<!-- Requisição Ajax-->
<center> <h1 style = "color:#483D8B;font-family:Arial;top:55px;position:relative;"> Cadastro Lapís </h1> </center>
<script type = "text/javascript">
jQuery(document).ready(function(){
    var param = 10;
    jQuery.ajax({
        url: 'teste2.php',
        ascyn: false,
        data:{
            'param': param
        },
        type: 'POST',
        dataType: 'html',
        success: function (data){
        /*Recebe os dados*/
        var dados = [];
        var produtos = [];
        var arrayDados = [];
        /*Adiciona os dados trazidos pela requisição ajax em um array*/
        dados.push(JSON.parse(data));
        /*Prepara os dados trazidos para listagem em uma tabela*/
        dados.forEach((elem) => {  
            for(i = 0; i <= (elem.length-1); i++){
                arrayDados.push({'idprod':elem[i].idprod,'nome':elem[i].nome,'cor':elem[i].cor,'preco':elem[i].preco});
            }
        });
        /* Salva os dados na localStorage para gerar o PDF */
        localStorage.setItem("dadosPDF",(data));
        /* Carrega os dados da tabela */
        arrayDados.forEach(function (elem, index) {
            corLinha = (index % 2) ? "white" : "175,238,238, 0.3";
                produtos.push(`
                    <tr style = 'color:black;background: rgba(${corLinha});'>
                        <td>${elem.idprod}</td>
                        <td>${elem.nome}</td>
                        <td>${elem.cor}</td>
                        <td>${elem.preco}</td>
                    </tr>`);
        });
        /*Lista os produtos via jQuery*/
        jQuery(".produtos").html(produtos.join(''));
    }
});
});
</script>
<!-- Tabela -->
<div class = "divProdutos">
<table class='table border tabela' style = "width:80%;margin:auto;">
    <thead style = 'background-color:#2980b9;color:white;font-size:12px;'>
        <tr>
            <th scope='col'>ID Produto</th>
            <th scope='col'>Cor</th>
            <th scope='col'>Nome</th>
            <th scope='col'>Preço</th>
        </tr>
    </thead>
    <tbody class = 'produtos' style = "font-size:12px;">
    </tbody>
</table>
<?php /*Recebe a página atual via sessão*/ session_start(); require("paginas.php");if(!empty($_GET['pagina'])){$_SESSION['pagina'] = $_GET['pagina'];}else{$_SESSION['pagina'] = 1;}?>
<!-- Números da páginação -->
<div class = "link" style = "text-align:center;position:relative;top:50px;"></div>
</div>
<!-- Estilo -->
<style>
.tabela{
    position:relative;
    top:50px;
}
.icons{
    width:110px;
    right:135px;
    top:117px;
    position:absolute;

}
</style>
<!-- Icones -->
<div class = "icons">
<img src = "pdf.png" style = "cursor:pointer;" onclick = "gerarPDF();" id = 'download-btn'/>
<img src = "word.png" style = "cursor:pointer;"/>
<img src = "imprimir.png" onclick = "window.print();" style = "cursor:pointer;"/>
</div>
<!-- Gerar PDF -->
<script src="dist/jspdf.umd.js"></script>
<script>if (!window.jsPDF) window.jsPDF = window.jspdf.jsPDF</script>
<script src="dist/jspdf.plugin.autotable.js"></script>
<script src="dist/examples.js"></script>
<script>
    document.getElementById('download-btn').onclick = function () {
        update(true);
    };

    function update(shouldDownload) {
        var funcStr = window.location.hash.replace(/#/g, '') || 'basic';
        var doc = window.examples[funcStr]();

        doc.setProperties({
            title: 'Example: ' + funcStr,
            subject: 'A jspdf-autotable example pdf (' + funcStr + ')'
        });

        if (shouldDownload) {
            doc.save('table.pdf');
        }
    }
</script>