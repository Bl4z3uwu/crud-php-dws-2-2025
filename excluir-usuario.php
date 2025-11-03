<?php
session_start();
require 'logica-autenticacao.php';

$titulo_pagina = 'Página de exclusão de usuários';
require 'cabecalho.php';

require 'conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

echo "<p><b>ID:</b> $id</p>";

$sql = "DELETE FROM usuarios WHERE id = ?";

$stmt = $conn->prepare($sql);
$result = $stmt->execute([$id]);

$count = $stmt->rowCount();

if ($result && $count >= 1) {
    // deu certo o delete
?>
    <div class='alert alert-success' role='alert'>
        <h4>Registro excluido com sucesso!</h4>
    </div>
<?php
} elseif ($count == 0) {
?>
    <div class='alert alert-danger' role='alert'>
        <h4>Falha ao efetuar exclusão.</h4>
        <p>Não foi encontrado nenhum registro com o ID = <?= $id ?>.</p>
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