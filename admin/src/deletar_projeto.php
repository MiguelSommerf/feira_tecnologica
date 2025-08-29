<?php
require_once __DIR__ . '/../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idProjeto = !empty($_POST['id_projeto']) ? $_POST['id_projeto'] : null;

    if (!isset($idProjeto)) {
        echo "<script>window.location.href = '../views/projetos.php'</script>";
        exit();
    }

    // Deleta as FK e depois o projeto
    $sqlDeletarFKProjetoAluno = "DELETE FROM " . TABELA_PROJETO_ALUNO['nome_tabela'] . " WHERE " . TABELA_PROJETO_ALUNO['projeto'] . " = ?";
    $stmtDeletarFKProjetoAluno = $mysqli->prepare($sqlDeletarFKProjetoAluno);
    $stmtDeletarFKProjetoAluno->bind_param("i", $idProjeto);
    $stmtDeletarFKProjetoAluno->execute();

    $sqlDeletarFKOdsProjeto = "DELETE FROM " . TABELA_ODS_PROJETO['nome_tabela'] . " WHERE " . TABELA_ODS_PROJETO['projeto'] . " = ?";
    $stmtDeletarFKOdsProjeto = $mysqli->prepare($sqlDeletarFKOdsProjeto);
    $stmtDeletarFKOdsProjeto->bind_param("i", $idProjeto);
    $stmtDeletarFKOdsProjeto->execute();

    $sqlDeletarProjeto = "DELETE FROM " . TABELA_PROJETO['nome_tabela'] . " WHERE " . TABELA_PROJETO['id'] . " = ?";
    $stmtsqlDeletarProjeto = $mysqli->prepare($sqlDeletarProjeto);
    $stmtsqlDeletarProjeto->bind_param("i", $idProjeto);
    $stmtsqlDeletarProjeto->execute();

    $stmtDeletarFKProjetoAluno->close();
    $stmtDeletarFKOdsProjeto->close();
    $stmtsqlDeletarProjeto->close();

    echo "<script>alert('Projeto excluído com sucesso!')</script>";
    echo "<script>window.location.href = '../views/projetos.php';</script>";
    exit();
}