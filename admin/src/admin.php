<?php
require_once __DIR__ . '/../../config/database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['admin']) or $_SESSION['admin'] != true) {
    header('Location: ../views/home.php');
    exit();
}

$id_usuario = !empty($_POST['id_usuario']) ? $_POST['id_usuario'] : null;

$queryAdmin = "SELECT " . TABELA_USUARIO['admin'] . " FROM " . TABELA_USUARIO['nome_tabela'] . " WHERE " . TABELA_USUARIO['id'] . " = ?";
$stmtAdmin = $mysqli->prepare($queryAdmin);
$stmtAdmin->bind_param("i", $id_usuario);
$stmtAdmin->execute();
$resultAdmin = $stmtAdmin->get_result();
$stmtAdmin->close();

if ($resultAdmin->num_rows > 0) {
    $usuario = $resultAdmin->fetch_assoc();
        if($usuario['is_admin'] == 0) {
            $querySetAdmin = "UPDATE " . TABELA_USUARIO['nome_tabela'] . " SET " . TABELA_USUARIO['admin'] . " = 1 WHERE " . TABELA_USUARIO['id'] . " = ?";
            $stmtSetAdmin = $mysqli->prepare($querySetAdmin);
            $stmtSetAdmin->bind_param("i", $id_usuario);
            $stmtSetAdmin->execute();
            $stmtSetAdmin->close();
        } else {
            $queryRemoveAdmin = "UPDATE " . TABELA_USUARIO['nome_tabela'] . " SET " . TABELA_USUARIO['admin'] . " = 0 WHERE " . TABELA_USUARIO['id'] . " = ?";
            $stmtRemoveAdmin = $mysqli->prepare($queryRemoveAdmin);
            $stmtRemoveAdmin->bind_param("i", $id_usuario);
            $stmtRemoveAdmin->execute();
            $stmtRemoveAdmin->close();
        }

    echo "<script>alert('Usuário atualizado com sucesso!');</script>";
    echo "<script>window.location.href = '../views/usuarios.php'</script>";
    exit();
} else {
    echo "<script>alert('Usuário não encontrado!');</script>";
    echo "<script>window.location.href = '../views/usuarios.php'</script>";
    exit();
}
