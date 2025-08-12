<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    echo "<script>
      alert('Você precisa estar logado para nos avaliar.');
      window.history.back();
    </script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Grenze:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script type="text/javascript" src="https://cdn.rybena.com.br/dom/master/latest/rybena.js"></script>
  <link rel="stylesheet" href="../assets/css/feedback.css">
  <title>Feedback</title>
</head>
<body class="telaFeedback">
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
        <h1>Feedback</h1>
      </div>
    </header>
    <div class="main-container">
    
<a href="tela_home.php" class="voltar">Voltar</a>
  <div class="feedback-form">
    <h2>Envie seu Feedback</h2>
    
    <form id="form" action="../back/feedback.php" method="POST">
      <label for="nota">Avaliação:</label>
      <select id="nota" name="nota" required>
        <option value="" disabled selected>Selecione</option>
        <option value="5">⭐⭐⭐⭐⭐</option>
        <option value="4">⭐⭐⭐⭐</option>
        <option value="3">⭐⭐⭐</option>
        <option value="2">⭐⭐</option>
        <option value="1">⭐</option>
      </select>

      <label for="comentario">Comentário:</label>
      <textarea id="comentario" name="comentario" rows="4"></textarea>

      <button type="submit" class="enviar">Enviar</button>
    </form> 
   
    <button class="btn-voltar" onclick="history.back()">Voltar</button>
  </div>
   </div>
  <div id="mySideMenu" class="side-menu">
        <a href="javascript:void(0)" class="close-btn" onclick="closeMenu()">&times;</a>
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
