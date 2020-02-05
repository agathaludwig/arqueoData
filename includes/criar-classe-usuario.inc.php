<?php
class Usuario {
	var $usuario;
	var $senha;
	var $id;

	function cadastrar($conexao, $tabelaUsuarios) {
		$usuario = trim($conexao->escape_string($_POST["usuario"]));
		$senha = trim($conexao->escape_string($_POST["senha"]));
		$id = trim($conexao->escape_string($_POST["id"]));

		//criptografar a senha, por segurança
		$senha = hash("sha512", $senha);

		//atribuir os dados aos atributos da classe
		$this->usuario = $usuario;
		$this->senha = $senha;
		$this->id = $id;

		$sql = "INSERT $tabelaUsuarios VALUES(
						'$usuario',
						'$senha',
						'id')";

		$resultado = $conexao->query($sql) or exit($conexao->error);
		echo "<p>usuario cadastrado com sucesso</p>";
	}

	function redirecionarPaginaProtegida() {
		header('location: restrita.php');
	}

	function redirecionarPaginaAnalise() {
		header('location: analise.php');
	}

	function receberDadosFormulario($conexao) {
		$usuario = trim($conexao->escape_string($_POST['usuario']));

		$senha = trim($conexao->escape_string($_POST['senha']));

		$senha = hash('sha512', $senha);

		//atribuir estes dados aos atributos da classe
		$this->usuario = $usuario;
		$this->senha = $senha;
	}

	function testarCredenciais($conexao, $tabelaUsuarios) {
		$sql = "SELECT usuario, senha FROM $tabelaUsuarios WHERE usuario = '$this->usuario' AND senha = '$this->senha'";

		$resultado = $conexao->query($sql) or die($conexao->error);

		$numeroRegistros = $conexao->affected_rows;

		//se $numeroRegitros é zero, não deixamoso usuário fazer o login
		if ($numeroRegistros > 0) {
			return true;
		} else {
			return false;
		}

	}

	//método para desconectar o usuário da nossa aplicação
	function logout() {
		//abrimos uma sessão e depois a excluímos
		session_start();
		$_SESSION = array();
		session_destroy();
		//redirecionamos o usuário para a página de início
		header("location: inicio.php");
	}
}