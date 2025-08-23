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
    <title>Layout de Equipes</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Grenze:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script type="text/javascript" src="https://cdn.rybena.com.br/dom/master/latest/rybena.js"></script>
    <link rel="stylesheet" href="../assets/css/creditos.css">
</head>
<body class="Creditos_body">
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
            <h1 class="h1-Creditos">Creditos</h1>
        </div>
    </header>

    <main style="padding: 0">
    <button class="btn-voltar" onclick="history.back()">Voltar</button>
        <div class="container">
            <!-- Back-end -->
            <div class="sep-cat-cred"><p class="titulo">Back-end</p></div>
            <div class="cartoes">
                <?php
                    $dados = [
                        ["Ângelo Gabriel", "../assets/img/Perfil.jpeg", "Team leader - Back", null, "https://github.com/projAngeloAraujo"],
                        ["Enzo Móbile", "../assets/img/Back/enzo.jpeg", "Programador - Back", null, "https://github.com/enzomobile"],
                        ["Guilherme Solon", "../assets/img/Back/Guilherme Solon.jpeg", "Programador - Back", "https://www.linkedin.com/in/guilherme-solon-691289369?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=ios_app ", "https://github.com/Solonguitec"],
                        ["Gustavo da Rocha", "../assets/img/Perfil.jpeg", "Programador - Back", null, "https://github.com/gustapinheiro"],
                        ["Gustavo Rangel", "../assets/img/Back/Gustavo Rangel.jpeg", "Programador - Back","https://www.linkedin.com/in/gustavo-rangel-b9ba18357?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app ", "https://github.com/DEVRangelll"],
                        ["Iuri Carati", "../assets/img/Perfil.jpeg", "Programador - Back", null, "https://github.com/ToxicDumpster"],
                        ["Jean Marcos", "../assets/img/Back/Jean.jpeg", "Programador - Back", null, "https://github.com/jean666"],
                        ["Júlia Medeiros", "../assets/img/Perfil.jpeg", "Programadora - Back", null, "https://github.com/jumedeirost"],
                        ["Matheus Pereira", "../assets/img/Back/Matheus.jpeg", "Programador - Back", null, "https://github.com/MatheusSontos"],
                        ["Miguel Sommerfeld", "../assets/img/Back/Miguel Sommerfeld.jpeg", "Team leader - Back", "https://www.linkedin.com/in/miguel-sommerfeld-06491b340/", "https://github.com/MiguelSommerf"],
                        ["Miguel Teodoro", "../assets/img/Back/Miguel Teodoro_.jpg", "Programador - Back", null, "https://github.com/Miguelteodorodesouza"],
                        ["Sabrina Bela", "../assets/img/Back/Sabrina Nicole.jpeg    ", "Programadora - Back", "https://www.linkedin.com/in/sabrina-nicole-bela-4157b1289?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app", "https://github.com/sabrinabela1"],
                        ["Stephany dos Santos", "../assets/img/Back/Stephany Santos.jpeg", "Programadora - Back", null, "https://github.com/stephanydossantos16"],
                        ["Thomas Coradi", "../assets/img/Back/Thomas.jpeg", "Programador - Back", null, "https://github.com/thomcoradi"]
                    ];

                    foreach ($dados as $pessoa) {
                        echo "<div class='cartao'>";
                        echo "<img class='avatar' src='{$pessoa[1]}' alt='{$pessoa[0]}' />";
                        echo "<div class='cargo'>";
                        echo "<h2>{$pessoa[0]}</h2>";
                        echo "<h3>{$pessoa[2]}</h3>";
                        echo "<p>me encontre:</p>";
                        echo "<div class='div-btn-cred'>";
                        if ($pessoa[4]) echo "<a class='btn-git' href='{$pessoa[4]}' target='_blank' rel='noopener noreferrer'>GitHub</a>";
                        if ($pessoa[3]) echo "<a class='btn-linkedin' href='{$pessoa[3]}' target='_blank' rel='noopener noreferrer'>LinkedIn</a>";
                        echo "</div></div></div>";
                    }
                ?>
            </div>

            <!-- Banco de Dados -->
            <div class="sep-cat-cred"><p class="titulo">Banco de Dados</p></div>
            <div class="cartoes">
                <?php
                    $dadosBanco = [
                        ["Amanda Rodriguez", "../assets/img/Banco de dados/Amanda Rodrigues_.jpg", "Administradora - Banco de Dados", "", "https://github.com/amandszr"],
                        ["Bryan de Oliveira", "../assets/img/Banco de dados/Bryan.jpeg", "Administrador - Banco de Dados", "", "https://github.com/BryanOli17"],
                        ["Denner Pereira", "../assets/img/Banco de dados/Denner.jpeg", "Administrador - Banco de Dados", "", "https://github.com/Denner106"],
                        ["Guilherme Benatte", "../assets/img/Banco de dados/Guilherme Benatte.jpeg", "Team leader - Banco de Dados", "", "https://github.com/guibenatte"],
                        ["Katharina Iaussoghi", "../assets/img/Banco de dados/Katharina.jpeg", "Administradora - Banco de Dados", "", "https://github.com/Katharinasilveira"],
                        ["Mariana Campello", "../assets/img/Banco de dados/Mariana.jpeg", "Administradora - Banco de Dados", "https://www.linkedin.com/in/mariana-cunha-campello-b865b5363/", "https://github.com/marianacampelo"],
                        ["Nicole Pereira", "../assets/img/Perfil.jpeg", "Administradora - Banco de Dados", "", "https://github.com/Nicolepereiragregorutti"],
                        ["Rafaela Mayumi", "../assets/img/Banco de dados/Rafaela.jpeg", "Team leader - Banco de Dados", "https://www.linkedin.com/in/rafaela-mayumi-3b4587286?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app ", "https://github.com/RafaelaMayumiFukuda"]
                    ];

                    foreach ($dadosBanco as $pessoa) {
                        echo "<div class='cartao'>";
                        echo "<img class='avatar' src='{$pessoa[1]}' alt='{$pessoa[0]}' />";
                        echo "<div class='cargo'>";
                        echo "<h2>{$pessoa[0]}</h2>";
                        echo "<h3>{$pessoa[2]}</h3>";
                        echo "<p>Me encontre:</p>";
                        echo "<div class='div-btn-cred'>";
                        if ($pessoa[4]) echo "<a class='btn-git' href='{$pessoa[4]}' target='_blank' rel='noopener noreferrer'>GitHub</a>";
                        if ($pessoa[3]) echo "<a class='btn-linkedin' href='{$pessoa[3]}' target='_blank' rel='noopener noreferrer'>LinkedIn</a>";
                        echo "</div></div></div>";
                    }
                ?>
            </div>

            <!-- Front-end -->
            <div class="sep-cat-cred"><p class="titulo">Front-end</p></div>
            <div class="cartoes">
                <?php
                    $dadosFront = [
                        ["Amanda Kaori", "../assets/img/Front/Amanda Kaori.jpg", "Programadora - Front", null, "https://github.com/projamandakaori"],
                        ["Camila Vitoria", "../assets/img/Front/Camila.jpeg", "Programadora - Front", null, "https://github.com/ProjCamilaVitoria"],
                        ["Cauã Arthur", "../assets/img/Front/Cauã.jpeg", "Programador - Front", null, "https://github.com/Projcauaramos"],
                        ["Cecília Santiago", "../assets/img/Front/Cecilia.jpeg", "Programadora - Front", null, "https://github.com/ceciliasf"],
                        ["Eduardo de Ataíde", "../assets/img/Front/Eduardo.jpeg", "Programador - Front", null, "https://github.com/duduusxz"],
                        ["Giulia Benedetti", "../assets/img/Front/Giulia.jpeg", "Team leader - Front", null, "https://github.com/projgioliveira"],
                        ["João Xavier", "../assets/img/Front/João.jpeg", "Programador - Front", "https://www.linkedin.com/in/jo%C3%A3o-vitor-xavier-de-carvalho-469147183/?trk=opento_nprofile_details", "https://github.com/joaovitorxc"],
                        ["Kevin Rafael", "../assets/img/Front/Kevin.jpeg", "Programador - Front", null, "https://github.com/Kevin2007x"],
                        ["Lívia Amaral", "../assets/img/Front/Livia.jpeg", "Team leader - Front", "https://www.linkedin.com/in/l%C3%ADvia-amaral-sales-antonio-675219326/", "https://github.com/Liviaamaralsales"],
                        ["Olavo Alves", "../assets/img/Front/Olavo.jpeg", "Programador - Front","https://www.linkedin.com/in/olavo-alves-schiavi-338488353?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app ", "https://github.com/Olavoschiavi"],
                        ["Sabrina Vitória", "../assets/img/Front/Sabrina Vitoria.jpeg", "Programadora - Front", null, "https://github.com/Sabrinavmoura"],
                        ["Stefanny Sayuri", "../assets/img/Front/Stefanie Sayuri.jpeg", "Programadora - Front", null, "https://github.com/StefannySayuri"],
                        ["Welington Fernando", "../assets/img/Front/Wellington.jpeg", "Programador - Front", null, "https://github.com/Welingtonf"]
                    ];

                    foreach ($dadosFront as $pessoa) {
                        echo "<div class='cartao'>";
                        echo "<img class='avatar' src='{$pessoa[1]}' alt='{$pessoa[0]}' />";
                        echo "<div class='cargo'>";
                        echo "<h2>{$pessoa[0]}</h2>";
                        echo "<h3>{$pessoa[2]}</h3>";
                        echo "<p>me encontre:</p>";
                        echo "<div class='div-btn-cred'>";
                        if ($pessoa[4]) echo "<a class='btn-git' href='{$pessoa[4]}' target='_blank' rel='noopener noreferrer'>GitHub</a>";
                        if ($pessoa[3]) echo "<a class='btn-linkedin' href='{$pessoa[3]}' target='_blank' rel='noopener noreferrer'>LinkedIn</a>";
                        echo "</div></div></div>";
                    }
                ?>
            </div>

            <!-- Gestão -->
            <div class="sep-cat-cred"><p class="titulo">Gestão</p></div>
            <div class="cartoes">
                <?php
                    $dadosGestao = [
                        ["Giovana Pracanico", "../assets/img/Gestão/Giovana.jpeg", "Gestora", null, "https://github.com/projgipracanico"],
                        ["Heitor Albuquerque", "../assets/img/Gestão/Heitor.jpeg", "Gestor", null, "https://github.com/projheitorfreitas"],
                        ["Joshua Rodrigues", "../assets/img/Gestão/Joshua.jpeg", "Gestor", null, "https://github.com/JoshRodriguescae"],
                        ["Luara Gouveia", "../assets/img/Gestão/Luara.jpeg", "Gestora", null, "https://github.com/luarag45"]
                    ];
                    foreach ($dadosGestao as $pessoa) {
                        echo "<div class='cartao'>";
                        echo "<img class='avatar' src='{$pessoa[1]}' alt='{$pessoa[0]}' />";
                        echo "<div class='cargo'>";
                        echo "<h2>{$pessoa[0]}</h2>";
                        echo "<h3>{$pessoa[2]}</h3>";
                        echo "<p>me encontre:</p>";
                        echo "<div class='div-btn-cred'>";
                        if ($pessoa[4]) echo "<a class='btn-git' href='{$pessoa[4]}' target='_blank' rel='noopener noreferrer'>GitHub</a>";
                        if ($pessoa[3]) echo "<a class='btn-linkedin' href='{$pessoa[3]}' target='_blank' rel='noopener noreferrer'>LinkedIn</a>";
                        echo "</div></div></div>";
                    }
                ?>
            </div>
            
            <!-- Orientadores -->
            <div class="sep-cat-cred"><p class="titulo">Orientadores</p></div>
            <div class="cartoes">
                <?php
                    $dadosOrientadores = [
                        ["Ricardo Moreira", "../assets/img/Orientadores/Ricardo.jpeg", "Orientador do projeto", null, "https://github.com/prof-ricardo"],
                        ["Edilma Bindá", "../assets/img/Orientadores/Edilma.jpeg", "Orientadora do projeto", null, "https://github.com/edilmabinda"]
                    ];
                    foreach ($dadosOrientadores as $pessoa) {
                        echo "<div class='cartao'>";
                        echo "<img class='avatar' src='{$pessoa[1]}' alt='{$pessoa[0]}' />";
                        echo "<div class='cargo'>";
                        echo "<h2>{$pessoa[0]}</h2>";
                        echo "<h3>{$pessoa[2]}</h3>";
                        echo "<p>me encontre:</p>";
                        echo "<div class='div-btn-cred'>";
                        if ($pessoa[4]) echo "<a class='btn-git' href='{$pessoa[4]}' target='_blank' rel='noopener noreferrer'>GitHub</a>";
                        if ($pessoa[3]) echo "<a class='btn-linkedin' href='{$pessoa[3]}' target='_blank' rel='noopener noreferrer'>LinkedIn</a>";
                        echo "</div></div></div>";
                    }
                ?>
            </div>
        </div>
    </main>

    <div id="mySideMenu" class="side-menu">
        <a href="javascript:void(0)" class="close-btn" onclick="closeMenu()">&times;</a>
        <a href="tela_mapa.php">Mapa</a>
        <a href="tela_projetos.php">Projetos</a>
        <a href="tela_ranking.php">Ranking</a>
        <a href="tela_cursos.php">Cursos</a>
        <a href="tela_sobreEtec.php">Sobre a Etec</a>
        <a href="../index.php">Início</a>
        <?php if(isset($_SESSION['id'])): ?>
        <a href="../back/logout.php" class="deslogar" id="deslogar" name="deslogar">Sair da Conta</a>
        <?php endif; ?>
    </div>

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
    </script>
</body>
</html>
