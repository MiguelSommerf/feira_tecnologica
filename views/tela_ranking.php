<?php
//require_once '../back/ranking.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Karantina:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/ranking.css">
</head>
<body class="telaRanking">
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

    <main class="main-ranking">
        <div class="container-projeto">
            <div class="foto-perfil" alt="Foto de Perfil"></div>

            <div class="projetos">
                <div class="projeto-nome">Projeto nome - TI <div class="colocacao">a</div></div>
                <div class="projeto-lugar">Sala 2, Stand 5 - Bloco B</div>
            </div>
        </div>

        <div class="container-projeto">
            <div class="foto-perfil" alt="Foto de Perfil"></div>

            <div class="projetos">
                <div class="projeto-nome">Projeto nome - TI <div class="colocacao">a</div></div>
                <div class="projeto-lugar">Sala 2, Stand 5 - Bloco B</div>
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