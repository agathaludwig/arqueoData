<?php
session_start();
//testamos a variável de sessão, a fim de garantir que esta  página seja acessada somente se o usuário passou pelo cadastro ou pelo login
if (!isset($_SESSION['logado'])) {
	header('location: inicio.php');
	exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title> Conteúdo restrito </title>
		<link rel="stylesheet" href="./css/banco.css">
</head>

<body>
	<h1> Acesso restrito </h1>
	<p> Você está acessando a primeira página restrita de nossa aplicação. <br>
	Seja bem-vindo! <br>
	Acesse para iniciar análise. </p>

	<!--analise-->
	<form action="analise.php" method="post">
		<button type="submit" name="analise"> Análise </button>
	</form>

	<!--logout-->
	<form action="logout.php" method="post">
		<button type="submit" name="desconectar"> Sair </button>
	</form>

</body>
</html>
