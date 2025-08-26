<?php
require_once '../../config/connect.php';

session_start();
if (!isset($_SESSION['admin']) or $_SESSION['admin'] != true) {
    header('Location: ../Views/home.php');
    exit('Você não tem permissão para acessar esta página.');
} else {
    if(isset($_POST['id_usuario']) && $_SESSION['admin'] == true) {
        $query = "DELETE FROM usuarios WHERE id_usuario = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $_POST['id_usuario']);
        $stmt->execute();
        $stmt->close();

        header('Location: ../Views/usuarios.php');
        exit();
    }
}
