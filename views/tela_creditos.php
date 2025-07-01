<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Layout de Equipes</title>
  <link rel="stylesheet" href="/assets/css/creditos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Karantina:wght@300;400;700&display=swap" rel="stylesheet">
    
  <style>


</style>
</head>
<body class="Creditos_body">


    <div class="menu-toggle" id="mobile-menu">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </div>

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

    <div class="logo-container">
        <img src="etecmcm.png" alt="Logo MCM"/>
      </div>

  <nav>
        <h1 class="titulo_creditos">Créditos</h1>
         <br>
         <br>
    </nav>

  <main style="padding: 0">
    <div class="container">

      <!-- Back-end -->
      <div class="sep-cat-cred"><p class="titulo">Back-end</p></div>
      <div class="cartoes">
        <?php
          $dados = [
            ["Ângelo Gabriel", "/imagens", "Team leader - Back", null, "https://github.com/projAngeloAraujo"],
            ["Enzo Móbile", "/imagens", "Programador - Back", null, "https://github.com/enzomobile"],
            ["Guilherme Solon", "/imagens", "Programador - Back", "https://www.linkedin.com/in/guilherme-solon-691289369/", "https://github.com/Solonguitec"],
            ["Gustavo da Rocha", "/imagens", "Programador - Back", null, "https://github.com/gustapinheiro"],
            ["Gustavo Rangel", "/imagens", "Programador - Back", null, "https://github.com/DEVRangelll"],
            ["Iuri Carati", "/imagens", "Programador - Back", null, "https://github.com/ToxicDumpster"],
            ["Jean Marcos", "/imagens", "Programador - Back", null, "https://github.com/jean666"],
            ["Júlia Medeiros", "/imagens", "Programadora - Back", null, "https://github.com/jumedeirost"],
            ["Matheus Pereira", "/imagens", "Programador - Back", null, "https://github.com/MatheusSontos"],
            ["Miguel Sommerfeld", "/imagens", "Team leader - Back", "https://www.linkedin.com/in/miguel-sommerfeld-06491b340/", "https://github.com/MiguelSommerf"],
            ["Miguel Teodoro", "/imagens", "Programador - Back", null, "https://github.com/Miguelteodorodesouza"],
            ["Sabrina Bela", "/imagens", "Programadora - Back", null, "https://github.com/sabrinabela1"],
            ["Stephany dos Santos", "/imagens", "Programadora - Back", null, "https://github.com/stephanydossantos16"],
            ["Thomas Coradi", "/imagens", "Programador - Back", null, "https://github.com/thomcoradi"]
          ];

          foreach ($dados as $pessoa) {
            echo "<div class='cartao'>";
            echo "<img class='avatar' src='{$pessoa[1]}' alt='{$pessoa[0]}' />";
            echo "<div class='cargo'>";
            echo "<h2>{$pessoa[0]}</h2>";
            echo "<h3>{$pessoa[2]}</h3>";
            echo "<p>me encontre:</p>";
            echo "<div class='div-btn-cred'>";
            if ($pessoa[4]) echo "<a class='btn-git' href='{$pessoa[4]}' target='_blank' rel='noopener noreferrer'>Git</a>";
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
            ["Amanda Rodriguez", "/imagens", "Administradora - Banco de Dados", "", "https://github.com/amandszr"],
            ["Bryan de Oliveira", "/imagens", "Administrador - Banco de Dados", "", "https://github.com/BryanOli17"],
            ["Denner Pereira", "/imagens", "Administrador - Banco de Dados", "", "https://github.com/Denner106"],
            ["Guilherme Benatte", "/imagens", "Team leader - Banco de Dados", "", "https://github.com/guibenatte"],
            ["Katharina Iaussoghi", "/imagens", "Administradora - Banco de Dados", "", "https://github.com/Katharinasilveira"],
            ["Mariana Campello", "/imagens", "Administradora - Banco de Dados", "https://www.linkedin.com/in/mariana-cunha-campello-b865b5363/", "https://github.com/marianacampelo"],
            ["Nicole Pereira", "/imagens", "Administradora - Banco de Dados", "", "https://github.com/Nicolepereiragregorutti"],
            ["Rafaela Mayumi", "/imagens", "Team leader - Banco de Dados", "", "https://github.com/RafaelaMayumiFukuda"]
          ];

          foreach ($dadosBanco as $pessoa) {
            echo "<div class='cartao'>";
            echo "<img class='avatar' src='{$pessoa[1]}' alt='{$pessoa[0]}' />";
            echo "<div class='cargo'>";
            echo "<h2>{$pessoa[0]}</h2>";
            echo "<h3>{$pessoa[2]}</h3>";
            echo "<p>me encontre:</p>";
            echo "<div class='div-btn-cred'>";
            if ($pessoa[4]) echo "<a class='btn-git' href='{$pessoa[4]}' target='_blank' rel='noopener noreferrer'>Git</a>";
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
            ["Amanda Kaori", "/imagens", "Programadora - Front", null, "https://github.com/projamandakaori"],
            ["Camila Vitoria", "/imagens", "Programadora - Front", null, "https://github.com/ProjCamilaVitoria"],
            ["Cauã Arthur", "/imagens", "Programador - Front", null, "https://github.com/Projcauaramos"],
            ["Cecília Santiago", "/imagens", "Programadora - Front", null, "https://github.com/ceciliasf"],
            ["Eduardo de Ataíde", "/imagens", "Programador - Front", null, "https://github.com/duduusxz"],
            ["Giulia Benedetti", "/imagens", "Team leader - Front", null, "https://github.com/projgioliveira"],
            ["João Xavier", "/imagens", "Programador - Front", "https://www.linkedin.com/in/jo%C3%A3o-vitor-xavier-de-carvalho-469147183/?trk=opento_nprofile_details", "https://github.com/joaovitorxc"],
            ["Kevin Rafael", "/imagens", "Programador - Front", null, "https://github.com/Kevin2007x"],
            ["Lívia Amaral", "/imagens", "Team leader - Front", "https://www.linkedin.com/in/l%C3%ADvia-amaral-sales-antonio-675219326/", "https://github.com/Liviaamaralsales"],
            ["Olavo Alves", "/imagens", "Programador - Front", null, "https://github.com/Olavoschiavi"],
            ["Sabrina Vitória", "/imagens", "Programadora - Front", null, "https://github.com/Sabrinavmoura"],
            ["Stefanny Sayuri", "/imagens", "Programadora - Front", null, "https://github.com/StefannySayuri"],
            ["Welington Fernando", "/imagens", "Programador - Front", null, "https://github.com/Welingtonf"]
          ];

          foreach ($dadosFront as $pessoa) {
            echo "<div class='cartao'>";
            echo "<img class='avatar' src='{$pessoa[1]}' alt='{$pessoa[0]}' />";
            echo "<div class='cargo'>";
            echo "<h2>{$pessoa[0]}</h2>";
            echo "<h3>{$pessoa[2]}</h3>";
            echo "<p>me encontre:</p>";
            echo "<div class='div-btn-cred'>";
            if ($pessoa[4]) echo "<a class='btn-git' href='{$pessoa[4]}' target='_blank' rel='noopener noreferrer'>Git</a>";
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
            ["Giovana Pracanico", "/imagem", "Gestão", null, "https://github.com/projgipracanico"],
            ["Heitor Albuquerque", "/imagens", "gestor", null, "https://github.com/projheitorfreitas"],
            ["Joshua Rodrigues", "/imagens", "gestor", null, "https://github.com/JoshRodriguescae"],
            ["Luara Gouveia", "/imagens", "gestora", null, "https://github.com/luarag45"]
          ];

          foreach ($dadosGestao as $pessoa) {
            echo "<div class='cartao'>";
            echo "<img class='avatar' src='{$pessoa[1]}' alt='{$pessoa[0]}' />";
            echo "<div class='cargo'>";
            echo "<h2>{$pessoa[0]}</h2>";
            echo "<h3>{$pessoa[2]}</h3>";
            echo "<p>me encontre:</p>";
            echo "<div class='div-btn-cred'>";
            if ($pessoa[4]) echo "<a class='btn-git' href='{$pessoa[4]}' target='_blank' rel='noopener noreferrer'>Git</a>";
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
            ["Ricardo Moreira", "/imagens", "Orientador do projeto", null, "https://github.com/prof-ricardo"],
            ["Edilma Bindá", "/imagens", "Orientadora do projeto", null, "https://github.com/edilmabinda"]
          ];

          foreach ($dadosOrientadores as $pessoa) {
            echo "<div class='cartao'>";
            echo "<img class='avatar' src='{$pessoa[1]}' alt='{$pessoa[0]}' />";
            echo "<div class='cargo'>";
            echo "<h2>{$pessoa[0]}</h2>";
            echo "<h3>{$pessoa[2]}</h3>";
            echo "<p>me encontre:</p>";
            echo "<div class='div-btn-cred'>";
            if ($pessoa[4]) echo "<a class='btn-git' href='{$pessoa[4]}' target='_blank' rel='noopener noreferrer'>Git</a>";
            if ($pessoa[3]) echo "<a class='btn-linkedin' href='{$pessoa[3]}' target='_blank' rel='noopener noreferrer'>LinkedIn</a>";
            echo "</div></div></div>";
          }
        ?>
      </div>

    </div>
  </main>
</body>
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
</html>