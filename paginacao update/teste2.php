<?php

require_once("conexao.php");
if(!empty($_REQUEST['param'])){
    session_start();
    @$param = $_POST['param'];
    $Conection = new Conection(); 
    $Conection->Conecta();

    /* Variaveis Paginacao */
    $qtdMaxPorPag = 10;
    //$paginaAtual = 1;
    $paginaAtual = $_SESSION['pagina'];
 
    $sql = $Conection->conexao->query("SELECT idprod,nome,cor,preco FROM produtos");
    $dados = Array($sql->fetchAll(\PDO::FETCH_ASSOC));
    $qtdRegistros = array($sql->rowCount(\PDO::FETCH_ASSOC));
    $totalRegistros = implode($qtdRegistros);
    $totalPaginas = ceil($totalRegistros / $qtdMaxPorPag);
    $inicio = ($qtdMaxPorPag * $paginaAtual) - $qtdMaxPorPag;
    $_SESSION['totalPaginas'] = $totalPaginas;

    if(!empty($_REQUEST['pagina']) && !empty($_REQUEST['param'])){
        echo $_SESSION['totalPaginas'];
    }

    $ORDEM = "ORDER BY idprod ASC";
    $LIMIT = "LIMIT $inicio, $qtdMaxPorPag";
    
    $sql2 = $Conection->conexao->query("SELECT * FROM produtos {$ORDEM} {$LIMIT}");
    $dados2 = Array($sql2->fetchAll(\PDO::FETCH_ASSOC));
    $qtdRegistros2 = array($sql2->rowCount(\PDO::FETCH_ASSOC));
    $totalRegistros2 = implode($qtdRegistros2);

    $dadosProduto2 = Array();
    
    if(!empty($_SESSION['pagina'])){
        foreach($dados2 as $key2 => $dadosProdutos2){
            echo json_encode($dadosProdutos2  = $dados2[$key2]);
        }
    }
}
?>

