<?php
require_once '../back/ranking.php';

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ranking dos projetos</title>
  <link rel="stylesheet" href="../assets/css/ranking.css">
</head>
<body>
  <main>
    <header>
      <a href="tela_home.php"><img class="setaVoltar" src="../assets/img/setaVoltar.png" alt="Voltar"></a>
      <img class="logoMCM" src="../assets/img/etecmcm.png" alt="Logo MCM">
    </header>
    <div class="container">
      <h1>Ranking</h1>
      <div class="top">
        <div class="posicao">
          <h3><?php if (isset($nome[1])) {echo $nome[1];}?></h3>
          <div id="segundo">
            <h1><?php if (isset($top[1])) {echo $top[1] . 'º';}?></h1>
          </div>
        </div>
        <div class="posicao">
          <h3><?php if (isset($nome[0])) {echo $nome[0];}?></h3>
          <div id="primeiro">
            <h1><?php if (isset($top[0])) {echo $top[0] . 'º';}?></h1>
          </div>
        </div>
        <div class="posicao">
          <h3><?php if (isset($nome[2])) {echo $nome[2];}?></h3>
          <div id="terceiro">
            <h1><?php if (isset($top[2])) {echo $top[2] . 'º';}?></h1>
          </div>
        </div>
      </div>
      <?php
        foreach ($resultados as $linha) {
          echo $linha;
        }
      ?>
    </div>
  </main>
</body>
</html>