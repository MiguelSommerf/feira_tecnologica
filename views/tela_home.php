<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="../assets/css/style.css"/>
    <title>Home</title>
  </head>
  <body
    style="
      background-image: url('../assets/img/bg-roxo.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
    ">
    <header>
      <img src="../assets/img/mcm-logo.png" alt="logo">
      <h1>Inicio</h1>
      <img src="../assets/img/cps-logo.png" alt="logo">
    </header>
    <main>
      <div class="home-holder">
        <div class="home-conteiner">
          <?php
          if(isset($_SESSION['id'])){
            echo "Bem-vindo " . $_SESSION['nome'] . "!";
          }
          ?>
          <a href="tela_mapa.php" class="btn-1 btn">
            <p>Mapa</p>
            <div class="dots-1">&gt;</div>
          </a>

          <a href="#" onclick="document.getElementById('formFiltro').submit();" class="btn-1 btn">
            <p>Projetos</p>
            <form action="tela_projetos.php" method="post" id="formFiltro">
                <input type="hidden" name="filtroProjetos" value="1">
            </form>
            <div class="dots-1">&gt;</div>
          </a>

          <?php if(!isset($_SESSION['id'])): ?>

          <a href="tela_login.php" class="btn-2 btn">
            <p>Entrar</p>
            <div class="dots-2">&gt;</div>
          </a>

          <a href="tela_cadastro.php" class="btn-2 btn">
            <p>Cadastrar</p>
            <div class="dots-2">&gt;</div>
          </a>

          <?php endif ?>

          <a href="tela_ods.php" class="btn-2 btn">
            <p>ODS</p>
            <div class="dots-2">&gt;</div>
          </a>

          <a href="tela_creditos" class="btn-2 btn">
            <p>Créditos</p>
            <div class="dots-2">&gt;</div>
          </a>
          <a href="tela_feedback.php" class="avaliar"><strong>AVALIE-NOS AQUI!</strong></a>
        </div>
      </div>
    </main>
  </body>
</html>