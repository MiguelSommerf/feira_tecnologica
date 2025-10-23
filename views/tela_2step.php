<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['verificando'])) {
    unset($_SESSION['verificando']);
}
$hashcodeTime = !empty($_SESSION['hashcode-time']) ? $_SESSION['hashcode-time'] : null;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação de dois fatores</title>
    <link rel="stylesheet" href="../assets/css/2step.css">
</head>
<body class="TelaInicio">
    <main>
        <header class="headerLogo">
            <img src="../assets/img/etecmcm.png" alt="Logo MCM">
        </header>
        <div class="container">
            <?php if (isset($_SESSION['redefine'])): ?>
                <form action="../back/redefinir.php" method="POST">
                    <h3>Digite a sua nova senha</h3>
                    <input type="text" name="novaSenha" minlength="8" placeholder="Nova senha" required>
                    <button type="submit">Enviar</button>
                </form>
            <?php elseif (!isset($_SESSION['email'])): ?>
                <form action="../back/verificacao_dois_fatores.php" method="POST">
                    <h3>Digite o seu endereço de e-mail</h3>
                    <input type="text" name="email" placeholder="E-mail" required>
                    <button type="submit">Enviar</button>
                </form>
            <?php else: ?>
                <form action="../back/verificacao_dois_fatores.php" method="POST">
                    <h3>Digite o código que foi enviado no seu E-mail</h3>
                    <input type="text" name="codigo" minlength="6" maxlength="6" placeholder="Código" required>
                    <a id="reenviar" href="../back/reenviarCodigo.php">Reenviar código</a>
                    <span id="timerReenvio"></span>
                    <button type="submit">Enviar</button>
                </form>
                <script>var hashcodeTime = <?= (int)$hashcodeTime; ?>;</script>
                <script src="../assets/js/timerReenviarCodigo.js"></script>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>