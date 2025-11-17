<?php
session_start();
require 'logica-autenticacao.php';

if (!autenticado()) {
    $_SESSION['restrito'] = true;
    redireciona();
    die();
}

require 'conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

echo "<p><b>ID:</b> $id</p>";

$sql = "DELETE FROM midias WHERE id = ?";

try {
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$id]);
} catch (Exception $e) {
    $result = false;
    $error = $e->getMessage();
}

$count = $stmt->rowCount();
$_SESSION["result"] = $result;

if ($result && $count == 0) {
    $result = false;
    $_SESSION["msg_erro"] = "Falha ao efetuar exclusão";
    $_SESSION["erro"] = "Não foi encontrado nenhum registro com o ID ($id).";
} elseif ($result) {
    $_SESSION["msg_sucesso"] = "Registro excluido com sucesso!";
} else {
    $_SESSION["msg_erro"] = "Falha ao efetuar exclusão.";
    $_SESSION["erro"] = $error;
}

redireciona("listagem.php");