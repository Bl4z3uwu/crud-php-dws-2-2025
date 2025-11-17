<?php
session_start();
require 'logica-autenticacao.php';

if (!autenticado()) {
    $_SESSION['restrito'] = true;
    redireciona();
    die();
}

$titulo_pagina = 'Página de alteração de mídias';

require 'conexao.php';

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);
$ano = filter_input(INPUT_POST, 'ano', FILTER_SANITIZE_NUMBER_INT);
$genero = filter_input(INPUT_POST, 'genero', FILTER_SANITIZE_SPECIAL_CHARS);
$poster = filter_input(INPUT_POST, 'poster', FILTER_SANITIZE_URL);

echo "<p><b>ID:</b> $id</p>";
echo "<p><b>Título:</b> $titulo</p>";
echo "<p><b>Ano:</b> $ano</p>";
echo "<p><b>Gênero:</b> $genero</p>";
echo "<p><b>Poster:</b> $poster</p>";

$sql = "UPDATE midias SET titulo = ?, ano = ?, genero = ?, poster = ? 
            WHERE id = ?";

try {
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$titulo, $ano, $genero, $poster, $id]);
} catch (Exception $e) {
    $result = false;
    $error = $e->getMessage();
}

$count = $stmt->rowCount();

$_SESSION["result"] = $result;
if ($result && $count == 0) {
    $result = false;
    $_SESSION["msg_erro"] = "Nenhum dado foi alterado.";
    $_SESSION["erro"] = "Nenhuma alteração foi registrada.";
} elseif ($result) {
    $_SESSION["msg_sucesso"] = "Dados alterados com sucesso!";
} else {
    $_SESSION["msg_erro"] = "Falha ao efetuar gravação.";
    $_SESSION["erro"] = $error;
}

redireciona("listagem-midia.php");
?>