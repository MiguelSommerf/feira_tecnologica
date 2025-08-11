<?php
require_once '../config/connect.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
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
  <link rel="stylesheet" href="../assets/css/locais.css">
    <script type="text/javascript" src="https://cdn.rybena.com.br/dom/master/latest/rybena.js"></script>
  <title>Locais</title>
</head>
<body class="telaLocais">
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
      <h1>Locais</h1>
    </div>
    <button class="btn-voltar" onclick="history.back()">Voltar</button>
  </header>

  <div id="mySideMenu" class="side-menu">
    <a href="javascript:void(0)" class="close-btn" onclick="closeMenu()">&times;</a>
    <a href="tela_mapa.php">Mapa</a>
    <a href="tela_avaliacao.php">Avaliação</a>
    <a href="tela_projetos.php">Projetos</a>
    <a href="tela_ranking.php">Ranking</a>
    <a href="tela_cursos.php">Cursos</a>
    <a href="tela_sobreEtec.php">Sobre a Etec</a>
    <a href="tela_acessibilidade.php">Acessibilidade</a>
      <?php if(isset($_SESSION['id'])): ?>
      <a href="../back/logout.php" class="deslogar" id="deslogar" name="deslogar">Sair da Conta</a>
      <?php endif; ?>
  </div>

  <div id="conteudo" style="text-align: center;"></div>

  <script>
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

    const historico = [];

    function mostrarPagina(pagina) {
  const areaConteudo = document.getElementById('conteudo');
  const dado = dados[pagina];

  areaConteudo.innerHTML = "";

  if (dado.opcoes) {
    dado.opcoes.forEach(opcao => {
      const botao = document.createElement("button");
      botao.className = "btnLocal";
      botao.textContent = opcao.nome;
      botao.onclick = () => {
        if (opcao.proximo && dados[opcao.proximo]) {
          historico.push(pagina);
          mostrarPagina(opcao.proximo);
        } else {
          alert("Conteúdo ainda não disponível.");
        }
      };
      areaConteudo.appendChild(botao);
      areaConteudo.appendChild(document.createElement("br"));
    });
  }

  if (historico.length > 0) {
    const btnVoltar = document.createElement("button");
    btnVoltar.className = "btnLocal";
    btnVoltar.textContent = "Voltar";
    btnVoltar.onclick = () => {
      const anterior = historico.pop();
      mostrarPagina(anterior);
    };
    areaConteudo.appendChild(btnVoltar);
  }
}

    const dados = {
      locais: {
        opcoes: [
          { nome: "Bloco A", proximo: "blocoA" },
          { nome: "Bloco B", proximo: "blocoB" },
          { nome: "Biblioteca", proximo: "biblioteca" },
          { nome: "Auditório", proximo: "auditorio" },
          { nome: "Quadra", proximo: "quadra" },
        ]
      },
      blocoA: {
        opcoes: [
          { nome: "Sala 1", proximo: "sala1A" },
          { nome: "Sala 2", proximo: "sala2A" },
          { nome: "Sala 3", proximo: "sala3A" },
          { nome: "Sala 4", proximo: "sala4A" },
          { nome: "Sala 5", proximo: "sala5A" },
          { nome: "Sala 6", proximo: "sala6A" },
          { nome: "Sala 7", proximo: "sala7A" },
          { nome: "Sala 8", proximo: "sala8A" },
        ]
      },
      sala1A: {
        opcoes: [
          { nome: "Projeto 1", id: "Projeto1" },
          { nome: "Projeto 2", id: "Projeto2" },
          { nome: "Projeto 3", id: "Projeto3" },
          { nome: "Projeto 4", id: "Projeto4" },
          { nome: "Projeto 5", id: "Projeto5" },
          { nome: "Projeto 6", id: "Projeto6" },
          { nome: "Projeto 7", id: "Projeto7" },
          { nome: "Projeto 8", id: "Projeto8" },
        ]
      },
      sala2A: {
        opcoes: [
          { nome: "Projeto 1", id: "Projeto1" },
          { nome: "Projeto 2", id: "Projeto2" },
          { nome: "Projeto 3", id: "Projeto3" },
          { nome: "Projeto 4", id: "Projeto4" },
          { nome: "Projeto 5", id: "Projeto5" },
          { nome: "Projeto 6", id: "Projeto6" },
          { nome: "Projeto 7", id: "Projeto7" },
          { nome: "Projeto 8", id: "Projeto8" },
        ]
      },
      sala3A: {
        opcoes: [
          { nome: "Projeto 1", id: "Projeto1" },
          { nome: "Projeto 2", id: "Projeto2" },
          { nome: "Projeto 3", id: "Projeto3" },
          { nome: "Projeto 4", id: "Projeto4" },
          { nome: "Projeto 5", id: "Projeto5" },
          { nome: "Projeto 6", id: "Projeto6" },
          { nome: "Projeto 7", id: "Projeto7" },
          { nome: "Projeto 8", id: "Projeto8" },
        ]
      },
      sala4A: {
        opcoes: [
          { nome: "Projeto 1", id: "Projeto1" },
          { nome: "Projeto 2", id: "Projeto2" },
          { nome: "Projeto 3", id: "Projeto3" },
          { nome: "Projeto 4", id: "Projeto4" },
          { nome: "Projeto 5", id: "Projeto5" },
          { nome: "Projeto 6", id: "Projeto6" },
          { nome: "Projeto 7", id: "Projeto7" },
          { nome: "Projeto 8", id: "Projeto8" },
        ]
      },
      sala5A: {
        opcoes: [
          { nome: "Projeto 1", id: "Projeto1" },
          { nome: "Projeto 2", id: "Projeto2" },
          { nome: "Projeto 3", id: "Projeto3" },
          { nome: "Projeto 4", id: "Projeto4" },
          { nome: "Projeto 5", id: "Projeto5" },
          { nome: "Projeto 6", id: "Projeto6" },
          { nome: "Projeto 7", id: "Projeto7" },
          { nome: "Projeto 8", id: "Projeto8" },
        ]
      },
      sala6A: {
        opcoes: [
          { nome: "Projeto 1", id: "Projeto1" },
          { nome: "Projeto 2", id: "Projeto2" },
          { nome: "Projeto 3", id: "Projeto3" },
          { nome: "Projeto 4", id: "Projeto4" },
          { nome: "Projeto 5", id: "Projeto5" },
          { nome: "Projeto 6", id: "Projeto6" },
          { nome: "Projeto 7", id: "Projeto7" },
          { nome: "Projeto 8", id: "Projeto8" },
        ]
      },
      sala7A: {
        opcoes: [
          { nome: "Projeto 1", id: "Projeto1" },
          { nome: "Projeto 2", id: "Projeto2" },
          { nome: "Projeto 3", id: "Projeto3" },
          { nome: "Projeto 4", id: "Projeto4" },
          { nome: "Projeto 5", id: "Projeto5" },
          { nome: "Projeto 6", id: "Projeto6" },
          { nome: "Projeto 7", id: "Projeto7" },
          { nome: "Projeto 8", id: "Projeto8" },
        ]
      },
      sala8A: {
        opcoes: [
          { nome: "Projeto 1", id: "Projeto1" },
          { nome: "Projeto 2", id: "Projeto2" },
          { nome: "Projeto 3", id: "Projeto3" },
          { nome: "Projeto 4", id: "Projeto4" },
          { nome: "Projeto 5", id: "Projeto5" },
          { nome: "Projeto 6", id: "Projeto6" },
          { nome: "Projeto 7", id: "Projeto7" },
          { nome: "Projeto 8", id: "Projeto8" },
        ]
      },
      blocoB: {
        opcoes: [
          { nome: "Sala 1", proximo: "sala1B" },
          { nome: "Sala 2", proximo: "sala2B" },
          { nome: "Sala 3", proximo: "sala3B" },
          { nome: "Sala 4", proximo: "sala4B" },
          { nome: "Sala 5", proximo: "sala5B" },
        ]
      },
      sala1B: {
        opcoes: [
          { nome: "Projeto 1", id: "Projeto1" },
          { nome: "Projeto 2", id: "Projeto2" },
          { nome: "Projeto 3", id: "Projeto3" },
          { nome: "Projeto 4", id: "Projeto4" },
          { nome: "Projeto 5", id: "Projeto5" },
          { nome: "Projeto 6", id: "Projeto6" },
          { nome: "Projeto 7", id: "Projeto7" },
          { nome: "Projeto 8", id: "Projeto8" },
        ]
      },
      sala2B: {
        opcoes: [
          { nome: "Projeto 1", id: "Projeto1" },
          { nome: "Projeto 2", id: "Projeto2" },
          { nome: "Projeto 3", id: "Projeto3" },
          { nome: "Projeto 4", id: "Projeto4" },
          { nome: "Projeto 5", id: "Projeto5" },
          { nome: "Projeto 6", id: "Projeto6" },
          { nome: "Projeto 7", id: "Projeto7" },
          { nome: "Projeto 8", id: "Projeto8" },
        ]
      },
      sala3B: {
        opcoes: [
          { nome: "Projeto 1", id: "Projeto1" },
          { nome: "Projeto 2", id: "Projeto2" },
          { nome: "Projeto 3", id: "Projeto3" },
          { nome: "Projeto 4", id: "Projeto4" },
          { nome: "Projeto 5", id: "Projeto5" },
          { nome: "Projeto 6", id: "Projeto6" },
          { nome: "Projeto 7", id: "Projeto7" },
          { nome: "Projeto 8", id: "Projeto8" },
        ]
      },
      sala4B: {
        opcoes: [
          { nome: "Projeto 1", id: "Projeto1" },
          { nome: "Projeto 2", id: "Projeto2" },
          { nome: "Projeto 3", id: "Projeto3" },
          { nome: "Projeto 4", id: "Projeto4" },
          { nome: "Projeto 5", id: "Projeto5" },
          { nome: "Projeto 6", id: "Projeto6" },
          { nome: "Projeto 7", id: "Projeto7" },
          { nome: "Projeto 8", id: "Projeto8" },
        ]
      },
      sala5B: {
        opcoes: [
          { nome: "Projeto 1", id: "Projeto1" },
          { nome: "Projeto 2", id: "Projeto2" },
          { nome: "Projeto 3", id: "Projeto3" },
          { nome: "Projeto 4", id: "Projeto4" },
          { nome: "Projeto 5", id: "Projeto5" },
          { nome: "Projeto 6", id: "Projeto6" },
          { nome: "Projeto 7", id: "Projeto7" },
          { nome: "Projeto 8", id: "Projeto8" },
        ]
      },
      biblioteca: {
        opcoes: [
          { nome: "Projeto 1", id: "Projeto1" },
          { nome: "Projeto 2", id: "Projeto2" },
          { nome: "Projeto 3", id: "Projeto3" },
          { nome: "Projeto 4", id: "Projeto4" },
        ]
      },
      auditorio: {
        opcoes: [
          { nome: "palestra 1", id: "palestra1" },
          { nome: "palestra 2", id: "palestra2" },
          { nome: "palestra 3", id: "palestra3" },
          { nome: "palestra 4", id: "palestra4" },
          { nome: "palestra 5", id: "palestra5" },
          { nome: "palestra 6", id: "palestra6" },
          { nome: "palestra 7", id: "palestra7" },
          { nome: "palestra 8", id: "palestra8" },
        ]
      },
      quadra: {
        opcoes:[
          { nome: "Projeto 1", id: "Projeto1" },
          { nome: "Projeto 2", id: "Projeto2" },
          { nome: "Projeto 3", id: "Projeto3" },
          { nome: "Projeto 4", id: "Projeto4" },
          { nome: "Projeto 5", id: "Projeto5" },
          { nome: "Projeto 6", id: "Projeto6" },
          { nome: "Projeto 7", id: "Projeto7" },
          { nome: "Projeto 8", id: "Projeto8" },
        ]
      }
    };

    mostrarPagina("locais");
  </script>
</body>
</html>
