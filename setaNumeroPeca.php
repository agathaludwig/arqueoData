<?php
//este arquivo intermediário em PHP foi criado tão somente para invocar o objeto $analise, receber o número da peça do ajax e setar a propriedade $numPeca com este valor. Após isso, o objeto análise fica com todos os atributos completos para serem gravados no banco, finalizando o cadastro

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

//criar o objeto Analise (Pq criar aqui e no analise de novo?)
$analise = new Analise();

//receber o número da peça do AJAX - este trecho do teu código é idêntico ao código que você criou dentro do método iniciar lá na classe. Podes apagar aquele método, não é mais necessário. A chamada do método inicar, no teu arquivo analise.php também não é mais necessário
$numPeca = $_GET["numero-peca"];
$numPeca = trim($conexao->escape_string($numPeca));
$query = "INSERT $tabelaAnalise (id, numFrag)
											VALUES (default, $numPeca)";
$enviado = $conexao->query($query) or die($conexao->error);
require_once $nomeDaInclude8;
?>