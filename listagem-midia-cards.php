<?php

session_start();
require 'logica-autenticacao.php';

$titulo_pagina = 'Mídias';
require 'cabecalho.php';

require 'conexao.php';

$sql = "SELECT `id`, `titulo`, `ano`, `genero`, `poster` FROM `midias` ORDER BY titulo";
$stmt = $conn->query($sql);

?>
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