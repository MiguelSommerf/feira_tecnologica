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
        $queryEmailUsuario = "SELECT " . TABELA_USUARIO['email'] . " FROM " . TABELA_USUARIO['nome_tabela']
        . " WHERE " . TABELA_USUARIO['id'] . " = ?";
        $stmtEmailUsuario = $mysqli->prepare($queryEmailUsuario);
        $stmtEmailUsuario->bind_param("i", $id_usuario);
        $stmtEmailUsuario->execute();
        $emailUsuario = $stmtEmailUsuario->get_result()->fetch_assoc();

        $queryEmailAdmin = "SELECT " . TABELA_USUARIO['email'] . " FROM " . TABELA_USUARIO['nome_tabela'] . " WHERE " . TABELA_USUARIO['id'] . " = ?";
        $stmtEmailAdmin = $mysqli->prepare($queryEmailAdmin);
        $stmtEmailAdmin->bind_param("i", $_SESSION['id']);
        $stmtEmailAdmin->execute();
        $emailAdmin = $stmtEmailAdmin->get_result()->fetch_assoc();

        date_default_timezone_set('America/Sao_Paulo');
        $fusoHorario = new DateTime();
        $data = $fusoHorario->format('Y-m-d H:i:s');

        $queryLogUsuario = "INSERT INTO " . TABELA_LOG_USUARIO['nome_tabela'] . " VALUES (DEFAULT, ?, ?, ?)";
        $stmtLogUsuario = $mysqli->prepare($queryLogUsuario);
        $stmtLogUsuario->bind_param("sss", $emailAdmin['email_usuario'], $emailUsuario['email_usuario'], $data);
        $stmtLogUsuario->execute();
        $stmtLogUsuario->close();

        $queryDeleteUser = "DELETE FROM " . TABELA_USUARIO['nome_tabela'] . " WHERE " . TABELA_USUARIO['id'] . " = ?";
        $stmtDeleteUser = $mysqli->prepare($queryDeleteUser);
        $stmtDeleteUser->bind_param("i", $id_usuario);
        $stmtDeleteUser->execute();
        $stmtDeleteUser->close();

        header('Location: ../views/usuarios.php');
        exit();
    } else {
        header('Location: ../views/home.php');
        exit();
    }
}
