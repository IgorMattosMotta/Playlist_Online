<?php
header("Content-Type: text/html; charset=utf-8", true);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>CRUD Playlis online</title>
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
$codigo_musica = "";
$nome_musica = "";
$compositor = "";
$link = "";
$resenha = "";
$destino = '';
$ComandoSQL = "";

// Só entrará neste bloco do IF após o envio pelo formulário - o campo form_operação será criado no formulário abaixo

if ($_POST['form_operacao'] == "inclusao_musicas") {
    try
    {
// abre conexão com o banco
        require_once 'funcoes/conexao.php';
// recebe os dados do formulário
        $codigo_musica = $_POST['codigo_musica'];
        $nome_musica = $_POST['nome_musica'];
        $compositor = $_POST['compositor'];
        $link = $_POST['link'];
        $resenha = $_POST['resenha'];
// verifica se já existe um registro na tabela para o código informado (chave duplicada)		
		$result = $conn->query("SELECT * FROM tb_musicas where codigo_musica = $codigo_musica");
		$count = $result->rowCount();
		if ($count > 0) {
			$destino = "function () {window.location='inclusao_musicas.php';}";
			echo "<script>sendToastr('Código de receita já cadastrado!<br />Clique para continuar!','error',$destino)</script>";
		}
// insere o dados digitados na tabele tb_musicas		
		$stmt = $conn->prepare('INSERT INTO tb_musicas VALUES
		(:codigo_musica,:nome_musica,:compositor,:link,:resenha)');
        $stmt->bindValue(':codigo_musica', $codigo_musica);
        $stmt->bindValue(':nome_musica', $nome_musica);
        $stmt->bindValue(':compositor', $compositor);
        $stmt->bindValue(':link', $link);
        $stmt->bindValue(':resenha', $resenha);
        $stmt->execute();

	} catch (PDOException $e) {
        // caso ocorra uma exceção, exibe na tela
		$destino = "function () {window.location='index.php';}";
		echo "<script>sendToastr($e->getMessage(),'error',$destino)</script>";
        die();
    }
	$destino = "function () {window.location='inclusao_musicas.php';}";
	echo "<script>sendToastr('Música cadastrada com sucesso!<br />Clique para continuar!','success',$destino)</script>";
}
?>
<!-- html comum - cria um formulário que chama o próprio programa inclusap_receitas.php -->
	<h2 class='h2_add'>Adicionar músicas</h2>
	  <form method="POST" action="inclusao_musicas.php" name="form_inclusao">
		<table width="600">
		  <tr>
			<td class="td_r">Código:</td>
			<td>
			  <input name="codigo_musica" type="text" id="codigo_musica" size="10" maxlength="10" required="required">*
			</td>
		  </tr>
		  <tr>
			<td class="td_r">Nome da música:</td>
			<td>
			  <input name="nome_musica" type="text" id="nome_musica" size="30" maxlength="30" required="required">*
			</td>
		  </tr>
		  <tr>
			<td class="td_r">Compositor:</td>
			<td>
			<input name="compositor" id="compositor" type="text"  size="50" maxlength="50" required="required">*
			  
			</td>
		  </tr>
		  <tr>
			<td class="td_r">Link:</td>
			<td>
			  <textarea name="link" id="link"
			  rows="2" cols="80" required="required"  maxlength="100"></textarea>*
			</td>
		  </tr>
		  <tr>
			<td class="td_r">Comentários:</td>
			<td>
			  <textarea name="resenha" id="resenha"
			  rows="1" cols="80" required="required" maxlength='80'></textarea>*
			</td>
		  </tr>
		  <tr>
			<td colspan='2' class="td_c">
				<br />
				<input type="hidden" name="form_operacao" value="inclusao_musicas">
				<input type="submit" class='input_envia' name="enviar" value="Inserir música">
				
				* dados obrigatórios
			</td>
		  </tr>
		  </table>
	  </form>
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