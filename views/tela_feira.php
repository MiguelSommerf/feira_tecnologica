<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação dos projetos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Karantina:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/feira.css">
</head>
<body class="telaFeira">
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
        <h1>Feira</h1>
      </div>
    </header>

    <main>
        <section class="container-feira">
            <p> 
                A Feira Tecnológica e Sustentável da ETEC Maria Cristina Medeiros é um evento anual que reúne criatividade, inovação e consciência socioambiental. Desenvolvida pelos alunos com apoio dos professores, a feira apresenta projetos que integram tecnologia e sustentabilidade. Mais do que uma simples exposição de trabalhos, a feira é um espaço de troca de conhecimentos, onde a comunidade escolar e visitantes externos podem conhecer de perto as iniciativas dos cursos técnicos e integrados.

                Além da apresentação dos projetos, o evento oferece palestras e atividades interativas, criando um ambiente de aprendizado e inspiração. É também uma excelente oportunidade para o público conhecer melhor os alunos, seus talentos e as possibilidades oferecidas pelos cursos técnicos da ETEC MCM, reforçando o compromisso da escola com a formação de profissionais conscientes, criativos e preparados para transformar o futuro.
            </p>
            <div class="grid-imagens">
                <img src="" alt="" class="feira-imagem"></img> <!-- Inserir Foto-->
                <img src="" alt="" class="feira-imagem"></img>
                <img src="" alt="" class="feira-imagem"></img>
                <img src="" alt="" class="feira-imagem"></img>
            </div>
        </section>
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