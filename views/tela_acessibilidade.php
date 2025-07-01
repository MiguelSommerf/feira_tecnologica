<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Karantina:wght@300;400;700&display=swap"
      rel="stylesheet"
    />
    <title>Configurações</title>
    <link rel="stylesheet" href="/css/Config_Cursos.css">
</head>
<body>
    <!-- ==========================================================
                    INÍCIO NAV BAR (PÁGINA CONFIGURAÇÕES)
         ========================================================== -->
    <header>
        <div class="menu-toggle" id="mobile-menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
        <div class="logo-container">
            <img src="/img/etecmcm.png" alt="Logo MCM"/>
        </div>
        <div class="ORGInfoHeader">
            <h1>Inicio</h1>
        </div>
    </header>
    <!-- ==========================================================
                        FIM NAV BAR (PÁGINA CONFIGURAÇÕES)
         ========================================================== -->

    <!-- ==========================================================
                INÍCIO CONFIGURAÇÕES (PÁGINA CONFIGURAÇÕES)
         ========================================================== -->
    <main>
        <div id="paginaConfiguracoes" style="display:none">
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
    </main>
    <!-- ==========================================================
                    FIM CONFIGURAÇÕES (PÁGINA CONFIGURAÇÕES)
         ========================================================== -->

    <!-- ==========================================================
                    INÍCIO MENU (PÁGINA CONFIGURAÇÕES)
         ========================================================== -->
    <div id="mySideMenu" class="side-menu">
        <a href="javascript:void(0)" class="close-btn" onclick="closeMenu()">&times;</a>
        <a href="#">Mapa</a>
        <a href="#">Avaliação</a>
        <a href="#">Projetos</a>
        <a href="#">Ranking</a>
        <a href="#" onclick="mostrarPagina('paginaCursos')">Cursos</a>
        <a href="#">Sobre a Etec</a>
        <a href="#" onclick="mostrarPagina('paginaConfiguracoes')">Configurações</a>
    </div>
    <!-- ==========================================================
                    FIM MENU (PÁGINA CONFIGURAÇÕES)
         ========================================================== -->

<script>
    const mobileMenu = document.getElementById("mobile-menu");
    mobileMenu.addEventListener("click", function () {
      this.classList.toggle("active");
      openMenu();
    });

    function openMenu() {
      document.getElementById("mySideMenu").style.width = "250px";
    }

    function closeMenu() {
      document.getElementById("mySideMenu").style.width = "0";
      mobileMenu.classList.remove("active");
    }

    function mostrarPagina(id) {
      document.getElementById("paginaCursos").style.display = "none";
      document.getElementById("paginaConfiguracoes").style.display = "none";
      document.getElementById(id).style.display = "block";
      closeMenu();
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
  document.documentElement.style.fontSize = `${value}px`;

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
  const elementoPrincipal = document.body;
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

  </script>
</body>
</html>