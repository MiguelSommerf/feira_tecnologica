<?php
require_once __DIR__ . '/../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idProjeto = !empty($_POST['id_projeto']) ? (int)$_POST['id_projeto'] : null;
    $tituloProjeto = !empty($_POST['titulo']) ? $_POST['titulo'] : null;
    $descricaoProjeto = !empty($_POST['descricao']) ? $_POST['descricao'] : null;
    $blocoProjeto = !empty($_POST['bloco']) ? (int)$_POST['bloco'] : null;
    $salaProjeto = !empty($_POST['sala']) ? (int)$_POST['sala'] : null;
    $orientadorProjeto = !empty($_POST['orientador']) ? $_POST['orientador'] : null;

    if (isset($tituloProjeto) && isset($descricaoProjeto) && isset($blocoProjeto) && isset($salaProjeto) && isset($orientadorProjeto)) {

        // Faz um select de conta distinta, pegando a sala inserida como argumento.
        $sqlVerificar = "SELECT COUNT(DISTINCT " . TABELA_LOCALIZACAO_PROJETO['projeto'] . ") as total_projetos 
                        FROM " . TABELA_LOCALIZACAO_PROJETO['nome_tabela'] . " 
                        WHERE " . TABELA_LOCALIZACAO_PROJETO['sala'] . " = ? 
                        AND " . TABELA_LOCALIZACAO_PROJETO['bloco'] . " = ?";

        $stmtVerificar = $mysqli->prepare($sqlVerificar);
        $stmtVerificar->bind_param("ii", $salaProjeto, $blocoProjeto);
        $stmtVerificar->execute();
        $stmtVerificar->bind_result($totalProjetos);
        $stmtVerificar->fetch();
        $stmtVerificar->close();

        if ($totalProjetos >= 5) {
            echo "<script>alert('Essa sala já possui 5 projetos ou mais!')</script>";
            echo "<script>window.location.href = '../views/projetos.php'</script>";
            $stmtVerificar->close();
            exit();
        }

        $queryProjeto = "UPDATE " . TABELA_PROJETO['nome_tabela'] . " SET "
                        . TABELA_PROJETO['titulo'] . " = ?, "
                        . TABELA_PROJETO['descricao'] . " = ?, "
                        . TABELA_PROJETO['bloco'] . " = ?, "
                        . TABELA_PROJETO['sala'] . " = ?, "
                        . TABELA_PROJETO['orientador'] . " = ? WHERE "
                        . TABELA_PROJETO['id'] . " = ?";
        $stmtProjeto = $mysqli->prepare($queryProjeto);
        $stmtProjeto->bind_param("sssssi", $tituloProjeto, $descricaoProjeto, $blocoProjeto, $salaProjeto, $orientadorProjeto, $idProjeto);

        if ($stmtProjeto->execute()) {
            echo "<script>alert('Projeto atualizado com sucesso!')</script>";
        } else {
            echo "<script>alert('Ocorreu um erro ao atualizar o projeto.')</script>";
            echo "<script>window.location.href = '../views/projetos.php'</script>";
            exit();
        }

        echo "<script>window.location.href = '../views/projetos.php'</script>";
        exit();
    } else {
        echo "<script>alert('Todos os campos precisam estar preenchidos.')</script>";
        echo "<script>window.location.href = '../views/projetos.php'</script>";
        exit();
    }
} else {
    echo "<script>window.location.href = '../views/home.php'</script>";
    exit();
}