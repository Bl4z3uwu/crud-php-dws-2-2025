<?php
session_start();
require 'logica-autenticacao.php';

$titulo_pagina = 'Formulário de cadastro de usuários';
require 'cabecalho.php';

?>
<script>
    function verifica_senhas() {
        var senha = document.getElementById("senha");
        var confsenha = document.getElementById("confsenha");

        if (senha.value && confsenha.value) {
            if (senha.value != confsenha.value) {
                senha.classList.add("is-invalid");
                confsenha.classList.add("is-invalid");
                confsenha.value = null;
            } else {
                senha.classList.remove("is-invalid");
                confsenha.classList.remove("is-invalid");
            }
        }
    }
</script>
<form action="inserir-usuario.php" method="POST">
    <div class="row">
        <div class="col-3">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <div class="mb-3">
                <label for="confsenha" class="form-label">Confirmação senha</label>
                <input type="password" class="form-control" id="confsenha" name="confsenha" required aria-describedby="confsenha confsenhaFeedback" onblur="verifica_senhas();">
                <div id="confsenhaFeedback" class="invalid-feedback">
                    As senhas informadas não estão iguais.
                </div>
            </div>
        </div>
        <div class="col-3">
            <img src="dist/add-user-group-woman-man-icon-user-add.png" class="img-thumbnail" id="image-preview" alt="...">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Gravar</button>
    <button type="reset" class="btn btn-warning">Cancelar</button>
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
    <meta http-equiv="refresh" content="2; url=form-login.php">
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