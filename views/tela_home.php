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
        <div class="ORGmainInfo">
          <button>Mapa</button>
          <button>Projetos</button>
          <button>ODS</button>
          <button>Créditos</button>
        </div>
        <div class="rateOrg">
          <a href="">Avalie-nos</a>
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
