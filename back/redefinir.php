<?php
require_once '../config/database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['redefine'])) {
    $novaSenha = $_POST['novaSenha'];
    $novaSenhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

    $queryRedefinirSenha = "UPDATE " . TABELA_USUARIO['nome_tabela'] . " SET " . TABELA_USUARIO['senha'] . " = ? WHERE " . TABELA_USUARIO['email'] . " = ?";
    $stmtRedefinirSenha = $mysqli->prepare($queryRedefinirSenha);
    $stmtRedefinirSenha->bind_param("ss", $novaSenhaHash, $_SESSION['email']);
    $stmtRedefinirSenha->execute();
    $stmtRedefinirSenha->close();

    unset($_SESSION['email']);
    unset($_SESSION['redefine']);

    echo "<script>alert('Senha modificada com sucesso!')</script>";
    echo "<script>window.location.href = '../views/tela_login.php'</script>";
    exit();
} else {
    echo "<script>window.location.href = '../views/tela_login.php'</script>";
    exit();
}

echo "<script>window.history.back();</script>";
exit();
