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
$codigo_genero = "";
$nome_genero = "";
$ritmo = "";
$exemplo = "";
$caracteristicas = "";
$destino = '';
$ComandoSQL = "";

// Só entrará neste bloco do IF após o envio pelo formulário - o campo form_operação será criado no formulário abaixo

if ($_POST['form_operacao'] == "inclusao_generos") {
    try
    {
// abre conexão com o banco
        require_once 'funcoes/conexao.php';
// recebe os dados do formulário
        $codigo_genero = $_POST['codigo_genero'];
        $nome_genero = $_POST['nome_genero'];
        $ritmo = $_POST['ritmo'];
        $exemplo = $_POST['exemplo'];
        $caracteristicas = $_POST['caracteristicas'];
// verifica se já existe um registro na tabela para o código informado (chave duplicada)		
		$result = $conn->query("SELECT * FROM tb_generos where codigo_genero = $codigo_genero");
		$count = $result->rowCount();
		if ($count > 0) {
			$destino = "function () {window.location='inclusao_generos.php';}";
			echo "<script>sendToastr('Código de Gênero já cadastrado!<br />Clique para continuar!','error',$destino)</script>";
		}
// insere o dados digitados na tabele tb_generos		
		$stmt = $conn->prepare('INSERT INTO tb_generos VALUES
		(:codigo_genero,:nome_genero,:ritmo,:exemplo,:caracteristicas)');
        $stmt->bindValue(':codigo_genero', $codigo_genero);
        $stmt->bindValue(':nome_genero', $nome_genero);
        $stmt->bindValue(':ritmo', $ritmo);
        $stmt->bindValue(':exemplo', $exemplo);
        $stmt->bindValue(':caracteristicas', $caracteristicas);
        $stmt->execute();

	} catch (PDOException $e) {
        // caso ocorra uma exceção, exibe na tela
		$destino = "function () {window.location='index.php';}";
		echo "<script>sendToastr($e->getMessage(),'error',$destino)</script>";
        die();
    }
	$destino = "function () {window.location='inclusao_generos.php';}";
	echo "<script>sendToastr('Música cadastrada com sucesso!<br />Clique para continuar!','success',$destino)</script>";
}
?>
<!-- html comum - cria um formulário que chama o próprio programa inclusap_receitas.php -->
	<h2 class='h2_add'>Adicionar gêneros</h2>
	  <form method="POST" action="inclusao_generos.php" name="form_inclusao">
		<table width="600">
		  <tr>
			<td class="td_r">Código genêro:</td>
			<td>
			  <input name="codigo_genero" type="text" id="codigo_genero" size="10" maxlength="10" required="required">*
			</td>
		  </tr>
		  <tr>
			<td class="td_r">Nome da genêro:</td>
			<td>
			  <input name="nome_genero" type="text" id="nome_genero" size="30" maxlength="30" required="required">*
			</td>
		  </tr>
		  <tr>
			<td class="td_r">Ritmo:</td>
			<td>
			  <input name="ritmo" id="ritmo" size="50" required="required" maxlength='50'>*
			</td>
		  </tr>
		  <tr>
			<td class="td_r">Exemplo:</td>
			<td>
			  <input name="exemplo" id="exemplo" size='50' required="required"  maxlength='50'>*
			</td>
		  </tr>
		  <tr>
			<td class="td_r">Características:</td>
			<td>
			  <textarea name="caracteristicas" id="caracteristicas"
			  rows="1" cols="80" required="required" maxlength='80'></textarea>*
			</td>
		  </tr>
		  <tr>
			<td colspan='2' class="td_c">
				<br />
				<input type="hidden" name="form_operacao" value="inclusao_generos">
				<input class='input_envia' type="submit" name="enviar" value="Inserir gênero">
				
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