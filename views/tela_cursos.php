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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Karantina:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/cursos.css">
</head>
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
    <!-- Página Cursos -->
    <div class="card-curso-holder">
        <div class="card-curso-header">
            <h2>Manhã Ensino Médio com Técnico</h2>
        </div>
        <div class="card-curso-content">
            <div class="card-curso-list">
                <p>Curso de Administração</p>
                <a href="">Ver mais</a>
            </div>
            <div class="card-curso-list">
                <p>Curso de Recursos Humanos</p>
                <a href="">Ver mais</a>
            </div>
            <div class="card-curso-list">
                <p>Curso de Informática Para Internet</p>
                <a href="">Ver mais</a>
            </div>
        </div>
    </div>
    <div class="card-curso-holder">
        <div class="card-curso-header">
            <h2>Tarde Ensino Médio com Técnico</h2>
        </div>
        <div class="card-curso-content">
            <div class="card-curso-list">
                <p>Curso de Química</p>
                <a href="">Ver mais</a>
            </div>
            <div class="card-curso-list">
                <p>Curso de Informática Para Internet</p>
                <a href="">Ver mais</a>
            </div>
        </div>
    </div>
    <div class="card-curso-holder">
        <div class="card-curso-header">
            <h2>Noite Apenas Técnico</h2>
        </div>
        <div class="card-curso-content">
            <div class="card-curso-list">
                <p>Curso de Química</p>
                <a href="">Ver mais</a>
            </div>
            <div class="card-curso-list">
                <p>Curso de Contabilidade</p>
                <a href="">Ver mais</a>
            </div>
            <div class="card-curso-list">
                <p>Curso de Logística</p>
                <a href="">Ver mais</a>
            </div>
            <div class="card-curso-list">
                <p>Curso de Administração</p>
                <a href="">Ver mais</a>
            </div>
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
      <a href="tela_acessibilidade.php">Acessibilidade</a>
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
