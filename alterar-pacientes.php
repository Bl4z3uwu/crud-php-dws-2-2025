<?php

$titulo_pagina = 'Página de alteração de pacientes';
require 'cabecalho.php';

require 'conexao.php';

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$data_nascimento = filter_input(INPUT_POST, 'data_nascimento', FILTER_SANITIZE_SPECIAL_CHARS);
$telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);
$foto_paciente = filter_input(INPUT_POST, 'foto_paciente', FILTER_SANITIZE_URL);

echo "<p><b>ID:</b> $id</p>";
echo "<p><b>Nome:</b> $nome</p>";
echo "<p><b>Data de Nascimento:</b> $data_nascimento</p>";
echo "<p><b>Telefone:</b> $telefone</p>";
echo "<p><b>Foto:</b> $foto_paciente</p>";

$sql = "UPDATE `pacientes` SET `nome` = ?, `data_nascimento` = ?, `telefone` = ?, `foto_paciente` = ? 
            WHERE `id` = ?";

$stmt = $conn->prepare($sql);
$result = $stmt->execute([$nome, $data_nascimento, $telefone, $foto_paciente, $id]);
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