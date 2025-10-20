<?php
session_start();

$titulo_pagina = 'Página de destino da autenticação (LOGIN)';
require 'cabecalho.php';

// require 'conexao.php';

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

echo "<p><b>E-mail:</b> $email</p>";

if($email == "gabrieljordao@gmail.com" && $senha == "123") {
    // DEU CERTO

    $_SESSION["email"] = $email;
    $_SESSION["nome"] = "Gabriel Jordão";
?>
    <div class='alert alert-success' role='alert'>
        <h4>Autenticado com sucesso!</h4>
    </div>
<?php
}else{
    // NÃO DEU CERTO, SENHA OU EMAIL ERRADO

    unset($_SESSION["email"]);
    unset($_SESSION["nome"]);
?>
    <div class='alert alert-danger' role='alert'>
        <h4>Falha ao efetuar autenticação.</h4>
        <p>Usuário ou senha incorretos.</p>
    </div>
<?php
}

require 'rodape.php';

?>