<?php
header("Content-Type: text/html; charset=utf-8", true);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>CRUD Restaurante Boa Forma</title>
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
    <?php require_once('funcoes/cabecalho.php'); ?>
	<div id='principal'>
	  <h2>Adicione uma nova música!</h2>
	  <h3>Playlist</h3>
<?php
//
// Define as variáveis locais
//
$ComandoSQL = "";
$filtro = '';
$maximo = 0;
$pagina = 0;
$inicio = 0;
try
{
    // abre conexão com o banco
    require_once 'funcoes/conexao.php';
    //
    if (isset($_REQUEST['filtro'])) {
        $filtro = $_REQUEST['filtro'];
    }
    // Maximo de registros por pagina
    $maximo = 2; // quando tiver mais dados na tabela, altere para um valor maior
    // Declaração da pagina inicial
    $pagina = intval(($_GET["pagina"]));
    if ($pagina == "") {
        $pagina = "1";
    }
    // Calculando o registro inicial
    $inicio = $pagina - 1;
    $inicio = $maximo * $inicio;
    // Conta os resultados no total da query
    //
    $ComandoSQL = "select * from tb_receitas where nome_receita like '$filtro%'";
    $result = $conn->query($ComandoSQL);
    $rows = $result->fetchAll();
    $total = count($rows);

    $ComandoSQL = "select * from tb_receitas where nome_receita like '$filtro%'
		LIMIT $inicio, $maximo";
    $result = $conn->query($ComandoSQL);

    echo "<table border='1' cellpadding='0' cellspacing='0' width='80%'
		bordercolor='#003300' align='center'>";
    if ($total == 0) {
        $destino = "function () {window.location='index.php';}";
        echo "<script>sendToastr('Nenhuma música foi encontrada! <br /> Clique para continuar!','error',$destino)</script>";
    } else {
        // percorre os resultados via fetch()
        echo "<table>";
        echo "<tr>\n";
        echo "<td>\n";
        echo "<b>Código</b>\n";
        echo "</td>\n";
        echo "<td>\n";
        echo "<b>Nome da música</b>\n";
        echo "</td>\n";
        echo "<td>\n";
        echo "<b>Compositor</b>\n";
        echo "</td>\n";
        echo "<td>\n";
        echo "<b>Link</b>\n";
        echo "</td>\n";
        echo "<td>\n";
        echo "<b>Resenha</b>\n";
        echo "</td>\n";
        echo "</tr>\n";
        echo "<tr class='tr_div'><td colspan='5'></td></tr>\n";
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            // exibe os dados na tela, acessando o objeto retornado
            echo "<tr>\n";
            echo "<td class='td_l'>\n";
            echo $row->codigo . "&nbsp;\n";
            echo "</td>\n";
            echo "<td class='td_l'>\n";
            echo $row->nome_musica . "&nbsp;\n";
            echo "</td>\n";
            echo "<td class='td_l'>\n";
            echo $row->compositor . "&nbsp;\n";
            echo "</td>\n";
            echo "<td class='td_l'>\n";
            echo $row->link . "&nbsp;\n";
            echo "</td>\n";
            echo "<td class='td_l'>\n";
            echo $row->resenha . "&nbsp;\n";
            echo "</td>\n";
            echo "<td>\n";
            echo "</tr>\n";
        }
    }
    echo "</table>";
} catch (PDOException $e) {
    print "Erro!: " . $e->getMessage() . "<br/>";
    die();
}
// controla quantas páginas o relatório possui e cria os links para as páginas seguintes e anteriores
$menos = $pagina - 1;
$mais = $pagina + 1;
$pgs = ceil($total / $maximo);
if ($pgs > 1) {
    echo "<br clear='all'/><br /><br />";
    // Mostragem de pagina
    if ($menos > 0) {
        echo "<a href='relatorio_paginacao_filtro.php?pagina=$menos&filtro=$filtro'>
		<button type='button' class='btn btn-outline-success'>Anterior</button></a> | ";
    }
    // Listando as paginas
    for ($i = 1; $i <= $pgs; $i++) {
        if ($i != $pagina) {
            echo "<a href='relatorio_paginacao_filtro.php?pagina=$i&filtro=$filtro'>
				<button type='button' class='btn btn-outline-success'>$i</button></a> | ";
        } else {
            echo "<strong><font color='#000'>$i</font></strong> | ";
        }
    }
    if ($mais <= $pgs) {
        echo "<a href='relatorio_paginacao_filtro.php?pagina=$mais&filtro=$filtro'>
			<button type='button' class='btn btn-outline-success'>Próxima</button></a>";
    }
}
$conn = null;
?>
</div> <!-- Fim da div#principal -->
<?php require_once 'funcoes/menu.php';?>
<div class="clear"></div>
</div> <!-- Fim da div#conteudo -->
<div id="rodape">
	<p>Playlist online - Simplesmente o nome mais genérico do Brasil!</p>
</div>
</div> <!-- Fim da div#tudo -->
</body>
</html>