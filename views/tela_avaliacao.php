<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Padronização</title>
    <<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Grenze:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script type="text/javascript" src="https://cdn.rybena.com.br/dom/master/latest/rybena.js"></script>
    <link rel="stylesheet" href="../assets/css/acessibilidade.css">

</head>
<body>
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
            <h1 class="h1-ranking">Inicio</h1>
        </div>
        <button class="btn-voltar" onclick="history.back()">Voltar</button>
    </header>

  <main>
    <!-- Página Configurações -->
    <div id="paginaConfiguracoes">
      <div class="config-box">
        <label for="textSize">Tamanho do Texto</label>
        <div class="slider-container">
          <span id="textSizeValue">15</span>
          <input type="range" id="textSize" min="10" max="30" value="15" />
        </div>
      </div>

      <div class="config-box">
        <label for="colorBlind">Daltonismo</label>
        <select id="colorBlind">
          <option value="nenhum">Nenhum</option>
          <option value="protanopia">Protanopia</option>
          <option value="deuteranopia">Deuteranopia</option>
          <option value="tritanopia">Tritanopia</option>
        </select>
      </div>

      <div class="libras-option">
        <span>Libras</span>
        <input type="checkbox" id="librasToggle" />
      </div>
    </div>


    <!-- Fim página Configurações -->

  </main>

  <div id="mySideMenu" class="side-menu">
      <a href="javascript:void(0)" class="close-btn" onclick="closeMenu()">&times;</a>
      <a href="tela_mapa.php">Mapa</a>
      <a href="tela_avaliacao.php">Avaliação</a>
      <a href="tela_projetos.php">Projetos</a>
      <a href="tela_ranking.php">Ranking</a>
      <a href="tela_cursos.php">Cursos</a>
      <a href="tela_sobreEtec.php">Sobre a Etec</a>
      <a href="tela_configuracoes.php">Acessibilidade</a>
      <?php if(isset($_SESSION['id'])): ?>
      <a href="../back/logout.php" class="deslogar" id="deslogar" name="deslogar">Sair da Conta</a>
      <?php endif; ?>
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

/* === JS CONFIGURAÇÕES === */
const textSizeSlider = document.getElementById('textSize');
const textSizeValue = document.getElementById('textSizeValue');
const colorBlindSelect = document.getElementById('colorBlind');
const librasToggle = document.getElementById('librasToggle');

function aplicarLibras(ativo) {
  if (ativo) {
    console.log('Libras ativado');
  } else {
    console.log('Libras desativado');
  }
}

function aplicarConfiguracoes() {
  const savedTextSize = localStorage.getItem('textSize') || '18';
  const savedColorBlind = localStorage.getItem('colorBlind') || 'nenhum';
  const savedLibras = localStorage.getItem('libras') === 'true';

  textSizeSlider.value = savedTextSize;
  textSizeValue.textContent = savedTextSize;
  document.documentElement.style.fontSize = `${savedTextSize}px`;

  colorBlindSelect.value = savedColorBlind;
  applyColorBlindFilter(savedColorBlind);

  librasToggle.checked = savedLibras;
  aplicarLibras(savedLibras);
}

// Salva e aplica tamanho do texto
textSizeSlider.addEventListener('input', () => {
  const value = textSizeSlider.value;
  textSizeValue.textContent = value;
  document.getElementById('paginaConfiguracoes').style.fontSize = `${value}px`;
  document.body.style.fontSize = `${value}px`;
  localStorage.setItem('textSize', value);
});

// Salva e aplica filtro de cor
colorBlindSelect.addEventListener('change', () => {
  const value = colorBlindSelect.value;
  applyColorBlindFilter(value);
  localStorage.setItem('colorBlind', value);
});

// Salva e aplica Libras
librasToggle.addEventListener('change', () => {
  const ativo = librasToggle.checked;
  aplicarLibras(ativo);
  localStorage.setItem('libras', ativo);
});

function applyColorBlindFilter(type) {
  const elementoPrincipal = document.documentElement;
  const listaCursos = document.querySelectorAll('#paginaCursos li');

  let bgColor = '#000000'; // default
  let fgColor = '#FFFFFF'; // default

  switch (type) {
    case 'protanopia':
      elementoPrincipal.style.filter = 'grayscale(100%) contrast(1.2)';
      bgColor = '#2E2E2E'; 
      break;
    case 'deuteranopia':
      elementoPrincipal.style.filter = 'sepia(100%) saturate(3)';
      bgColor = '#3A3A3A';
      break;
    case 'tritanopia':
      elementoPrincipal.style.filter = 'hue-rotate(90deg)';
      bgColor = '#333333';
      break;
    default:
      elementoPrincipal.style.filter = 'none';
      bgColor = '#000000';
  }

  listaCursos.forEach(li => {
    li.style.backgroundColor = bgColor;
    li.style.color = fgColor;
  });
}

window.onload = aplicarConfiguracoes;

// Função que oculta todas as páginas
function esconderTodasAsPaginas() {

  document.getElementById('paginaConfiguracoes').style.display = 'none';
}

// Adiciona eventos de clique aos links
document.getElementById('linkConfiguracoes').addEventListener('click', () => {
  esconderTodasAsPaginas();
  document.getElementById('paginaConfiguracoes').style.display = 'block';
  closeMenu(); // fecha o menu lateral
});

  </script>
</body>
</html>
