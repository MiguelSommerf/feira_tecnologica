<?php 
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === 0) {
  unset($_SESSION['is_admin']);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Grenze:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <title>Início</title>
  <link rel="stylesheet" href="assets/css/index.css">
</head>
<body class="TelaInicio">
  <header>
    <div id="mobile-menu">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </div>
    <div class="logo-container">
      <img src="assets/img/etecmcm.png" alt="Logo MCM"/>
    </div>
    <div class="ORGInfoHeader">
      <h1>Inicio</h1>
    </div>
  </header>
  <main>
    <div>
      <div class="ORGmainInfo">
        <?php if (isset($_SESSION['is_admin'])): ?>
         <p class="info">Admin</p>
         <div class="a0">
          <a href="admin/index.php">Admin</a>
         </div> 
        <?php endif;?>
        <?php if (isset($_SESSION['id'])): ?>
        <p class="info">Usuário</p>
        <div class="a0">
          <a href="views/tela_home.php">Home</a>
        </div>
        <?php else: ?>
        <p class="info">Usuário</p>
        <div class="a0">
          <a href="views/tela_home.php">Entrar sem conta</a>
          <a href="views/tela_login.php">Entrar</a>
        </div>
        <?php endif; ?>
      </div>
      <div class="ORGmainInfo">
        <p class="info">Informativo</p>
        <div class="a0">
          <a href="https://etecmcm.cps.sp.gov.br/" target="blank">Etec - MCM</a>
          <a href="https://www.etecmcm.com.br/vestibulinho" target="blank">Vestibulinho</a>
        </div>
      </div>
    </div>
  </main>
</body>
</html>