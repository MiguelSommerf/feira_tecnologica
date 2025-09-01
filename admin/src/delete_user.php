<?php
require_once __DIR__ . '/../../config/database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['admin']) or $_SESSION['admin'] != true) {
    header('Location: ../views/home.php');
    exit();
} else {
    $id_usuario = !empty($_POST['id_usuario']) ? $_POST['id_usuario'] : null;

    if(!empty($id_usuario) && $_SESSION['admin'] == true) {
        $queryLogUsuario = "INSERT INTO " . TABELA_LOG_USUARIO['nome_tabela'] . " VALUES (?, ?)";
        $stmtLogUsuario = $mysqli->prepare($queryLogUsuario);
        $stmtLogUsuario->bind_param("ii", $_SESSION['id'], $id_usuario);
        $stmtLogUsuario->execute();
        $stmtLogUsuario->close();

        $queryDeleteUser = "DELETE FROM " . TABELA_USUARIO['nome_tabela'] . " WHERE " . TABELA_USUARIO['id'] . " = ?";
        $stmtDeleteUser = $mysqli->prepare($queryDeleteUser);
        $stmtDeleteUser->bind_param("i", $id_usuario);
        $stmtDeleteUser->execute();
        $stmtDeleteUser->close();

        header('Location: ../views/usuarios.php');
        exit();
    }
}
