<?php

$titulo_pagina = 'Formulário de cadastro de pacientes';
require 'cabecalho.php';

?>
<form action="inserir-pacientes.php" method="post">
    <div class="row">
        <div class="col-8">
            <div class="row">
                <div class="mb-3 col-8">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="mb-3 col-4">
                    <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                    <input type="text" class="form-control" id="data_nascimento" name="data_nascimento" required>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-8">
                    <label for="foto_paciente" class="form-label">URL de uma foto do paciente</label>
                    <input type="url" class="form-control" id="foto_paciente" name="foto_paciente" aria_describedby="urlfotoHelp" required>
                    <div id="urlfotoHelp" class="form-text">Endereço http de uma imagem do paciente</div>
                </div>
                <div class="mb-3 col-4">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input class="form-control" id="telefone" name="telefone">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Gravar</button>
            <button type="reset" class="btn btn-warning">Cancelar</button>
        </div>
    </div>
</form>
<?php

    require 'rodape.php';

?>