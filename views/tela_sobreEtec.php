<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sobre Etec</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Karantina:wght@300;400;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../assets/css/sobreEtec.css" />
  </head>
  <body class="telaSobreEtec">
    <header>
      <div class="menu-toggle" id="mobile-menu">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
      </div>
      <div class="logo-container">
        <img src="../assets/img/etecmcm.png" alt="Logo MCM" />
      </div>
      <div class="ORGInfoHeader">
        <h1>ETEC MCM</h1>
      </div>
    </header>

    <main class="main-sobreEtec">
      <div class="sobreEtec">
        <p>
          A implantação da Etec de Ribeirão Pires começou em 2005 com apoio do
          prefeito Clóvis Volpi e do Centro Paula Souza. Inicialmente funcionou
          como classe descentralizada da Etec de Santo André. Em 2006, foi
          oficialmente criada por decreto do governo estadual, passando a ter
          autonomia. A unidade cresceu com reformas, novos cursos (como Química,
          Turismo, Administração, Web Design, Contabilidade, Eventos, Logística
          e Informática), programas de qualificação como Via Rápida e PEAD, e
          parcerias com a prefeitura.</p> 
          <img src="../assets/img/etec-frente.jpeg" alt="imagem etec mcm">
          <p>A partir de 2010, passou a oferecer ensino
          técnico integrado ao médio e cursos a distância. A grande ampliação da
          estrutura ocorreu entre 2011 e 2014, com a criação dos blocos A e B.
          Em 2015, foram ofertadas 360 vagas em cursos técnicos e integrados.
          Nesse ano, a escola passou a se chamar Etec Professora Maria Cristina
          Medeiros, em homenagem à ex-diretora, falecida em 2015.
        </p>
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
    </script>
  </body>
</html>