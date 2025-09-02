<?php

$titulo_pagina = 'Formulário de alteração de mídias';
require 'cabecalho.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

if(empty($id)) {
?>
    <div class='alert alert-danger' role='alert'>
        <h4>Falha ao abrir formulário para edição.</h4>
        <p>ID da mídia está vazio.</p>
    </div>
<?php
    exit;
}

require 'conexao.php';

$sql = "SELECT titulo, ano, genero, poster FROM `midias` WHERE `id` = ?";

$stmt = $conn->prepare($sql);
$result = $stmt->execute([$id]);

$rowMidia = $stmt->fetch();
?>
<form action="alterar-midia.php" method="post">
    <input type="hidden" name="id" value="<?=$id?>">
    <div class="row">
        <div class="col-8">
            <div class="row">
                <div class="mb-3 col-9">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" required
                    value="<?=$rowMidia['titulo']?>">
                </div>
                <div class="mb-3 col-3">
                    <label for="ano" class="form-label">Ano</label>
                    <input type="text" class="form-control" id="ano" name="ano" required
                    value="<?=$rowMidia['ano']?>">
                </div>
            </div>
            <div class="mb-3">
                <label for="genero" class="form-label">Gênero:</label>
                <textarea class="form-control" id="genero" name="genero"><?=$rowMidia['genero']?></textarea>
            </div>
            <div class="mb-3">
                <label for="poster" class="form-label">URL de uma foto/imagem do pôster</label>
                <input type="url" class="form-control" id="poster" name="poster" aria_describedby="urlfotoHelp" required
                value="<?=$rowMidia['poster']?>">
                <div id="urlfotoHelp" class="form-text">Endereço http de uma imagem da internet</div>
            </div>

            <button type="submit" class="btn btn-primary">Gravar</button>
            <button type="reset" class="btn btn-warning">Cancelar</button>
        </div>
        <div class="col-3">
            <img src="<?=$rowMidia['poster']?>" 
            alt="<?=$rowMidia['titulo']?>" class="img-thumbnail">
        </div>
    </div>
</form>
<?php

    require 'rodape.php';

?>