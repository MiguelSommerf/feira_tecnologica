<?php
require_once 'back/classes/Logout.php';

$logout = new Logout();
$logout->logout();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Karantina:wght@300;400;700&display=swap"
      rel="stylesheet"
    />
    <title>Início</title>

    <link rel="stylesheet" href="assets/css/index.css">
</head>
<body class="TelaInicio">

    <header>
      <div class="menu-toggle" id="mobile-menu">
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
          <p class="info">Usuário</p>
          <button>Entrar sem conta</button>
          <button>Entrar</button>
        </div>
        <div class="ORGmainInfo">
          <p class="info">Informativo</p>
          <button>Etec - MCM</button>
          <button>Vestibulinho</button>
        </div>
        <div class="ORGmainInfo">
          <p class="info">Utilitários</p>
          <button>Acessibilidade</button>
          <button>Créditos</button>
        </div>
      </div>
    </main>

    <div id="mySideMenu" class="side-menu">
      <a href="javascript:void(0)" class="close-btn" onclick="closeMenu()">&times;</a>
      <a href="#">Mapa</a>
      <a href="#">Avaliação</a>
      <a href="#">Projetos</a>
      <a href="#">Ranking</a>
      <a href="#">Cursos</a>
      <a href="#">Sobre a Etec</a>
      <a href="#">Configurações</a>
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