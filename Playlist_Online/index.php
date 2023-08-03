<!DOCTYPE HTML>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>Restaurante Boa Forma</title>
<!--
    Carrega as folhas de estilos e as bibliotecas em javascript para o funcionamento da funcionalidade toastr (mensagens do sistema) 
-->
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
		<div id='resto'>
			<h2 class='h2_resto'>Para que serve esse site?</h2>
			<p class='p_resto'>A criação desse site tem como intuito de expor músicas e gêneros musicais com suas devidas informações!
			   Além de receber a pontução máxima, é nois Dedé =)
			</p>
			<img id='img_dancarinos' src="css/imagens/dancarinos.jpg" alt="Dançarinos atuando">
			<h2 class=h2_resto>Como utilizar o site?</h2>
			<p class="p_resto">Para buscar alguma música ou gênero clique em 'Procurar'! Já se quiser adicionar algum conteúdo a mais clique em 'Add gênero' ou 'Add música'. Agora, se seu desejo for ver todas as músicas salvas com os respectivos links clique em 'Consultar músicas' ou 'Consultar gêneros'!</p>
		</div>
		<?php require_once 'funcoes/menu.php';?>
		<div class="clear"></div>
	</div>
	<br><br>
	<div id="rodape">
	<p>Playlist online - Simplesmente o nome mais genérico do Brasil! - By Igor & Rayane</p>
	</div>
</div>
</body>
</html>