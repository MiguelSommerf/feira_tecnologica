<?php
//Codado por Miguel Luiz Sommerfeld - 3°F Turma B
require_once '../config/connect.php';
session_start();

if (!isset($_SESSION['id'])) {
    echo "<script>alert('Você precisa estar logado para avaliar os projetos.')</script>";
    echo "<script>window.history.back()</script>";
    exit();
} else {
    $id_user = $_SESSION['id'];
}

$voto = isset($_POST['estrelas']) ? (int)$_POST['estrelas'] : null;
$comentario = isset($_POST['comentario']) ? $_POST['comentario'] : null;
$id_projeto = isset($_POST['id_projeto']) ? (int)$_POST['id_projeto'] : null;

if (isset($voto) && isset($id_projeto)) {
    $queryVerificacao = "SELECT id_user, id_projetos FROM tb_votos WHERE id_user = (?) AND id_projetos = (?)";
    $stmt = $mysqli->prepare($queryVerificacao);
    $stmt->bind_param("ii", $id_user, $id_projeto);
    $stmt->execute();
    $resultVerificacao = $stmt->get_result();

    if ($resultVerificacao->num_rows > 0) {
        echo "<script>alert('Você não pode votar duas vezes em um mesmo projeto.')</script>";
        echo "<script>window.history.back()</script>";
        exit();
    }

    $queryQtdVotos = "SELECT id_user FROM tb_votos WHERE id_user = (?)";
    $stmt = $mysqli->prepare($queryQtdVotos);
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $resultQtdVotos = $stmt->get_result();

    if ($resultQtdVotos->num_rows >= 5) {
        echo "<script>alert('Você atingiu o seu limite de 5 votos.')</script>";
        echo "<script>window.history.back()</script>";
        exit();
    }

    $fusoHorario = new DateTime();
    $data = $fusoHorario->format('Y-m-d H:i:s');

    $query = "INSERT INTO tb_votos (dt_hora_voto, valor_voto, coment_voto, id_user, id_projetos)
    VALUES (?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("sisii", $data, $voto, $comentario, $id_user, $id_projeto);
    $stmt->execute();

    echo "<script>alert('Agradecemos pela sua avaliação!')</script>";
    echo "<script>window.history.back();</script>";
} else {
    echo "<script>alert('Não foi possível enviar a sua avaliação. Tente novamente.')</script>";
    echo "<script>window.history.back()</script>";
    exit();
}