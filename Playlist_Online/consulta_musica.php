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
    $result = $conn->query("SELECT * FROM tb_musicas");
    $count = $result->rowCount();
    echo "<h2>Adicione uma música!</h2>";
    echo "<h3>CONSULTA</h3>";
    if ($count > 0) {
        // percorre os resultados via fetch(), caso tenha pelo menos um registro
        echo "<table>";
        echo "<tr>\n";
        echo "<td>\n";
        echo "<b>Código</b>\n";
        echo "</td>\n";
        echo "<td>\n";
        echo "<b>Nome da música: </b>\n";
        echo "</td>\n";
        echo "<td>\n";
        echo "<b>Compositor:</b>\n";
        echo "</td>\n";
        echo "<td>\n";
        echo "<b>Link:</b>\n";
        echo "</td>\n";
        echo "<td>\n";
        echo "<b>Comentário:</b>\n";
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
            echo $row->codigo_musica . "&nbsp;\n";
            echo "</td>\n";
            echo "<td class='td_l'>\n";
            echo $row->nome_musica . "&nbsp;\n";
            echo "</td>\n";
            echo "<td class='td_l'>\n";
            echo $row->compositor . "&nbsp;\n";
            echo "</td>\n";
            echo "<td class='td_link'>\n";
            echo $row->link . "&nbsp;\n";
            echo "</td>\n";
            echo "<td class='td_l'>\n";
            echo $row->resenha . "&nbsp;\n";
            echo "</td>\n";
            echo "<td>\n";
// cria o link para o programa alteracao_receitas.php passando o código da receita a ser alterada/excluída            
            echo "<a href='alteracao_exclusao_receitas.php?codigo_musica=" . $row->codigo_musica . "'>";
            echo "<img src='css/imagens/b_edit.png' border='0'><img src='css/imagens/b_drop.png' border='0'></a>&nbsp;\n";
            echo "</td>\n";
            echo "</tr>\n";
        }
    } else {
        $destino = "function () {window.location='index.php';}";
        echo "<script>sendToastr('Nenhuma música foi encontrada! <br /> Clique para continuar!','error',$destino)</script>";
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