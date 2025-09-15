<?php

$titulo_pagina = 'Página de inserção de pacientes';
require 'cabecalho.php';

require 'conexao.php';

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$data_nascimento = filter_input(INPUT_POST, 'data_nascimento', FILTER_SANITIZE_SPECIAL_CHARS);
$telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);
$foto_paciente = filter_input(INPUT_POST, 'foto_paciente', FILTER_SANITIZE_URL);

echo "<p><b>Nome:</b> $nome</p>";
echo "<p><b>Data de Nascimento:</b> $data_nascimento</p>";
echo "<p><b>Telefone:</b> $telefone</p>";
echo "<p><b>Foto do Paciente:</b> $foto_paciente</p>";

$sql = "INSERT INTO `pacientes` (`nome`, `data_nascimento`, `telefone`, `foto_paciente`) VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$result = $stmt->execute([$nome, $data_nascimento, $telefone, $foto_paciente]);

if ($result) {
    // deu certo o insert
?>
    <div class='alert alert-success' role='alert'>
        <h4>Paciente inserido com sucesso!</h4>
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