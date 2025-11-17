<?php
session_start();
require 'logica-autenticacao.php';

require 'conexao.php';

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

if ($conf["debug"]) {
    echo "<p><b>Email:</b> $email</p>";
}

$sql = "SELECT id, nome, senha FROM usuarios WHERE email = ?";

try {
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$email]);
} catch (Exception $e) {
    $result = false;
    $error = $e->getMessage();
}

$row = $stmt->fetch();

if(password_verify($senha, $row['senha'])) {
    // DEU CERTO
    $_SESSION["id_usuario"] = $row['id'];
    $_SESSION["email"] = $email;
    $_SESSION["nome"] = $row['nome'];
    redireciona("index.php");
}else{
    // NÃO DEU CERTO, SENHA OU EMAIL ERRADO
    unset($_SESSION["id_usuario"]);
    unset($_SESSION["email"]);
    unset($_SESSION["nome"]);

    $_SESSION["msg_erro"] = "Falha ao efetuar autenticação.";
    $_SESSION["erro"] = "Usuário ou senha incorretos." . $error;

    redireciona("form-login.php");
    
}