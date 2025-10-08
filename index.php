<?php 
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if (isset($_SESSION['admin']) && $_SESSION['admin'] === 0) {
  unset($_SESSION['admin']);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/index.css">
  <title>Feira Tecnológica - 2025</title>
</head>
<body>
    <main>
        <div class="logo">
            <img src="assets/img/etecmcm.png" alt="">
        </div>
        <div class="content-background">
            <?php if (!empty($_SESSION['id'])): ?>
                <div class="content">
                    <span>Usuário</span>
                    <?php if (!empty($_SESSION['admin'])): ?>
                        <a class="blue-button" href="admin/views/home.php">Admin</a>
                    <?php endif; ?>
                    <a class="blue-button" href="views/tela_home.php">Home</a>
                </div>
            <?php endif; ?>
            <?php if (empty($_SESSION['id'])): ?>
                <div class="content">
                    <span>Usuário</span>
                    <a class="blue-button" href="views/tela_home.php">Entrar sem conta</a>
                    <a class="blue-button" href="views/tela_login.php">Entrar</a>
                </div>
            <?php endif; ?>
            <div class="content">
                <span>Informativos</span>
                <a class="light-purple-button" href="https://etecmcm.cps.sp.gov.br/" target="blank">Etec MCM</a>
                <a class="light-purple-button" href="https://www.etecmcm.com.br/vestibulinho" target="blank">Vestibulinho</a>
                <a class="light-purple-button" href="views/tela_cursos.php" target="blank">Cursos</a>
            </div>
            <div class="content">
                <span>Utilitários</span>
                <a class="dark-purple-button" href="views/tela_creditos.php">Créditos</a>
            </div>
        </div>
    </main>
</body>
</html>