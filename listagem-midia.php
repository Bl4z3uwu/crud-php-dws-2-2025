<?php

session_start();
require 'logica-autenticacao.php';

$titulo_pagina = 'Listagem de mídias';
require 'cabecalho.php';

require 'conexao.php';

$sql = "SELECT `id`, `titulo`, `ano`, `genero`, `poster` FROM `midias` ORDER BY titulo";
$stmt = $conn->query($sql);

?>
<div class="table-responsive">
    <table class="table table-striped">
        <thead class="table-success">
            <tr>
                <th scope="col" style="width: 10%;">ID</th>
                <th scope="col" style="width: 25%;">Titulo</th>
                <th scope="col" style="width: 10%;">Ano</th>
                <th scope="col" style="width: 25%;">Gênero</th>
                <th scope="col" style="width: 15%;">Imagem</th>
                <?php
                if (autenticado()) {
                ?>
                <th scope="col" style="width: 25%;" colspan="2"></th>
                <?php
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $stmt->fetch()){
            ?>
            <tr>
                <td><?=$row["id"]?></td>
                <td><?=$row["titulo"]?></td>
                <td><?=$row["ano"]?></td>
                <td><?=$row["genero"]?></td>
                <td>
                    <a target="_blank" href="<?=$row["poster"]?>">
                        Link pôster
                    </a>
                </td>
                <?php
                if (autenticado()) {
                ?>
                <td>
                    <a class="btn btn-warning btn-sm"
                    href="formulario-alterar-midia.php?id=<?=$row["id"]?>">
                        <span data-feather="edit"></span>
                        Editar
                    </a>
                </td>
                <td>
                    <a class="btn btn-danger btn-sm" 
                    href="excluir-midia.php?id=<?=$row["id"]?>"
                    onclick="if(!confirm('Tem certeza que deseja excluir?')) return false;">
                        <span data-feather="trash-2"></span>
                        Excluir
                    </a>
                </td>
                <?php
                }
                ?>
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