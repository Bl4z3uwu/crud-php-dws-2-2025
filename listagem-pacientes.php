<?php

$titulo_pagina = 'Listagem de pacientes';
require 'cabecalho.php';

require 'conexao.php';

$sql = "SELECT `id`, `nome`, `data_nascimento`, `telefone`, `foto_paciente` FROM `pacientes` ORDER BY nome";
$stmt = $conn->query($sql);

?>
<div class="table-responsive">
    <table class="table table-striped">
        <thead class="table-success">
            <tr>
                <th scope="col" style="width: 10%;">ID</th>
                <th scope="col" style="width: 25%;">Nome</th>
                <th scope="col" style="width: 25%;">Data de Nascimento</th>
                <th scope="col" style="width: 10%;">Telefone</th>
                <th scope="col" style="width: 15%;">Foto</th>
                <th scope="col" style="width: 25%;" colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $stmt->fetch()){
            ?>
            <tr>
                <td><?=$row["id"]?></td>
                <td><?=$row["nome"]?></td>
                <td><?=$row["data_nascimento"]?></td>
                <td><?=$row["telefone"]?></td>
                <td>
                    <a target="_blank" href="<?=$row["foto_paciente"]?>">
                        Link foto
                    </a>
                </td>
                <td>
                    <a class="btn btn-warning btn-sm"
                    href="formulario-alterar-pacientes.php?id=<?=$row["id"]?>">
                        <span data-feather="edit"></span>
                        Editar
                    </a>
                </td>
                <td>
                    <a class="btn btn-danger btn-sm" 
                    href="excluir-pacientes.php?id=<?=$row["id"]?>"
                    onclick="if(!confirm('Tem certeza que deseja excluir?')) return false;">
                        <span data-feather="trash-2"></span>
                        Excluir
                    </a>
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<?php

    require 'rodape.php';

?>