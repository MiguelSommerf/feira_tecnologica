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
    <title>Cursos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Grenze:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script type="text/javascript" src="https://cdn.rybena.com.br/dom/master/latest/rybena.js"></script>
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
    </header>
    <main>
        <button class="btn-voltar" onclick="window.location.href = '../views/tela_home.php'">Voltar</button>
        <!-- Página Cursos -->
        <div class="card-curso-holder">
            <div class="card-curso-header">
                <h2>Manhã Ensino Médio com Técnico</h2>
            </div>
            <div class="card-curso-content">
                <div class="card-curso-list">
                    <p>Curso de Administração</p>
                    <a href="https://etecmcm.cps.sp.gov.br/etim-administracao/">Ver mais</a>
                </div>
                <div class="card-curso-list">
                    <p>Curso de Recursos Humanos</p>
                    <a href="https://etecmcm.cps.sp.gov.br/mtec-recursos-humanos/">Ver mais</a>
                </div>
                <div class="card-curso-list">
                    <p>Curso de Informática Para Internet</p>
                    <a href="https://etecmcm.cps.sp.gov.br/informatica-para-internet/">Ver mais</a>
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
                    <a href="https://etecmcm.cps.sp.gov.br/informatica-para-internet/">Ver mais</a>
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
                    <a href="https://etecmcm.cps.sp.gov.br/quimica-noite/">Ver mais</a>
                </div>
                <div class="card-curso-list">
                    <p>Curso de Recursos Humanos</p>
                    <a href="https://etecmcm.cps.sp.gov.br/recursos-humanos-noite-2/">Ver mais</a>
                </div>
                <div class="card-curso-list">
                    <p>Curso de Losgística</p>
                    <a href="https://etecmcm.cps.sp.gov.br/logistica-noite/">Ver mais</a>
                </div>
                <div class="card-curso-list">
                    <p>Curso de Administração</p>
                    <a href="https://etecmcm.cps.sp.gov.br/administracao-noite/">Ver mais</a>
                </div>
            </div>
        </div>
    </main>
    <div id="mySideMenu" class="side-menu">
        <a href="javascript:void(0)" id="close-btn" class="close-btn">&times;</a>
        <a href="../index.php">Início</a>
        <?php if (!empty($_SESSION['admin'])): ?>
        <a href="../admin/views/home.php">Admin</a>
        <?php endif; ?>
        <a href="tela_mapa.php">Mapa</a>
        <a href="tela_projetos.php">Projetos</a>
        <a href="tela_ranking.php">Ranking</a>
        <a href="tela_cursos.php">Cursos</a>
        <a href="tela_sobreEtec.php">Sobre a Etec</a>
        <?php if(isset($_SESSION['id'])): ?>
        <a href="../back/logout.php" class="deslogar" id="deslogar" name="deslogar">Sair da Conta</a>
        <?php endif; ?>
    </div>
    <script>
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
    <script src="../assets/js/menuLateral.js"></script>
</body>
</html>