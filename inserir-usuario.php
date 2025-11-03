<?php
session_start();
require 'logica-autenticacao.php';

$titulo_pagina = 'Página de inserção de usuários';
require 'cabecalho.php';
require 'conexao.php';

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha');

$senha_hash = password_hash($senha, PASSWORD_BCRYPT);

echo "<p><b>Nome:</b> $nome</p>";
echo "<p><b>Email:</b> $email</p>";
echo "<p><b>Senha hash:</b> $senha_hash</p>";

$sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);
$result = $stmt->execute([$nome, $email, $senha_hash]);

if ($result) {
    // deu certo o insert
?>
    <div class='alert alert-success' role='alert'>
        <h4>Dados gravados com sucesso!</h4>
    </div>
<?php
} else {
    // não deu certo, erro
    $errorArray = $stmt->errorInfo();
?>
    <div class='alert alert-danger' role='alert'>
        <h4>Falha ao efetuar gravação.</h4>
        <p><?= $errorArray[2]; ?></p>
    </div>
<?php
}
require 'rodape.php';

?>