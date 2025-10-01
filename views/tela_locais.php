<?php
require_once '../config/database.php';
require_once '../back/classes/Logout.php';

$verif = new Logout();
$verif->logout();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/tela_locais.css">
    <title>Locais da escola</title>
</head>
<body>
    <header class="headerLogo">
        <img src="../assets/img/etecmcm.png" alt="EtecMCM">
    </header>
    <main>
        <div class="separacao">
            <p>Blocos</p>
            <a href="#">Bloco A</a>
            <a href="#">Bloco B</a>
        </div>
        <div class="separacao">
            <p>Outros locais</p>
            <a href="#" class="cor-alt">Biblioteca</a>
            <a href="#" class="cor-alt">Auditório</a>
            <a href="#" class="cor-alt">Quadra</a>
        </div>
        <div>
            <h2>Locais</h2>
        </div>
    </main>
</body>
</html>