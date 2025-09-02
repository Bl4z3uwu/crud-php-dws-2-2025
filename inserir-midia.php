<?php

$titulo_pagina = 'Página de inserção de mídias';
require 'cabecalho.php';

require 'conexao.php';

$titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);
$ano = filter_input(INPUT_POST, 'ano', FILTER_SANITIZE_NUMBER_INT);
$genero = filter_input(INPUT_POST, 'genero', FILTER_SANITIZE_SPECIAL_CHARS);
$poster = filter_input(INPUT_POST, 'poster', FILTER_SANITIZE_URL);

echo "<p><b>Título:</b> $titulo</p>";
echo "<p><b>Ano:</b> $ano</p>";
echo "<p><b>Gênero:</b> $genero</p>";
echo "<p><b>Poster:</b> $poster</p>";

$sql = "INSERT INTO `midias` (`titulo`, `ano`, `genero`, `poster`) VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$result = $stmt->execute([$titulo, $ano, $genero, $poster]);

if ($result) {
    // deu certo o insert
?>
    <div class='alert alert-success' role='alert'>
        <h4>Mídia inserida com sucesso!</h4>
    </div>
<?php
} else {
    // não deu certo, erro
?>
    <div class='alert alert-danger' role='alert'>
        <h4>Falha ao efetuar gravação.</h4>
        <p><?= $stmt->error; ?></p>
    </div>
<?php
}
require 'rodape.php';

?>