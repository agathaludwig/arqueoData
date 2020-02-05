<?php
//inserimos a include que cria a classe Usuario
require "./includes/criar-classe-usuario.inc.php";

$usuario = new Usuario;

//invocamos o método que faz a desconexão do nosso usuário da aplicação
$usuario->logout();
?>