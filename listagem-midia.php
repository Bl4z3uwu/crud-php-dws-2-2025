<?php
session_start();
require 'logica-autenticacao.php';

$titulo_pagina = 'Listagem de mídias';
require 'cabecalho.php';

require 'conexao.php';

$exibir_busca = false;
$sql_busca = "";
$busca = "";
$tipo_busca = "";
$ordem = "titulo";

// Busca
if (!empty($_POST["busca"])) {
    $busca = filter_input(INPUT_POST, 'busca', FILTER_SANITIZE_SPECIAL_CHARS);
    $tipo_busca = filter_input(INPUT_POST, 'tipo_busca', FILTER_SANITIZE_SPECIAL_CHARS);

    $exibir_busca = true;

    switch ($tipo_busca) {
        case 'id':
            $idBusca = intval($busca);
            $sql_busca = " WHERE id LIKE '%$busca%' ";

            break;
        case 'genero':
            $sql_busca = " WHERE genero LIKE '%$busca%' ";

            break;
        case 'titulo':
            $sql_busca = " WHERE titulo LIKE '%$busca%' ";

            break;
        default:
            $idBusca = intval($busca);
            $sql_busca = " WHERE titulo LIKE '%$busca%' OR genero LIKE '%$busca%' OR id LIKE '%$idBusca%' ";
            break;
    }
}
// Ordem
if (!empty($_GET["ordem"])) {
    // Whitelist
    $valid_orders = ['id', 'id desc', 'titulo', 'titulo desc', 'ano', 'ano desc'];

    if (isset($ordem) && in_array($_GET["ordem"], $valid_orders)) {
        $ordem = filter_input(INPUT_GET, 'ordem', FILTER_SANITIZE_SPECIAL_CHARS);
    }
    else {
        $ordem = 'titulo';
    }
}

$sql = "SELECT id, titulo, ano, genero, poster FROM midias $sql_busca ORDER BY $ordem";
$stmt = $conn->query($sql);

echo "<p>Driver: <b>" . $conf["driver"] . "</b> </p>";

?>

<div class="row mb-3">
    <form action="" method="POST" class="row">
        <label class="col-sm-2 col-form-label text-end">
            Buscar por
        </label>
        <div class="col-sm-2">
            <select name="tipo_busca" id="tipo_busca" class="form-select">
                <option value="" <?= $tipo_busca == "" ? "selected" : "" ?>>Todos os campos</option>
                <option value="id" <?= $tipo_busca == "id" ? "selected" : "" ?>>ID</option>
                <option value="titulo" <?= $tipo_busca == "titulo" ? "selected" : "" ?>>Título</option>
                <option value="genero" <?= $tipo_busca == "genero" ? "selected" : "" ?>>Gênero</option>
            </select>
        </div>
        <div class="col-sm-6">
            <input type="search" name="busca" id="busca" 
                placeholder="Digite um termo" class="form-control" value="<?= $busca ?>">
        </div>
        <div class="col-sm-2">
            <button class="btn btn-primary">
                <i data-feather="search"></i> Pesquisar
            </button>
        </div>
    </form>
</div>
<?php
if ($exibir_busca) {
?>
<div class="alert alert-secondary">
    Resultados para: <b><?= $busca ?></b>
    - <a href="listagem-midia.php?ordem=<?=$ordem?>">Limpar</a>
</div>
<?php
}

if ($stmt->rowCount() == 0) {
?>
    <div class="alert alert-warning mt-3">
        Nenhum resultado encontrado!
    </div>
<?php
} else {
    if (isset($_SESSION["result"])) {
        if ($_SESSION["result"]) {
?>
        <div class="row mt-3">
            <div class="col-8 offset-2">
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
            <div class="col-8 offset-2">
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
?>
<div class="table-responsive">
    <table class="table table-striped">
        <thead class="table-success">
            <tr>
                <th scope="col" style="width: 10%;">
                    <a href="?ordem=<?= ($ordem == "id") ? "id desc" : "id"; ?>">ID</a>
                    <?php if ($ordem == "id") echo "▼"; ?>
                    <?php if ($ordem == "id desc") echo "▲"; ?>
                </th>
                <th scope="col" style="width: 25%;">
                    <a href="?ordem=<?= ($ordem == "titulo") ? "titulo desc" : "titulo"; ?>">Titulo</a>
                    <?php if ($ordem == "titulo") echo "▼"; ?>
                    <?php if ($ordem == "titulo desc") echo "▲"; ?>
                </th>
                <th scope="col" style="width: 10%;">
                    <a href="?ordem=<?= ($ordem == "ano") ? "ano desc" : "ano"; ?>">Ano</a>
                    <?php if ($ordem == "ano") echo "▼"; ?>
                    <?php if ($ordem == "ano desc") echo "▲"; ?>
                </th>
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
}
require 'rodape.php';

?>