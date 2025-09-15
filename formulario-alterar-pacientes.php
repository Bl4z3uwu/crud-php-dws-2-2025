<?php

$titulo_pagina = 'Formulário de alteração de pacientes';
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

$sql = "SELECT nome,data_nascimento,telefone,foto_paciente FROM `pacientes` WHERE `id` = ?";

$stmt = $conn->prepare($sql);
$result = $stmt->execute([$id]);

$rowPaciente = $stmt->fetch();
?>
<form action="alterar-pacientes.php" method="post">
    <input type="hidden" name="id" value="<?=$id?>">
    <div class="row">
        <div class="col-8">
            <div class="row">
                <div class="mb-3 col-9">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" required
                    value="<?=$rowPaciente['nome']?>">
                </div>
                <div class="mb-3 col-3">
                    <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                    <input type="text" class="form-control" id="data_nascimento" name="data_nascimento" required
                    value="<?=$rowPaciente['data_nascimento']?>">
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-8">
                    <label for="foto_paciente" class="form-label">URL de uma foto/imagem do paciente</label>
                    <input type="url" class="form-control" id="foto_paciente" name="foto_paciente" aria_describedby="urlfotoHelp" required
                    value="<?=$rowPaciente['foto_paciente']?>">
                    <div id="urlfotoHelp" class="form-text">Endereço http de uma imagem da internet</div>
                </div>
                <div class="mb-3 col-4">
                    <label for="telefone" class="form-label">Telefone:</label>
                    <input class="form-control" id="telefone" name="telefone" value="<?=$rowPaciente['telefone']?>">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Gravar</button>
            <button type="reset" class="btn btn-warning">Cancelar</button>
        </div>
        <div class="col-3">
            <img src="<?=$rowPaciente['foto_paciente']?>" 
            alt="<?=$rowPaciente['nome']?>" class="img-thumbnail">
        </div>
    </div>
</form>
<?php

    require 'rodape.php';

?>