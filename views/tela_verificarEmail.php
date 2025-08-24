<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION['verificando'] != 1) {
    echo "<script>window.location.href='../views/tela_cadastro.php'</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insira o código</title>
</head>
<body>
    <h1>Enviamos um código no seu e-mail</h1>
    <h1>Confirme que é você.</h1>
    <h2>Insira o código:</h2>
    <form action="../back/verificarEmail.php" method="POST">
        <input type="number" name="codigo" id="codigo" placeholder="Código">
        <a href="../back/reenviarCodigo.php">Reenviar código</a>
        <button type="submit">Verificar</button>
    </form>
</body>
</html>