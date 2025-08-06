<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação dos projetos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Karantina:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/avaliacao.css">
</head>

  <body class="telaAvaliacao">
    <header style="display: flex; background-color: aqua;">
        <div class="menu-toggle" id="mobile-menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>

        <div class="logo-container">
            <img src="/assets/img/etecmcm.png" alt="Logo MCM" />
        </div>
        <div class="ORGInfoHeader">
            <h1>Avaliação</h1>
        </div>
    </header>

    <main>
    
        <div class="avaliacao-container">
    <div class="avaliacao-header">
        <img src="" alt="" class="avaliacao-logo"> <!-- Inserir Foto-->

        <div class="avaliacao-infos">
            <div class="campo">
                <input type="text" placeholder="Projeto:" readonly/>
            </div>
            <div class="campo">
                <input type="text" placeholder="Alunos:" readonly/>
            </div>
            <div class="campo">
                <input type="text" placeholder="Turma:" readonly/>
            </div>
        </div>
    </div>

    <div class="avaliacao-linha">
        <span>Apresentação</span>
        <div class="avaliacao-estrelas-container">
        <div class="avaliacao-estrelas" data-id="0"></div>
        </div>
    </div>

    <div class="avaliacao-linha">
        <span>Organização</span>
        <div class="avaliacao-estrelas-container">
        <div class="avaliacao-estrelas" data-id="1"></div>
        </div>
    </div>

    <div class="avaliacao-linha">
        <span>Banner</span>
        <div class="avaliacao-estrelas-container">
        <div class="avaliacao-estrelas" data-id="2"></div>
        </div>
    </div>

    <div class="avaliacao-linha">
        <span>Ideia do projeto</span>
        <div class="avaliacao-estrelas-container">
        <div class="avaliacao-estrelas" data-id="3"></div>
        </div>
    </div>
    </div>

    <div class="avaliacao-comentario">
    <textarea class="avaliacao-textarea" placeholder="Deixe um comentário..."></textarea>
    <button class="avaliacao-button" id="">Enviar</button>
    </div>

    </main>

    <div id="mySideMenu" class="side-menu">
      <a href="javascript:void(0)" class="close-btn" onclick="closeMenu()">&times;</a>
      <a href="#">Mapa</a>
      <a href="TelaAvaliacao.html">Avaliação</a>
      <a href="TelaProjetos.html">Projetos</a>
      <a href="TelaRanking.html">Ranking</a>
      <a href="TelaCursos.html">Cursos</a>
      <a href="TelaSobreEtec.html">Sobre a Etec</a>
      <a href="TelaConfiguracoes.html">Configurações</a>
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
      
        document.getElementById('mobile-menu').addEventListener('click', function() {
            this.classList.toggle('active');
            openMenu();
        });
        function openMenu() {
            document.getElementById('mySideMenu').style.width = '250px';
        }
        function closeMenu() {
            document.getElementById('mySideMenu').style.width = '0';
            document.getElementById('mobile-menu').classList.remove('active');
        }
        //Script da avalicao
        function criarEstrelas(container, numEstrelas = 5) {
        for (let i = 0; i < numEstrelas; i++) {
            const estrela = document.createElement("span");
            estrela.innerHTML = "★";
            estrela.classList.add("avaliacao-estrela");
            estrela.addEventListener("click", function () {
            const todasEstrelas = container.querySelectorAll(".avaliacao-estrela"); 
            todasEstrelas.forEach((s, idx) => {
                s.classList.toggle("checked", idx <= i);
            });
            });
            container.appendChild(estrela);
        }
        }
        document.querySelectorAll('.avaliacao-estrelas').forEach(containerEstrela => {
        criarEstrelas(containerEstrela);
        });
    </script>
</body>
</html>
