<?php
//criar a classe Aluno

class Analise {
	public $id;
	public $numPeca;
	public $tipoDeArtefato;
	public $listaDeCategorias;
	public $idInclinacao;
	public $listaDeManufaturas;
	public $listaDeTemperos;
	public $porcentagemDeTempero;
	public $distribuicaoDeTempero;
	public $tipoDeQueima;
	public $porcentagemDeQueima;

	function recebeId($conexao, $tabelaAnalise) {
		$query = "SELECT * FROM $tabelaAnalise ORDER BY id DESC LIMIT 1";
		$resultado = $conexao->query($query) or exit($conexao->error);
		$registro = $resultado->fetch_array();
		$id = htmlentities($registro[0], ENT_QUOTES, "UTF-8");
		$this->id = $id;
		//echo "<p> $this->id </p>";
	}

	function recebeDados($conexao, $tipo, $inclinacao, $dadosMetricos) {
		$numPeca = trim($conexao->escape_string($_POST["numPeca"]));
		//preciso setar numPeca novamente?
		$this->numPeca = $numPeca;
		$this->tipoDeArtefato = $tipo->descricao;
		$this->espMin = $dadosMetricos->espMin;
		$this->espMax = $dadosMetricos->espMax;
		$this->espBorda = $dadosMetricos->espBorda;
		$this->peso = $dadosMetricos->peso;
		$this->diametro = $dadosMetricos->diametro;
		$this->inclinacao = $inclinacao->descricao;
	}

	function cadastrar($conexao, $tabelaAnalise) {
		$query = "UPDATE $tabelaAnalise	SET
					idTipo = $this->tipoDeArtefato,
					espMin = $this->espMin,
					espMax = $this->espMax,
					espBorda = $this->espBorda,
					peso = '$this->peso',
					diametro = $this->diametro,
					idInclinacao = $this->inclinacao,
					idPorcentagemTemp = $this->porcentagemDeTempero,
					idDistribuicaoTemp = $this->distribuicaoDeTempero,
					idTipoQueima = $this->tipoDeQueima,
					porcentagemQueima = '$this->porcentagemDeQueima'
				WHERE id = $this->id";
		$enviado = $conexao->query($query) or die($conexao->error);
	}
}

class Metrico {
	public $espMin;
	public $espMax;
	public $espBorda;
	public $peso;
	public $diametro;

	function recebeDados($conexao) {
		$espMin = trim($conexao->escape_string($_POST["espMin"]));
		$espMax = trim($conexao->escape_string($_POST["espMax"]));
		$peso = trim($conexao->escape_string($_POST["peso"]));
		$espBorda = trim($conexao->escape_string($_POST["espBorda"]));
		$diametro = trim($conexao->escape_string($_POST["diametro"]));

		$this->espMin = $espMin;
		$this->espMax = $espMax;
		$this->espBorda = $espBorda;
		$this->peso = $peso;
		$this->diametro = $diametro;
		//echo "<p> Dados métricos recebidos </p>";
	}
}

class Inclinacao {
	public $descricao;
	function recebeDados($conexao) {
		$descricao = $conexao->real_escape_string(trim($_POST["inclinacao"]));
		$this->descricao = $descricao;
		//echo "<p> Inclinação Ok </p>";
	}
}

class TipoDeArtefato {
	public $descricao;
	function recebeDados($conexao) {
		$descricao = $conexao->real_escape_string(trim($_POST["tipoDeArtefato"]));
		$this->descricao = $descricao;
		//echo "<p> Tipo de artefato: $this->descricao</p>";
	}
}

class Categoria {
	public $descricao;

	function cadastrar($conexao, $tabelaAnaliseCategoria, $analise) {
		$descricao = $_POST["categoria"];

		foreach ($descricao as $key => $cat) {
			$categoria = trim($conexao->escape_string($cat));
			$query = "INSERT $tabelaAnaliseCategoria VALUES (default, $analise->id, $categoria)";
			$enviado = $conexao->query($query) or die($conexao->error);
			//echo "<p> Categoria no. $categoria inserida na análise no. $analise->id</p>";
		}
	}

