<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sobre a Etec</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Grenze:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/sobreEtec.css" />
  <script type="text/javascript" src="https://cdn.rybena.com.br/dom/master/latest/rybena.js"></script>
</head>
<body class="telaSobreEtec">
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
      <h1>Etec MCM</h1>
    </div>
  </header>

  <main class="main-sobreEtec">
    <button class="btn-voltar" onclick="window.location.href = '../views/tela_home.php'">Voltar</button>
    
    <div class="sobreEtec">
      <p>A Etec de Ribeirão Pires teve sua história iniciada em 2005, com apoio do então prefeito Clóvis Volpi e do Centro Paula Souza, dentro de um projeto do Governo do Estado para expandir o ensino técnico em São Paulo. No começo, a escola funcionava como uma extensão da Etec de Santo André, com dois cursos: Química e Turismo. As aulas começaram em 2006, em um prédio no Jardim Alvorada que foi reformado especialmente para receber os alunos.</p> 
      <br>
      <p>Ainda em 2006, a escola foi oficialmente criada por um decreto do governador Geraldo Alckmin e passou a ter autonomia. A professora Maria Cristina Medeiros assumiu a direção e teve papel fundamental na organização da escola, reunindo professores, criando laboratórios e planejando novos cursos para atender melhor os jovens da cidade.</p>
        <img class="img-etec" src="../assets/img/etec-frente.jpeg" alt="imagem etec mcm">
      <p>A partir de 2007, a Etec começou a crescer. Foram implantados cursos como Administração, Web Design, Contabilidade, Eventos, Logística e Informática. Novas turmas foram abertas e a equipe também aumentou. A escola participou de programas estaduais de qualificação profissional e manteve uma forte parceria com a Prefeitura de Ribeirão Pires, inclusive envolvendo os alunos em eventos culturais e turísticos da cidade.</p>
      <br>        
      <p>Entre 2011 e 2014, foi realizada uma grande obra de ampliação. O projeto arquitetônico, feito e doado pela própria diretora, Maria Cristina Medeiros (que também era arquiteta), resultou na construção de dois blocos com novas salas de aula e laboratórios. Essa reforma melhorou muito a estrutura da escola, permitindo o crescimento da oferta de cursos e vagas.</p>
      <br>        
      <p>A partir de 2012, a escola passou a oferecer cursos que unem o Ensino Médio com o Técnico, em período integral, como os de Informática para Internet e Administração. Isso deu aos alunos a oportunidade de sair da escola já com uma formação profissional completa.</p>
      <br>       
      <p>Em 2015, infelizmente, a professora Maria Cristina faleceu, após um longo afastamento por problemas de saúde. Em reconhecimento ao seu trabalho e dedicação, a escola passou a se chamar oficialmente Escola Técnica Estadual Professora Maria Cristina Medeiros, por meio de um decreto estadual. A mudança foi um pedido da comunidade escolar como forma de homenageá-la.</p>
      <br>
      <p>Hoje, a Etec é um importante centro de educação em Ribeirão Pires, oferecendo ensino gratuito e de qualidade, preparando jovens e adultos para o mercado de trabalho e para o futuro.</p>
    </div>
  </main>

  <div id="mySideMenu" class="side-menu">
    <a href="javascript:void(0)" id="close-btn" class="close-btn">&times;</a>
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
  <script src="../assets/JS/menuLateral.js"></script>
</body>
</html>