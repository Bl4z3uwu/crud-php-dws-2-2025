<?php
session_start();
require 'logica-autenticacao.php';

require 'conexao.php';

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha');

$senha_hash = password_hash($senha, PASSWORD_BCRYPT);

echo "<p><b>Nome:</b> $nome</p>";
echo "<p><b>Email:</b> $email</p>";
echo "<p><b>Senha hash:</b> $senha_hash</p>";

$sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";

try {
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$nome, $email, $senha_hash]);
} catch (Exception $e) {
    $result = false;
    $error = $e->getMessage();
}

$_SESSION["result"] = $result;

if ($result) {
    $_SESSION["msg_sucesso"] = "Dados gravados com sucesso!";
} else {

    if (strpos($error, 'Duplicate entry') != false) {
        $error = "O e-mail <b>$email</b> já está registrado. <br>Não é possível utiliza-lo.";
    }

    $_SESSION["msg_erro"] = "Falha ao efetuar gravação.";
    $_SESSION["erro"] = $error;
}

redireciona("formulario-usuarios.php");
?>