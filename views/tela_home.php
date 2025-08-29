<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if (isset($_SESSION['verificando'])) {
  unset($_SESSION['verificando']);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Grenze:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/home.css">
  <script type="text/javascript" src="https://cdn.rybena.com.br/dom/master/latest/rybena.js"></script>
  <title>Feira - Inicio</title>
</head>
<body class="TelaInicio">
  <header>
    <div class="menu-toggle" id="mobile-menu">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </div>
    <div class="logo-container">
      <img src="../assets/img/etecmcm.png" alt="Logo MCM"/>
    </div>
    <div class="ORGInfoHeader">
      <h1>Inicio</h1>
    </div>
  </header>
  <main>
    <div>
      <div class="a0">
        <?php if (isset($_SESSION['nome'])) {
          echo "Seja bem-vindo(a) " . $_SESSION['nome'] . "!";
        } ?>
        <a href="tela_mapa.php">Mapa</a>
        <a href="tela_projetos.php">Projetos</a>
        <a href="tela_ods.php">ODS</a>
        <a href="tela_creditos.php">Créditos</a>
        <a href="tela_feedback.php">Avalie-nos</a>
      </div>
    </div>
  </main>

  <div id="mySideMenu" class="side-menu">
    <a href="javascript:void(0)" id="close-btn" class="close-btn"">&times;</a>
    <a href="../index.php">Início</a>
    <?php if (!empty($_SESSION['admin'])): ?>
    <a href="../admin/views/home.php">Admin</a>
    <?php endif; ?>
    <a href="tela_mapa.php">Mapa</a>
    <a href="tela_projetos.php">Projetos</a>
    <a href="tela_ranking.php">Ranking</a>
    <a href="tela_cursos.php">Cursos</a>
    <a href="tela_sobreEtec.php">Sobre a Etec</a>
    <?php if(isset($_SESSION['id'])): ?>
    <a href="../back/logout.php" class="deslogar" id="deslogar" name="deslogar">Sair da Conta</a>
    <?php endif; ?>
  </div>
  <script src="../assets/js/menuLateral.js"></script>
</body>
</html>