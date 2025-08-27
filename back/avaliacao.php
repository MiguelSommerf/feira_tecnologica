<?php
//Codado por Miguel Luiz Sommerfeld - 3°F Turma B
require_once '../config/database.php';
session_start();

if (!isset($_SESSION['id'])) {
    echo "<script>alert('Você precisa estar logado para avaliar os projetos.')</script>";
    echo "<script>window.location.href = '../views/tela_login.php'</script>";
    exit();
} else {
    $id_user = $_SESSION['id'];
}

$voto = !empty($_POST['estrelas']) ? (int)$_POST['estrelas'] : null;
$comentario = !empty($_POST['comentario']) ? $_POST['comentario'] : null;
$id_projeto = !empty($_POST['id_projeto']) ? (int)$_POST['id_projeto'] : null;

if (isset($voto) && isset($id_projeto)) {
    $queryVerificacao = "SELECT " . TABELA_VOTO['usuario'] . ", " . TABELA_VOTO['projeto'] . " FROM " . TABELA_VOTO['nome_tabela'] . " WHERE " . TABELA_VOTO['usuario'] . " = (?) AND " . TABELA_VOTO['projeto'] . " = (?)";
    $stmt = $mysqli->prepare($queryVerificacao);
    $stmt->bind_param("ii", $id_user, $id_projeto);
    $stmt->execute();
    $resultVerificacao = $stmt->get_result();

    if ($resultVerificacao->num_rows > 0) {
        echo "<script>alert('Você não pode votar duas vezes em um mesmo projeto.')</script>";
        echo "<script>window.location.href = '../views/tela_projetos.php';</script>";
        exit();
    }

    $queryQtdVotos = "SELECT " . TABELA_VOTO['usuario'] . " FROM " . TABELA_VOTO['nome_tabela'] . " WHERE " . TABELA_VOTO['usuario'] . " = (?)";
    $stmt = $mysqli->prepare($queryQtdVotos);
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $resultQtdVotos = $stmt->get_result();

    if ($resultQtdVotos->num_rows >= 5) {
        echo "<script>alert('Você atingiu o seu limite de 5 votos.')</script>";
        echo "<script>window.history.back()</script>";
        exit();
    }

    date_default_timezone_set('America/Sao_Paulo');
    $fusoHorario = new DateTime();
    $data = $fusoHorario->format('Y-m-d H:i:s');

    $query = "INSERT INTO " . TABELA_VOTO['nome_tabela'] . "(" . TABELA_VOTO['data'] . ", " . TABELA_VOTO['valor'] . ", " . TABELA_VOTO['comentario'] . ", " . TABELA_VOTO['usuario'] . ", " . TABELA_VOTO['projeto'] . ") VALUES (?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("sisii", $data, $voto, $comentario, $id_user, $id_projeto);
    $stmt->execute();

    echo "<script>alert('Agradecemos pela sua avaliação!')</script>";
    echo "<script>window.location.href = '../views/tela_projetos.php';</script>";
    exit();
} else {
    echo "<script>alert('Não foi possível enviar a sua avaliação. Tente novamente.')</script>";
    echo "<script>window.location.href = '../views/tela_projetos.php';</script>";
    exit();
}
