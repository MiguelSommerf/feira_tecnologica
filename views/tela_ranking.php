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
    <header class="headerLogo">
      <img src="../assets/img/etecmcm.png" alt="Logo MCM">
    </header>
    <div class="container">
      <?php
        foreach ($resultados as $linha) {
          echo $linha;
        }
      ?>
    </div>
  </main>
</body>
</html>