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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Grenze:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script type="text/javascript" src="https://cdn.rybena.com.br/dom/master/latest/rybena.js"></script>
    <link rel="stylesheet" href="../assets/css/2step.css">
</head>
<body class="TelaInicio">
    <header>
        <div class="menu-toggle" id="mobile-menu">
        </div>
        <div class="logo-container">
        <img src="../assets/img/etecmcm.png" alt="Logo MCM"/>
        </div>
        <div class="ORGInfoHeader">
        <h1>Esqueci a Senha</h1>
        </div>
    </header>
    <button class="btn-voltar" onclick="window.location.href = '../views/tela_login.php'"">Voltar</button>
    <main>
        <?php if (isset($_SESSION['redefine'])): ?>
            <form action="../back/redefinir.php" method="post">
                <h3>Digite a sua nova senha</h3>
                <div>
                    <label>Senha</label>
                    <input type="text" name="novaSenha" required minlength="8">
                </div>
                <button type="submit">Enviar</button>
            </form>
        <?php elseif (!isset($_SESSION['email'])): ?>
            <form action="../back/verificacao_dois_fatores.php" method="post">
                <h3>Digite o seu endereço de e-mail</h3>
                <div>
                    <label>E-mail</label>
                    <input type="text" name="email" required>
                </div>
                <button type="submit">Enviar</button>
            </form>
        <?php else: ?>
            <form action="../back/verificacao_dois_fatores.php" method="post">
                <h3>Digite o código que foi enviado no seu E-mail</h3>
                <div>
                    <label>Código</label>
                    <input type="text" name="codigo" minlength="6" maxlength="6" required>
                </div>
                <a id="reenviar" href="../back/reenviarCodigo.php">Reenviar código</a>
                <span id="timerReenvio"></span>
                <button type="submit">Enviar</button>
            </form>
            <script>var hashcodeTime = <?= (int)$hashcodeTime; ?>;</script>
            <script src="../assets/JS/timerReenviarCodigo.js"></script>
        <?php endif; ?>
    </main>
</body>
</html>