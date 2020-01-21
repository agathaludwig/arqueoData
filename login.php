<?php
session_start();
$_SESSION['logado'] = true;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title> Login </title>
		<link rel="stylesheet" href="./css/banco.css">
</head>

<body>
	<h1> Acesso à área restrita </h1>

	<form action="" method="post">
		<fieldset>
			<legend> Credenciais </legend>

			<label class="alinha"> Usuario: </label>
			<input type="text" name="usuario" autofocus> <br>

			<label class="alinha"> Senha: </label>
			<input type="password" name="senha"> <br>

			<button type="submit" name="logar"> Login </button>
		</fieldset>
	</form>
<?php
$nomeDaInclude1 = "./includes/dados.conectar.inc.php";
$nomeDaInclude2 = "./includes/conectar.inc.php";
$nomeDaInclude3 = "./includes/criar-banco.conectar.inc.php";
$nomeDaInclude4 = "./includes/useBanco.inc.php";
$nomeDaInclude5 = "./includes/definirCharset.inc.php";
$nomeDaInclude6 = "./includes/criar-tabela-usuarios.inc.php";
$nomeDaInclude7 = "./includes/criar-classe-usuario.inc.php";
$nomeDaInclude8 = "./includes/desconectar.inc.php";
require_once $nomeDaInclude1;
require_once $nomeDaInclude2;
require_once $nomeDaInclude3;
require_once $nomeDaInclude4;
require_once $nomeDaInclude5;
require_once $nomeDaInclude6;
require_once $nomeDaInclude7;

if (isset($_POST["logar"])) {

	//objeto usuario
	$usuario = new Usuario();
	$usuario->receberDadosFormulario($conexao);

	//testar se o login e a senha fornecidos estão no banco de dados
	$dadosCorretos = $usuario->testarCredenciais($conexao, $tabelaUsuarios);

	if ($dadosCorretos) {
		$usuario->redirecionarPaginaProtegida();
	} else {
		echo "<script>
				alert('Suas credenciais estão incorretas! Tente novamente ou efetue o cadastro em nossa aplicação.');
			</script>";
	}

	require_once $nomeDaInclude8;
}
?>
</body>
</html>