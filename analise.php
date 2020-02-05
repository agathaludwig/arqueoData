<?php
$nomeDaInclude1 = "./includes/dados.conectar.inc.php";
$nomeDaInclude2 = "./includes/conectar.inc.php";
$nomeDaInclude3 = "./includes/criar-banco.conectar.inc.php";
$nomeDaInclude4 = "./includes/useBanco.inc.php";
$nomeDaInclude5 = "./includes/definirCharset.inc.php";
$nomeDaInclude6 = "./includes/criarTabela.inc.php";
$nomeDaInclude7 = "./includes/criaClasse.inc.php";
$nomeDaInclude8 = "./includes/desconectar.inc.php";
require_once $nomeDaInclude1;
require_once $nomeDaInclude2;
require_once $nomeDaInclude3;
require_once $nomeDaInclude4;
require_once $nomeDaInclude5;
require_once $nomeDaInclude6;
require_once $nomeDaInclude7;
?>
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
  <meta name="viewport" content="width=devide-width, initial-scale=1.0">
  <title> ArqueoData</title>
		<link rel="stylesheet" href="./css/banco.css">
		<script>
			function contactarServidor(objCaixa)
				{
					//cria o objeto ajax
					var ajax = new XMLHttpRequest();

					//recebe o número da peça digitado no formulário
					var numeroPeca = objCaixa.value;

					//monta a query string que fará o ajax  enviar o número da peça ao PHP via requisição get
					var dados = "numero-peca=" + numeroPeca;

					//abre o ajax - insere, depois do GET, o nome de uma rquivo em PHP que se encarregará de receber o número da peça do ajax e setar a propriedade do objeto $analise com este valor
					ajax.open('GET', 'setaNumeroPeca.php?' + dados, true);

					//envia o ajax
					ajax.send(null);
				}
			</script>
</head>

<body>
	<h1>arqueoData: análise cerâmica</h1>
	<form action="analise.php" method="post">

	<fieldset div="clearfix">
		<legend>Identificação</legend>
		<div class="box2">
			<label class="min">Número da peça: </label>
			<input class="emBox2" type="number" name="numPeca" min="0" onblur="contactarServidor(this);">
		</div>
	</fieldset>

	<fieldset div="clearfix">
		<legend>Tipo de artefato</legend>
		<?php
$query = "SELECT * FROM $tabelaTipo ORDER BY ordem";
$executa = $conexao->query($query);
while ($row = $executa->fetch_array()) {
	echo "<div class='divOpcoes'>";
	echo "<input type='radio' name = 'tipoDeArtefato' value='$row[0]'> <label class='opcao'>$row[1] </label>";
	echo "</div>";
}
?>
	</fieldset>

	<fieldset div="clearfix">
		<legend>Categoria do Fragmento </legend>
		<?php
$query = "SELECT * FROM $tabelaCategoria ORDER BY ordem";
$executa = $conexao->query($query);
while ($row = $executa->fetch_array()) {
	echo "<div class='divOpcoes'>";
	echo "<input type='checkbox' name='categoria[]' value='$row[0]'> <label>$row[1] </label>";
	echo "</div>";
}
?>
	</fieldset>

	<fieldset div="clearfix">
		<legend>Dados Métricos</legend>
		<div class="box3">
			<label class="min"> Espessura Mínima: </label>
			<input class="emBox3" type="number" name="espMin" min=0 >
		</div>
		<div class="box3">
			<label class="min"> Espessura Máxima: </label>
			<input class="emBox3" type="number" name="espMax" min=0 >
		</div>
		<div class="box3">
			<label class="min"> Peso: </label>
			<input class="emBox3" type="number" name="peso" min=0 step=0.001>
		</div>
		<div class="box3">
			<label class="min"> Diâmetro: </label>
			<input class="emBox3" type="number" name="diametro" min=0>
		</div>
		<div class="box3">
			<label class="min"> Espessura da borda: </label>
			<input class="emBox3" type="number" name="espBorda" min=0 >
		</div>
		<div class="box3">
			<label class="min"> Inclinação: </label> <br>
			<select class="emBox3" name="inclinacao">
				<option>  </option>
				<?php
$query = "SELECT * FROM $tabelaInclinacao ORDER BY ordem";
$executa = $conexao->query($query);
while ($row = $executa->fetch_array()) {
	echo "<option value= '$row[0]'> $row[1] </option>";
}
?>
			</select>
		</div>
	</fieldset>

	<fieldset div="clearfix">
		<legend>Técnica de manufatura </legend>
		<?php
