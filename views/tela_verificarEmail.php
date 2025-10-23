<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SESSION['verificando'] != 1) {
    echo '<script>window.location.href="tela_cadastro.php"</script>';
    exit();
}

$hashcodeTime = !empty($_SESSION['hashcode-time']) ? $_SESSION['hashcode-time'] : null;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifique seu E-mail</title>
    <link rel="stylesheet" href="../assets/css/2step.css">
</head>
<body>
    <main>
        <header class="headerLogo">
            <img src="../assets/img/etecmcm.png" alt="Logo MCM">
        </header>
        <div class="container">
            <form action="../back/verificarEmail.php" method="POST">
                <h3>Enviamos um código no seu e-mail</h3>
                <input type="number" name="codigo" id="codigo" placeholder="Código" required>
                <a id="reenviar" href="../back/reenviarCodigo.php">Reenviar código</a>
                <span id="timerReenvio"></span>
                <button type="submit">Verificar</button>
            </form>
        </div>
    </main>
    <script>var hashcodeTime = <?= (int)$hashcodeTime; ?>;</script>
    <script src="../assets/js/timerReenviarCodigo.js"></script>
</body>
</html>