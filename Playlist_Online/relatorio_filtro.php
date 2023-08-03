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
		<h2>Procure sua música!</h2>
		<h3>Playlist Online</h3>
		<form name="form_acesso" method="post" action="relatorio_paginacao_filtro.php">
		  <table>
			<tr> <!-- filtro que será usada na pesquisa, se em branco a consulta traz todos o registros da tabela -->
			  <td>Nome da Música: <input name="filtro" type="text" id="filtro" size="30" maxlength="30"></td>
			</tr>
			<tr>
				<td><input class='input_envia' type="submit" name="submit" value="Pesquisar"></td>
			</tr>
		  </table>
		</form>
	</div>
	<?php require_once 'funcoes/menu.php';?>
	<div class="clear"></div>
</div> 
<div id="rodape">
  <p>Playlist online - Simplesmente o nome mais genérico do Brasil! - By Igor & Rayane</p>
</div>
</div> 
</body>
</html>