	function recebeDados($conexao, $analise) {
		$descricao = $_POST["categoria"];
		$listaDeCategorias = implode(", ", $descricao);
		$listaDeCategorias = trim($conexao->escape_string($listaDeCategorias));

		$this->descricao = $descricao;
		$analise->listaDeCategorias = $listaDeCategorias;
		echo "<p> Lista de categorias: $analise->listaDeCategorias ";
	}
}

class Manufatura {
	public $descricao;

	function cadastrar($conexao, $tabelaAnaliseManufatura, $analise) {
		$descricao = $_POST["manufatura"];

		foreach ($descricao as $key => $man) {
			$manufatura = trim($conexao->escape_string($man));
			$query = "INSERT $tabelaAnaliseManufatura VALUES (default, $analise->id, $manufatura)";
			$enviado = $conexao->query($query) or die($conexao->error);
			//echo "<p> Manufatura no. $manufatura inserida na análise no. $analise->id</p>";
		}
	}

	function recebeDados($conexao, $analise) {
		$descricao = $_POST["manufatura"];
		$listaDeManufaturas = implode(", ", $descricao);
		$listaDeManufaturas = trim($conexao->escape_string($listaDeManufaturas));

		$this->descricao = $descricao;
		$analise->listaDeManufaturas = $listaDeManufaturas;
		echo "<p> Lista de manufaturas: $analise->listaDeManufaturas ";
	}
}

class Tempero {
	public $descricao;
	public $porcentagem;
	public $distribuicao;

	function cadastrar($conexao, $tabelaAnaliseTempero, $analise) {
		$descricao = $_POST["tempero"];

		foreach ($descricao as $key => $temp) {
			$tempero = trim($conexao->escape_string($temp));
			$query = "INSERT $tabelaAnaliseTempero VALUES (default, $analise->id, $tempero)";
			$enviado = $conexao->query($query) or die($conexao->error);
			//echo "<p> Tempero no. $tempero inserida na análise no. $analise->id</p>";
		}
	}

	function recebeDados($conexao, $analise) {
		$descricao = $_POST["tempero"];
		$listaDeTemperos = implode(", ", $descricao);
		$listaDeTemperos = trim($conexao->escape_string($listaDeTemperos));

		$this->descricao = $descricao;
		$analise->listaDeTemperos = $listaDeTemperos;
		echo "<p> Lista de temperos: $analise->listaDeTemperos ";

		$porcentagem = $conexao->real_escape_string(trim($_POST["porcentagemDeTempero"]));
		$this->porcentagem = $porcentagem;
		$analise->porcentagemDeTempero = $this->porcentagem;
		echo "<p> Porcentagem: $analise->porcentagemDeTempero ";

		$distribuicao = $conexao->real_escape_string(trim($_POST["distribuicaoDeTempero"]));
		$this->distribuicao = $distribuicao;
		$analise->distribuicaoDeTempero = $this->distribuicao;
		echo "<p> Distribuição: $analise->distribuicaoDeTempero ";
	}
}

class Queima {
	public $tipo;
	public $porcentagem;

	function recebeDados($conexao, $analise) {
		$tipo = $conexao->real_escape_string(trim($_POST["tipoDeQueima"]));
		$this->tipo = $tipo;
		$analise->tipoDeQueima = $this->tipo;
		echo "<p> Tipo de queima: $analise->tipoDeQueima";

		$porcentagem = trim($conexao->escape_string($_POST["porcentagemDeQueima"]));
		$this->porcentagem = $porcentagem;
		$analise->porcentagemDeQueima = $this->porcentagem;
		echo "<p> Porcentagem de queima: $analise->porcentagemDeQueima% ";
	}
}

?>