$query = "SELECT * FROM $tabelaManufatura ORDER BY ordem";
$executa = $conexao->query($query);
while ($row = $executa->fetch_array()) {
	echo "<div class='divOpcoes'>";
	echo "<input type='checkbox' name='manufatura[]' value='$row[0]'> <label>$row[1] </label>";
	echo "</div>";
}
?>
	</fieldset>

	<fieldset div="clearfix">
		<legend>Tempero </legend>
		<fieldset class="fieldinterno" div="clearfix">
			<legend> Antiplásticos: </legend>
		<?php
$query = "SELECT * FROM $tabelaTempero ORDER BY ordem";
$executa = $conexao->query($query);
while ($row = $executa->fetch_array()) {
	echo "<div class='divOpcoes3'>";
	echo "<input type='checkbox' name='tempero[]' value='$row[0]'> <label>$row[1] </label>";
	echo "</div>";
}
?>
		</fieldset>
		<fieldset class="fieldinterno" div="clearfix">
			<legend> Porcentagem: </legend>
		<?php
$query = "SELECT * FROM $tabelaPorcentagemTemp ORDER BY ordem";
$executa = $conexao->query($query);
while ($row = $executa->fetch_array()) {
	echo "<div class='divOpcoes'>";
	echo "<input type='radio' name='porcentagemDeTempero' value='$row[0]'> <label class='opcao'>$row[1] </label>";
	echo "</div>";
}
?>		</fieldset>
		<fieldset class="fieldinterno" div="clearfix">
			<legend> Distribuição: </legend>
		<?php
$query = "SELECT * FROM $tabelaDistribuicaoTemp ORDER BY ordem";
$executa = $conexao->query($query);
while ($row = $executa->fetch_array()) {
	echo "<div class='divOpcoes3'>";
	echo "<input type='radio' name='distribuicaoDeTempero' value='$row[0]'> <label class='opcao'>$row[1] </label>";
	echo "</div>";
}
?>		</fieldset>
	</fieldset>

	<fieldset div="clearfix">
		<legend>Queima </legend>
			<label> Porcentagem:  </label>
			<input type="number" name="porcentagemDeQueima" min=0 max=100 step=0.01>
			<label>% </label>
		<fieldset class="fieldinterno" div="clearfix">
			<legend> Tipo de Queima: </legend>
<?php
$query = "SELECT * FROM $tabelaTipoQueima ORDER BY ordem";
$executa = $conexao->query($query);
while ($row = $executa->fetch_array()) {
	echo "<div class='divOpcoes3'>";
	echo "<input type='radio' name='tipoDeQueima' value='$row[0]'> <label>$row[1] </label>";
	echo "</div>";
}
?>
		</fieldset>
	</fieldset>

	<button type="submit" name="enviar"> Enviar</button>
	</form>
	<!--logout-->
	<form action="logout.php" method="post">
		<button type="submit" name="desconectar"> Sair </button>
	</form>

	<?php
$analise = new Analise();
$analise->recebeId($conexao, $tabelaAnalise);
if (isset($_POST["desconectar"])) {
	$usuario->logout();
}
if (isset($_POST["enviar"])) {
	// criar objetos
	$tipo = new TipoDeArtefato();
	$tipo->recebeDados($conexao);
	$dadosMetricos = new Metrico();
	$dadosMetricos->recebeDados($conexao);
	$inclinacao = new Inclinacao();
	$inclinacao->recebeDados($conexao);
	$categoria = new Categoria();
	$categoria->cadastrar($conexao, $tabelaAnaliseCategoria, $analise);
	$categoria->recebeDados($conexao, $analise);
	$manufatura = new Manufatura();
	$manufatura->cadastrar($conexao, $tabelaAnaliseManufatura, $analise);
	$manufatura->recebeDados($conexao, $analise);
	$tempero = new Tempero();
	$tempero->cadastrar($conexao, $tabelaAnaliseTempero, $analise);
	$tempero->recebeDados($conexao, $analise);
	$queima = new Queima();
	$queima->recebeDados($conexao, $analise);
	$analise->recebeDados($conexao, $tipo, $inclinacao, $dadosMetricos);
	$analise->cadastrar($conexao, $tabelaAnalise);
	echo "<p> Dados cadastrados com sucesso. </p>";
}
require_once $nomeDaInclude8 // desconectar db;
?>
</body>
</html>