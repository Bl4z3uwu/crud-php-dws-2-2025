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
                </td>
                <?php
                if (autenticado()) {
                ?>
                <td>
                    <?php
                    if (id_usuario() == $row["id"]) {
                    ?>
                        <a class="btn btn-danger btn-sm" 
                        href="excluir-usuario.php?id=<?=$row["id"]?>"
                        onclick="if(!confirm('Tem certeza que deseja excluir?')) return false;">
                        <span data-feather="trash-2"></span>
                        Excluir
                        </a>
                    <?php
                    }else{
                    ?>
                        <button class="btn btn-secondary btn-sm" href="#" disabled>
                        <span data-feather="trash-2"></span>
                        Excluir
                        </button>
                    <?php
                    }
                    ?>
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