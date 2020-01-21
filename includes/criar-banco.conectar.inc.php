<?php
// criar-banco.conectar.inc.php

$create = "CREATE DATABASE IF NOT EXISTS $nomeBanco";

// enviamos esta consulta via metodo query do objeto $conexão

$enviado = $conexao->query($create) or exit($conexao->error);

//echo "<p> db criado </p>";
?>
