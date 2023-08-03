<?php
header("Content-Type: text/html; charset=utf-8", true);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>CRUD Playlist online</title>
<link rel="stylesheet" type="text/css" href="css/estilos.css">
<link href="css/toastr.css" rel="stylesheet"/>
<script src="jquery/jquery-3.3.1.min.js"></script>
<script src="popper/popper.min.js"></script>
<script src="bootstrap4/js/bootstrap.min.js"></script>
<script src="funcoes/toastr.min.js"></script>
<script src="funcoes/funcao_toastr.js"></script>
</head>
<body>
<div id="tudo">
<div id="conteudo">
    <?php require_once 'funcoes/cabecalho.php';?>
    <div id='principal'>
<?php
try
{
    // abre conexão com o banco
    require_once 'funcoes/conexao.php';
    // executa uma instrução SQL de consulta
    $result = $conn->query("SELECT * FROM tb_generos");
    $count = $result->rowCount();
    echo "<h2>Cadastre um gênero</h2>";
    echo "<h3>CONSULTA</h3>";
    if ($count > 0) {
        // percorre os resultados via fetch(), caso tenha pelo menos um registro
        echo "<table>";
        echo "<tr>\n";
        echo "<td>\n";
        echo "<b>Código do gênero:</b>\n";
        echo "</td>\n";
        echo "<td>\n";
        echo "<b>Nome do genêro: </b>\n";
        echo "</td>\n";
        echo "<td>\n";
        echo "<b>Ritmo:</b>\n";
        echo "</td>\n";
        echo "<td>\n";
        echo "<b>Exemplo:</b>\n";
        echo "</td>\n";
        echo "<td>\n";
        echo "<b>Caracteristicas:</b>\n";
        echo "</td>\n";
        echo "<td>\n";
        echo "<b>Operação</b>\n";
        echo "</td>\n";
        echo "</tr>\n";
        echo "<tr class='tr_div'><td colspan='6'></td></tr>\n";
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            // exibe os dados na tela, acessando o objeto retornado
            echo "<tr>\n";
            echo "<td class='td_l'>\n";
            echo $row->codigo_genero . "&nbsp;\n";
            echo "</td>\n";
            echo "<td class='td_l'>\n";
            echo $row->nome_genero . "&nbsp;\n";
            echo "</td>\n";
            echo "<td class='td_l'>\n";
            echo $row->ritmo . "&nbsp;\n";
            echo "</td>\n";
            echo "<td class='td_l'>\n";
            echo $row->exemplo . "&nbsp;\n";
            echo "</td>\n";
            echo "<td class='td_l'>\n";
            echo $row->caracteristicas . "&nbsp;\n";
            echo "</td>\n";
            echo "<td>\n";
// cria o exemplo para o programa alteracao_receitas.php passando o código da receita a ser alterada/excluída            
            echo "<a href='alteracao_exclusao_receitas.php?codigo_genero=" . $row->codigo_genero . "'>";
            echo "<img src='css/imagens/b_edit.png' border='0'><img src='css/imagens/b_drop.png' border='0'></a>&nbsp;\n";
            echo "</td>\n";
            echo "</tr>\n";
        }
    } else {
        $destino = "function () {window.location='index.php';}";
        echo "<script>sendToastr('Nenhum gênero foi encontrada! <br /> Clique para continuar!','error',$destino)</script>";
    }
    echo "</table>";
    // fecha a conexão
    $conn = null;
} catch (PDOException $e) {
    $destino = "function () {window.location='index.php';}";
    echo "<script>sendToastr($e->getMessage(),'error',$destino)</script>";
    die(); // interrompe o processamento do lado do servidor
}
?>
</div>
<?php require_once 'funcoes/menu.php';?>
<div class="clear"></div>
</div>
<div id="rodape">
	<p>Playlist online - Simplesmente o nome mais genérico do Brasil! -  By Igor & Rayane</p>
</div>
</div>
</body>
</html>