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
  <title>Sobre a feira</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Grenze:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <script type="text/javascript" src="https://cdn.rybena.com.br/dom/master/latest/rybena.js"></script>
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
    <button class="btn-voltar" onclick="window.location.href = '../views/tela_home.php'">Voltar</button>
    <section class="container-feira">
      <p>
        A Feira Tecnológica e Sustentável da ETEC Maria Cristina Medeiros é um evento anual que reúne criatividade, inovação e consciência socioambiental. Desenvolvida pelos alunos com apoio dos professores, a feira apresenta projetos que integram tecnologia e sustentabilidade. Mais do que uma simples exposição de trabalhos, a feira é um espaço de troca de conhecimentos, onde a comunidade escolar e visitantes externos podem conhecer de perto as iniciativas dos cursos técnicos e integrados.
        Além da apresentação dos projetos, o evento oferece palestras e atividades interativas, criando um ambiente de aprendizado e inspiração. É também uma excelente oportunidade para o público conhecer melhor os alunos, seus talentos e as possibilidades oferecidas pelos cursos técnicos da ETEC MCM, reforçando o compromisso da escola com a formação de profissionais conscientes, criativos e preparados para transformar o futuro.
      </p>
      <div class="grid-imagens">
        <img src="" alt="" class="feira-imagem"></img>
        <img src="" alt="" class="feira-imagem"></img>
        <img src="" alt="" class="feira-imagem"></img>
        <img src="" alt="" class="feira-imagem"></img>
      </div>
    </section>
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
    <?php else: ?>
    <a href="tela_login.php">Entrar</a>
    <?php endif; ?>
  </div>
  <script src="../assets/js/menuLateral.js"></script>
</body>
</html>