<?php
error_reporting(E_ALL);
//ini_set("display_errors", 1);

if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {

    $conf = parse_ini_file("config-local-mysql.ini");
    //$conf = parse_ini_file("config-local-postgresql.ini");
} else {
    $conf = parse_ini_file("config-byet.ini");
}

$string_connection = $conf["driver"] .
        ":dbname=" . $conf["database"] .
          ";host=" . $conf["server"] .
          ";port=" . $conf["port"];

try {
    $conn = new PDO(
        $string_connection,
        $conf["user"],
        $conf["password"]
    );
    if ($conf["debug"] == "true") {
        echo "<h2>Sucesso!</h2>";
        echo "<p>Conectado ao banco <b>" . $conf["database"] . "</b></p>";
    }
} catch (Exception $e) {
    echo "<p>Erro ao se conectar no banco de dados. </p>";
    echo $e->getMessage();
}
