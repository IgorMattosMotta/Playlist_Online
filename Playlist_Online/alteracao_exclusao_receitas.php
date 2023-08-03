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
	<?php require_once('funcoes/cabecalho.php'); ?>
	<div id='principal'>
<?php
//
// Define as variáveis locais
//
$codigo = "";
$nome_receita = "";
$ingredientes = "";
$preparo = "";
$comentarios = "";
$destino = '';
$ComandoSQL = "";

// abre conexão com o banco
require_once 'funcoes/conexao.php';
$codigo = $_GET['codigo'];
// só entrará neste bloco na segunda vez, quando o programa for chamado pelo formulário
switch ($_POST['form_operacao']) {
    case "alteracao":
        try
        {
            // recebe os dados do formulário
            $codigo = $_POST['codigo'];
            $nome_receita = $_POST['nome_receita'];
            $ingredientes = $_POST['ingredientes'];
            $preparo = $_POST['preparo'];
            $comentarios = $_POST['comentarios'];

            $stmt = $conn->prepare('UPDATE tb_receitas SET
			nome_receita =:nome_receita,
			ingredientes = :ingredientes,
			preparo = :preparo,
			comentarios= :comentarios WHERE codigo = :codigo');
			$stmt->bindValue(':codigo', $codigo);
            $stmt->bindValue(':nome_receita', $nome_receita);
            $stmt->bindValue(':ingredientes', $ingredientes);
            $stmt->bindValue(':preparo', $preparo);
            $stmt->bindValue(':comentarios', $comentarios);
            $stmt->execute();
		
			$destino = "function () {window.location='consulta_receitas.php';}";
            echo "<script>sendToastr('Receita alterada com sucesso! Clique para continuar!','success',$destino)</script>";
            break;
        } catch (PDOException $e) {
            // caso ocorra uma exceção, exibe na tela
			$destino = "function () {window.location='index.php';}";
			echo "<script>sendToastr($e->getMessage(),'error',$destino)</script>";
		    die();
        }
    case "exclusao":
        try
        {
            // recebe os dados do formulário
            $codigo = $_POST['codigo'];
            $stmt = $conn->prepare('DELETE from tb_receitas WHERE codigo = :codigo');
            $stmt->bindValue(':codigo', $codigo);
            $stmt->execute();
			$destino = "function () {window.location='consulta_receitas.php';}";
            echo "<script>sendToastr('Receita excluída com sucesso! Clique para seguir!','success',$destino)</script>";
	            break;
        } catch (PDOException $e) {
            // caso ocorra uma exceção, exibe na tela
			$destino = "function () {window.location='index.php';}";
			echo "<script>sendToastr($e->getMessage(),'error',$destino)</script>";
            die();
        }
}
// executa uma instrução SQL de consulta
$ComandoSQL = "select * from tb_receitas where codigo = '" . $codigo . "'";
$result = $conn->query($ComandoSQL);
if (!$result) {
	$destino = "function () {window.location='index.php';}";
    echo "<script>sendToastr('Nenhuma receita foi encontrada! Clique para continuar!','error',$destino)</script>";
}
$row = $result->fetch(PDO::FETCH_OBJ)
?>
<script LANGUAGE="JavaScript">
// função que define qual operação será realizada, alteração ou exclusão. Ela depende do botão que o usuário pressionar  
	function define_operacao(operacao){
		if (operacao == "alt") {
		document.form_alteracao_exclusao_receitas.form_operacao.value = "alteracao";
		}
		if (operacao == "exc") {
		document.form_alteracao_exclusao_receitas.form_operacao.value = "exclusao";
		}
		document.form_alteracao_exclusao_receitas.submit();
	}
</script>
	<h2>CADASTRO DE RECEITAS</h2>
	<h3>ALTERAÇÃO E EXCLUSÃO</h3>
	<form method="POST" action="alteracao_exclusao_receitas.php" name="form_alteracao_exclusao_receitas">
		<table width="600">
			<tr>
				<td class="td_r">Código:</td>
				<td>
				<input type="text" name="codigo" readonly="readonly" value="<?php echo $row->codigo; ?>">
				</td>
			</tr>
			<tr>
				<td class="td_r">Nome:</td>
				<td>
				<input name="nome_receita" type="text" id="" size="30" maxlength="30" required="required" value="<?php echo $row->nome_receita; ?>">*
				</td>
			</tr>
			<tr>
				<td class="td_r">Ingredientes:</td>
				<td>
				<textarea name="ingredientes" id="ingredientes"
				rows="5" cols="60" required="required"><?php echo $row->ingredientes; ?></textarea>*
				</td>
			</tr>
			<tr>
				<td class="td_r">Preparo:</td>
				<td>
				<textarea name="preparo" id="preparo"
				rows="4" cols="80" required="required"><?php echo $row->preparo; ?></textarea>*
				</td>
			</tr>
			<tr>
				<td class="td_r">Comentários:</td>
				<td>
				<textarea name="comentarios" id="comentarios"
				rows="4" cols="80" required="required"><?php echo $row->comentarios; ?></textarea>*
				</td>
			</tr>
			<tr>
				<td colspan='2' class="td_c">
				<input type="hidden" name="form_operacao" value="consulta">
				<input name="alterar" type="button" value="Alterar" onClick="define_operacao('alt');">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input name="excluir" type="button" value="Excluir" onClick="define_operacao('exc');">* dados obrigatórios
				</td>
			</tr>
		</table>
	</form>
	</div>
	<?php require_once 'funcoes/menu.php';?>
	<div class="clear"></div>
</div> 
<div id="rodape">
   <p>Restaurante Boa Forma - Receitas Especiais</p>
</div>
</div>
</body>
</html>