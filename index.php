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
          <div class="content">
              <span>Usuário</span>
              <a class="blue-button" href="">Entrar sem conta</a>
              <a class="blue-button" href="">Entrar</a>
          </div>
          <div class="content">
              <span>Informativos</span>
              <a class="light-purple-button" href="">Etec MCM</a>
              <a class="light-purple-button" href="">Vestibulinho</a>
          </div>
          <div class="content">
              <span>Utilitários</span>
              <a class="dark-blue-button" href="">Créditos</a>
          </div>
      </div>
    </main>
</body>
</html>