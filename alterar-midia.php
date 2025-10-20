<?php

$titulo_pagina = 'Página de alteração de mídias';
require 'cabecalho.php';

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

$sql = "UPDATE `midias` SET `titulo` = ?, `ano` = ?, `genero` = ?, `poster` = ? 
            WHERE `id` = ?";

$stmt = $conn->prepare($sql);
$result = $stmt->execute([$titulo, $ano, $genero, $poster, $id]);
$count = $stmt->rowCount();

if ($result && $count >= 1) {
    // deu certo o update
?>
    <div class='alert alert-success' role='alert'>
        <h4>Dados alterados com sucesso.</h4>
    </div>
<?php
} elseif ($result && $count == 0) {
?>
    <div class='alert alert-secondary' role='alert'>
        <h4>Nenhum dado foi alterado.</h4>
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