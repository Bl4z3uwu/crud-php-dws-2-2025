<?php

session_start();
require 'logica-autenticacao.php';

$titulo_pagina = 'Listagem de usuários';
require 'cabecalho.php';

require 'conexao.php';

$sql = "SELECT id, nome, email FROM usuarios";
$stmt = $conn->query($sql);

?>
<div class="table-responsive">
    <table class="table table-striped">
        <thead class="table-success">
            <tr>
                <th scope="col" style="width: 10%;">ID</th>
                <th scope="col" style="width: 30%;">Nome</th>
                <th scope="col" style="width: 30%;">Email</th>
                <?php
                if (autenticado()) {
                ?>
                <th scope="col" style="width: 10%;" colspan="1"></th>
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
                <td><?=$row["nome"]?></td>
                <td><?=$row["email"]?></td>
                    </a>
                </td>
                <?php
                if (autenticado()) {
                ?>
                <td>
                    <a class="btn btn-danger btn-sm" 
                    href="excluir-usuario.php?id=<?=$row["id"]?>"
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