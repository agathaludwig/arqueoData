<?php
session_start();
$_SESSION['logado'] = true;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title> Cadastro de usuário</title>
		<link rel="stylesheet" href="./css/banco.css">
</head>

<body>
	<h1> Cadastro de usuário </h1>

	<form action="" method="post">
		<fieldset>
			<legend> Dados cadastrais </legend>

			<label class="alinha"> ID do pesquisador: </label>
			<input type="text" name="id" autofocus> <br>

			<label class="alinha"> Usuário: </label>
			<input type="text" name="usuario"> <br>

			<label class="alinha"> Senha: </label>
			<input type="password" name="senha"> <br>

			<button type="submit" name="cadastrar"> Cadastrar </button>
		</fieldset>
	</form>
<?php
require "./includes/dados.conectar.inc.php";
require "./includes/conectar.inc.php";
require "./includes/criar-banco.conectar.inc.php";
require "./includes/useBanco.inc.php";
require "./includes/definirCharset.inc.php";
require "./includes/criarTabela.inc.php";
require "./includes/criar-tabela-usuarios.inc.php";
require "./includes/criaClasse.inc.php";
require "./includes/criar-classe-usuario.inc.php";

if (isset($_POST["cadastrar"])) {
	//objeto usuario
	$usuario = new Usuario();
	$usuario->cadastrar($conexao, $tabelaUsuarios);
	$usuario->redirecionarPaginaProtegida();
}
?>
</body>
</html>