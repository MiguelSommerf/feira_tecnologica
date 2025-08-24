<?php
require_once '../config/connect.php';
session_start();

if (isset($_SESSION['redefine'])) {
    $novaSenha = $_POST['novaSenha'];
    $novaSenhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

    $queryRedefinirSenha = "UPDATE tbl_users SET senha = ? WHERE email = ?";
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
