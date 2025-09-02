<?php

$titulo_pagina = 'Listagem de produtos';
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
                <th scope="col" style="width: 25%;" colspan="2"></th>
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
                <td>
                    <a href="#" class="btn btn-warning btn-sm" href="#">
                        <span data-feather="edit"></span>
                        Editar
                    </a>
                </td>
                <td>
                    <a href="#" class="btn btn-danger btn-sm" href="#">
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