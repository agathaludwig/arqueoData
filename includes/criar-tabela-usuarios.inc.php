<?php

$tabelaUsuarios = "cadastroUsuarios";

$sql = "CREATE TABLE IF NOT EXISTS $tabelaUsuarios (
		usuario VARCHAR(50) PRIMARY KEY,
		senha VARCHAR(130),
		id VARCHAR (15)
		)";

$resultado = $conexao->query($sql) or die($conexao->error);
?>