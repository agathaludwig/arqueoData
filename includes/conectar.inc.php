<?php
// include : conexão com banco de dados
// classe MySQLi 

$conexao = new mysqli($servidor, $usuario, $senha) or exit($conexao->error);
// parâmetros mínimos obrigatórios: servidor, usuário, senha de acesso inseridos via include (questão segurança)

//echo "<p> conectado ao db </p>";
?>