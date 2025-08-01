<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Karantina:wght@300;400;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../assets/css/home.css">
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
        <?php if(!isset($_SESSION['id'])) : ?>
          <div class="a0">
            <a href="tela_login.php">Entrar</a>
          </div>
        <?php endif; ?>
        <div class="a0">
            <?php if (isset($_SESSION['nome'])) {
              echo "Seja bem-vindo(a) " . $_SESSION['nome'] . "!";
            } ?>
            <a href="#">Mapa</a>
            <a href="#">Projetos</a>
            <a href="#">ODS</a>
            <a href="#">Créditos</a>
          </div>
        </div>
        <div class="rateOrg">
          <a href="#">Avalie-nos</a>
        </div>
      </div>
    </main>
    <div id="mySideMenu" class="side-menu">
      <a href="javascript:void(0)" class="close-btn" onclick="closeMenu()">&times;</a>
      <a href="tela_mapa.php">Mapa</a>
      <a href="tela_avaliacao.php">Avaliação</a>
      <a href="tela_projetos.php">Projetos</a>
      <a href="tela_ranking.php">Ranking</a>
      <a href="tela_cursos.php">Cursos</a>
      <a href="tela_sobreEtec.php">Sobre a Etec</a>
      <a href="tela_configuracoes.php">Configurações</a>
      <a href="" class="deslogar" id="deslogar" name="deslogar">Sair da Conta</a>
    </div>
    <script>
      document
        .getElementById("mobile-menu")
        .addEventListener("click", function () {
          this.classList.toggle("active");
          openMenu();
        });

      function openMenu() {
        document.getElementById("mySideMenu").style.width = "250px";
      }

      function closeMenu() {
        document.getElementById("mySideMenu").style.width = "0";
        document.getElementById("mobile-menu").classList.remove("active");
      }
    </script>
  </body>
</html>