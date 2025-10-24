<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id'])) {
  echo "<script>
    alert('Você precisa estar logado para nos avaliar.');
    window.location.href = '../views/tela_home.php';
  </script>";
  exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/feedback.css">
  <title>Dê seu Feedback</title>
</head>
<body>
  <main>
    <header>
      <a href="tela_home.php"><img class="setaVoltar" src="../assets/img/setaVoltar.png" alt="Voltar"></a>
      <img class="logoMCM" src="../assets/img/etecmcm.png" alt="Logo MCM">
    </header>
    <div class="container">
      <h2>Envie seu Feedback!</h2>
      
      <form id="form" action="../back/feedback.php" method="POST">
        <div class="separacao">
          <span>Nota:</span>
          <select id="nota" name="nota" required>
            <option value="" disabled selected>Selecione</option>
            <option value="5">⭐⭐⭐⭐⭐</option>
            <option value="4">⭐⭐⭐⭐</option>
            <option value="3">⭐⭐⭐</option>
            <option value="2">⭐⭐</option>
            <option value="1">⭐</option>
          </select>
        </div>
        <div class="separacao">
          <span>Comentário:</span>
          <textarea id="comentario" name="comentario" rows="4"></textarea>
        </div>
        <div class="separacao">
          <button type="submit" class="enviar">Enviar</button>
        </div>
      </form>
    </div>
  </main>
</body>
</html>