<?php
require_once '../../config/connect.php';

$query = "SELECT is_admin FROM usuarios WHERE id_usuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_POST['id_usuario']);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
        if($row['is_admin'] == 0) {
            $query = "UPDATE usuarios SET is_admin = 1 WHERE id_usuario = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $_POST['id_usuario']);
            $stmt->execute();
            $stmt->close();
        } else {
            $query = "UPDATE usuarios SET is_admin = 0 WHERE id_usuario = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $_POST['id_usuario']);
            $stmt->execute();
            $stmt->close();
        }

    echo "<script>alert('Usuário atualizado com sucesso!');</script>";
    echo "<script>window.history.back()</script>";
    exit();
} else {
    echo "<script>alert('Usuário não encontrado!');</script>";
    echo "<script>window.history.back()</script>";
    exit();
}
