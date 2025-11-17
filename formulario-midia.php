<?php
session_start();
require 'logica-autenticacao.php';

if (!autenticado()) {
    $_SESSION['restrito'] = true;
    redireciona();
    die();
}

$titulo_pagina = 'Formulário de cadastro de mídias';
require 'cabecalho.php';

?>
<form action="inserir-midia.php" method="post">
    <div class="row">
        <div class="col-8">
            <div class="row">
                <div class="mb-3 col-9">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" required>
                </div>
                <div class="mb-3 col-3">
                    <label for="ano" class="form-label">Ano</label>
                    <input type="text" class="form-control" id="ano" name="ano" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="genero" class="form-label">Gênero:</label>
                <textarea class="form-control" id="genero" name="genero"></textarea>
            </div>
            <div class="mb-3">
                <label for="poster" class="form-label">URL de uma foto/imagem do pôster</label>
                <input type="url" class="form-control" id="poster" name="poster" aria_describedby="urlfotoHelp" required>
                <div id="urlfotoHelp" class="form-text">Endereço http de uma imagem da internet</div>
            </div>

            <button type="submit" class="btn btn-primary">Gravar</button>
            <button type="reset" class="btn btn-warning">Cancelar</button>
        </div>
    </div>
</form>
<?php
if (isset($_SESSION["result"])) {
    if ($_SESSION["result"]) {
?>
    <div class="row mt-3">
        <div class="col-8">
            <div class="alert alert-success mt-3" role="alert">
                <h4><?= $_SESSION["msg_sucesso"] ?></h4>
            </div>
        </div>
    </div>
<?php
    unset($_SESSION["msg_sucesso"]);
    } else {
?>
    <div class="row mt-3">
        <div class="col-8">
            <div class="alert alert-danger mt-3" role="alert">
                <h4><?= $_SESSION["msg_erro"] ?></h4>
                <p><?= $_SESSION["erro"] ?></p>
            </div>
        </div>
    </div>
<?php
    unset($_SESSION["msg_erro"]);
    unset($_SESSION["erro"]);
    }
    unset($_SESSION["result"]);
}

require 'rodape.php';

?>