<?php

session_start();
require 'logica-autenticacao.php';

$titulo_pagina = 'Mídias';
$ordem = "titulo";
require 'cabecalho.php';

require 'conexao.php';

// Ordem
if (!empty($_GET["campo"]) && !empty($_GET["ordem"])) {
    // Whitelist
    $valid_orders = ['id asc', 'id desc', 'titulo asc', 'titulo desc', 'ano asc', 'ano desc', 'genero asc', 'genero desc'];

    if (isset($ordem) && in_array($_GET["campo"] . " " . $_GET["ordem"], $valid_orders)) {
        $ordem = filter_input(INPUT_GET, 'ordem', FILTER_SANITIZE_SPECIAL_CHARS);
        $campo = filter_input(INPUT_GET, 'campo', FILTER_SANITIZE_SPECIAL_CHARS);
    }
    else {
        $ordem = 'titulo';
    }
}

$sql = "SELECT id, titulo, ano, genero, poster FROM midias ORDER BY $campo $ordem";
echo $sql;
$stmt = $conn->query($sql);

?>

<div class="d-flex justify-content-end me-4 my-3 ordenacao align-items-center">
    <span class="me-2 fw-semibold">Ordenar por:</span>
    <a href="?campo=id&ordem=<?php echo ($ordem == 'desc') ? 'asc' : 'desc' ?>" class="btn btn-outline-primary btn-sm mx-1 <?php echo ($campo == 'id') ? 'active' : '' ?>">
        ID
        <span data-feather="<?php echo ($ordem == 'desc') ? 'chevron-down' : 'chevron-up' ?>"></span>
    </a>
    <a href="?campo=titulo&ordem=<?php echo ($ordem == 'desc') ? 'asc' : 'desc' ?>" class="btn btn-outline-primary btn-sm mx-1 <?php echo ($campo == 'titulo') ? 'active' : '' ?>">
        Título
        <span data-feather="<?php echo ($ordem == 'desc') ? 'chevron-down' : 'chevron-up' ?>"></span>
    </a>
    <a href="?campo=genero&ordem=<?php echo ($ordem == 'desc') ? 'asc' : 'desc' ?>" class="btn btn-outline-primary btn-sm mx-1 <?php echo ($campo == 'genero') ? 'active' : '' ?>">
        Gênero
        <span data-feather="<?php echo ($ordem == 'desc') ? 'chevron-down' : 'chevron-up' ?>"></span>
    </a>
    <a href="?campo=ano&ordem=<?php echo ($ordem == 'desc') ? 'asc' : 'desc' ?>" class="btn btn-outline-primary btn-sm mx-1 <?php echo ($campo == 'ano') ? 'active' : '' ?>">
        Ano
        <span data-feather="<?php echo ($ordem == 'desc') ? 'chevron-down' : 'chevron-up' ?>"></span>
    </a>
</div>

<div class="album py-5 gb-light">
    <div class="container">
            <?php
            while ($row = $stmt->fetch()){
            ?>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="<?=$row["poster"]?>" class="img-fluid rounded-start" alt="Poster de <?=$row["titulo"]?>">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?=$row["titulo"]?></h5>
                            <p class="card-text">Gênero: <?=$row["genero"]?></p>
                            <p class="card-text"><small class="text-muted">Ano: <?=$row["ano"]?></small></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>



<?php

    require 'rodape.php';

?>