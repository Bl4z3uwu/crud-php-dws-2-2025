<?php
session_start();
require 'logica-autenticacao.php';

$titulo_pagina = 'Página de inserção de mídias';
require 'conexao.php';

$titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);
$ano = filter_input(INPUT_POST, 'ano', FILTER_SANITIZE_NUMBER_INT);
$genero = filter_input(INPUT_POST, 'genero', FILTER_SANITIZE_SPECIAL_CHARS);
$poster = filter_input(INPUT_POST, 'poster', FILTER_SANITIZE_URL);

if ($conf["debug"]) {
    echo "<p><b>Título:</b> $titulo</p>";
    echo "<p><b>Ano:</b> $ano</p>";
    echo "<p><b>Gênero:</b> $genero</p>";
    echo "<p><b>Poster:</b> $poster</p>";
}

$sql = "INSERT INTO midias (titulo, ano, genero, poster) VALUES (?, ?, ?, ?)";

try {
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$titulo, $ano, $genero, $poster]);
} catch (Exception $e) {
    $result = false;
    $error = $e->getMessage();
}

$_SESSION["result"] = $result;

if ($result) {
    $_SESSION["msg_sucesso"] = "Dados gravados com sucesso!";
} else {
    $_SESSION["msg_erro"] = "Falha ao efetuar gravação.";
    $_SESSION["erro"] = $error;
}

redireciona("formulario-midia.php");
?>