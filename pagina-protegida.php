<?php

session_start();

$titulo_pagina = 'Pagina protegida';
require 'cabecalho.php';

if(!isset($_SESSION["email"])) {
?>
    <div class='alert alert-danger' role='alert'>
        <h4>Esta é uma página PROTEGIDA!.</h4>
        <p>Você está tentando acessar conteúdo restrito.</p>
    </div>
<?php
} else {
?>
<div class="text-center">
    <p class="display-4 fw-bold">
        Aula de sessões.
    </p>
    <p class="display-4">
        Está é uma página <span class="bg-danger text-warning">PROTEGIDA</span>,
    </p>
    <p class="display-4">
        só deve ser possivel acessá-la,
    </p>
    <p class="display-4">
        <span class="bg-warning"> após ter se autenticado (feito login)</span>.
    </p>
</div>
<?php
}

require 'rodape.php';

?>