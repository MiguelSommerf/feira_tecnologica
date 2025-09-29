<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if (isset($_SESSION['verificando'])) {
  unset($_SESSION['verificando']);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/home.css">
  <title>Home</title>
</head>
<body>
    <main>
        <div class="logo">
            <img src="../assets/img/etecmcm.png" alt="">
        </div>
        <div class="content-background">
          <div class="content">
              <span>Feira Tecnológica</span>
              <a class="blue-button" href="tela_mapa.php">Mapa</a>
              <a class="blue-button" href="tela_projetos.php">Projetos</a>
              <a class="blue-button" href="tela_ods.php">ODS</a>
          </div>
          <div class="content">
              <span>Utilitários</span>
              <a class="dark-purple-button" href="tela_creditos.php">Créditos</a>
              <a class="dark-purple-button" href="tela_feedback.php">Avalie-nos</a>
          </div>
          <h1 class="title-screen">Início</h1>
        </div>
    </main>
</body>
</html>