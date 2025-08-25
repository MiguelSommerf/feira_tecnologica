<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION['verificando'] != 1) {
    echo "<script>window.location.href='../views/tela_cadastro.php'</script>";
    exit();
}
$hashcodeTime = $_SESSION['hashcode-time'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifique seu E-mail</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Grenze:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script type="text/javascript" src="https://cdn.rybena.com.br/dom/master/latest/rybena.js"></script>
    <link rel="stylesheet" href="../assets/css/2step.css">
</head>
<body>
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
        <form action="../back/verificarEmail.php" method="POST">
            <h1>Enviamos um código no seu e-mail</h1>
            <h1>Confirme que é você.</h1>
            <h2>Insira o código:</h2>
            <input type="number" name="codigo" id="codigo" placeholder="Código">
            <a id="reenviar" href="../back/reenviarCodigo.php">Reenviar código</a>
            <span id="timerReenvio"></span>
            <button type="submit">Verificar</button>
        </form>
    </main>
    <script>var hashcodeTime = <?= (int)$hashcodeTime; ?>;</script>
    <script src="../assets/JS/timerReenviarCodigo.js"></script>
</body>
</html>