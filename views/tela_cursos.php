<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Padronização</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Karantina:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/cursos.css">
    <link rel="stylesheet" href="../assets/css/configuracoes.css">
</head>
<style>

:root {
    /* INÍCIO ROOT TITULO */
      --FONTTitulo: Karantina;
      --FONTTituloSIZE: 20px;
      --FONTBTNSMenu: arial;
      --COLORBTNSMenu: black;
      --BACKGROUNDCOLORBTNSMenu: rgba(255, 255, 255, 0.5);
    /* FIM ROOT TITULO */

    /* INÍCIO ROOT BUTTON NEON */
      --glow-color: rgb(255, 255, 255);
      --glow-spread-color: rgb(255, 255, 255);
      --enhanced-glow-color: rgb(255, 255, 255);
      --btn-color: rgb(0, 0, 0);
    /* FIM ROOT BUTTON NEON */
  }

  * {
    padding: 0;
    margin: 0;
  }

  /* HEADER BASE */
  header {
    padding: 5px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  h1 {
    font-family: var(--FONTTitulo);
    font-size: var(--FONTTituloSIZE);
  }
/*  ==========================================================
                            FIM ROOT 
    ==========================================================*/

/*  ==========================================================
                       INÍCIO CSS NAV BAR
    ==========================================================*/
    .menu-toggle {
      display: flex;
      flex-direction: column;
      width: 30px;
      padding: 10px;
      cursor: pointer;
      transition: transform 0.5s;
    }
    .bar {
      height: 3px;
      width: 100%;
      background-color: #000;
      margin: 4px 0;
      border-radius: 15px;
      transition: transform 0.5s, opacity 0.5s;
    }
    .menu-toggle.active .bar:nth-child(1) {
      transform: translateY(8px) rotate(45deg);
    }
    .menu-toggle.active .bar:nth-child(2) {
      opacity: 0;
    }
    .menu-toggle.active .bar:nth-child(3) {
      transform: translateY(-8px) rotate(-45deg);
    }
    .side-menu {
      height: 100%;
      width: 0;
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0;
      background-color: #111;
      overflow-x: hidden;
      transition: width 0.5s;
      padding-top: 60px;
    }
    .side-menu a {
      padding: 8px 8px 8px 32px;
      text-decoration: none;
      font-size: 25px;
      color: #818181;
      display: block;
      transition: all 0.3s ease;
    }
    .side-menu a:hover {
      color: #f1f1f1;
      background-color: #444;
    }
    .side-menu .close-btn {
      position: absolute;
      top: 0;
      right: 25px;
      font-size: 36px;
    }

    ::-webkit-scrollbar {
      display: none;
    }

    #BTNMenu {
      display: none;
    }

    #Menu {
      border-radius: 4px;
      width: fit-content;
      border: 2px solid transparent;
      position: fixed;
      left: 10px;
    }

    input[type="checkbox"]#BTNMenu:checked ~ #Menu {
      box-shadow: 0 0 4px white, inset 0 0 4px white;
      background-color: rgba(255, 255, 255, 0.5);
      border: 2px solid white;
    }

    input[type="checkbox"]#BTNMenu:not(:checked) ~ div ul#MenuHolder {
      display: none;
    }

    ul#MenuHolder li.BTNSMenu a {
      appearance: auto;
      text-decoration: none;
      color: var(--COLORBTNSMenu);
      font-family: var(--FONTBTNSMenu);
      padding: 10px 20px;
      background-color: var(--BACKGROUNDCOLORBTNSMenu);
      box-shadow: inset 0 0 4px white;
    }

    ul#MenuHolder li.BTNSMenu {
      list-style: none;
    }

    ul#MenuHolder {
      display: flex;
      flex-direction: column;
      gap: 2px;
    }

   
    .logo-container {
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .logo-container img {
      width: 50px;
      height: auto;
    }
    .ORGInfoHeader {
      display: flex;
      width: 50%;
      gap: 50%;
      justify-content: flex-end;
    }

    header{
        display: flex;
        align-items: center;
    }



/* Estilo de fundo que o body terá no Tablet */
@media (min-width: 768px) {
      body.telaRanking {
        background-image: url(../img/inicio.jpg);
        background-repeat: no-repeat;
        background-size: cover;
      }
    }

    @media (min-width: 375px) and (max-width: 768px) {
      body.telaRanking {
        background-image: url(../img/inicio.jpg);
        background-repeat: no-repeat;
        background-size: cover;
      }
    }

    @media (max-width: 375px) {
      body.telaRanking {
        background-image: url(../img/inicio.jpg);
        background-repeat: no-repeat;
        background-size: cover;
      }
    } 


    body{
        background-color: aquamarine;
    }

    main {
    display: flex;
    flex-direction: column;
    height: 100vh;
    padding-top: 20px;
    align-items: center;
    gap: 20px;
}
  </style>
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
    </header>

  <main>
    <!-- Página Cursos -->
    <div id="paginaCursos" style="display:none">
      <div class="container">
        <div class="cursos">
          <br /><br />
          <section class="manha">
            <div>
              <h2>Manhã: Ensino Médio com Técnico</h2>
            </div>
            <div class="manhaa">
              <ul>
                <li>Curso de Administração <a href="">Ver mais</a></li>
                <li>Curso de Recursos Humanos <a href="">Ver mais</a></li>
                <li>Curso de Informática Para Internet <a href="">Ver mais</a></li>
              </ul>
            </div>
          </section>

          <section class="tarde">
            <div>
              <h2>Tarde: Ensino Médio com Técnico</h2>
            </div>
            <div class="tardea">
              <ul>
                <li>Curso de Química <a href="">Ver mais</a></li>
                <li>Curso de Informática Para Internet <a href="">Ver mais</a></li>
              </ul>
            </div>
          </section>

          <section class="noite">
            <div>
              <h2>Noite: Só Técnico</h2>
            </div>
            <div class="noitea">
              <ul>
                <li>Curso de Química <a href="">Ver mais</a></li>
                <li>Curso de Contabilidade <a href="">Ver mais</a></li>
                <li>Curso de Logística <a href="">Ver mais</a></li>
                <li>Curso de Administração <a href="">Ver mais</a></li>
              </ul>
            </div>
          </section>
        </div>
      </div>
    </div>

    <!-- Página Configurações -->
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
  document.getElementById('paginaCursos').style.display = 'none';
  document.getElementById('paginaConfiguracoes').style.display = 'none';
}

// Adiciona eventos de clique aos links
document.getElementById('linkCursos').addEventListener('click', () => {
  esconderTodasAsPaginas();
  document.getElementById('paginaCursos').style.display = 'block';
  closeMenu(); // fecha o menu lateral

  
});

document.getElementById('linkConfiguracoes').addEventListener('click', () => {
  esconderTodasAsPaginas();
  document.getElementById('paginaConfiguracoes').style.display = 'block';
  closeMenu(); // fecha o menu lateral
});

  </script>
</body>
</html>