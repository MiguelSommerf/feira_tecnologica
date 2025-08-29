<?php
require_once __DIR__ . '/../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tituloProjeto = !empty($_POST['titulo']) ? $_POST['titulo'] : null;
    $descricaoProjeto = !empty($_POST['descricao']) ? $_POST['descricao'] : null;
    $blocoProjeto = !empty($_POST['bloco']) ? $_POST['bloco'] : null;
    $salaProjeto = !empty($_POST['sala']) ? $_POST['sala'] : null;
    $standProjeto = !empty($_POST['stand']) ? $_POST['stand'] : null;
    $orientadorProjeto = !empty($_POST['orientador']) ? $_POST['orientador'] : null;

    if (isset($tituloProjeto) && isset($descricaoProjeto) && isset($blocoProjeto) && isset($salaProjeto) && isset($standProjeto) && isset($orientadorProjeto)) {

        $sqlVerificar = "SELECT " . TABELA_PROJETO['id'] . " FROM " 
                    . TABELA_PROJETO['nome_tabela'] . " WHERE " 
                    . TABELA_PROJETO['bloco'] . " = ? AND " 
                    . TABELA_PROJETO['sala'] . " = ? AND " 
                    . TABELA_PROJETO['stand'] . " = ?";

        $stmtVerificar = $mysqli->prepare($sqlVerificar);
        $stmtVerificar->bind_param("sss", $blocoProjeto, $salaProjeto, $standProjeto);
        $stmtVerificar->execute();
        $stmtVerificar->store_result();

        if ($stmtVerificar->num_rows > 0) {
            echo "<script>alert('Já existe um projeto cadastrado nesse Stand da mesma Sala e Bloco!')</script>";
            echo "<script>window.location.href = '../views/criar_projeto.php'</script>";
            $stmtVerificar->close();
            exit();
        }
        $stmtVerificar->close();

        $queryProjeto = "INSERT INTO " . TABELA_PROJETO['nome_tabela'] . " ("
                        . TABELA_PROJETO['titulo'] . ", "
                        . TABELA_PROJETO['descricao'] . ", "
                        . TABELA_PROJETO['bloco'] . ", "
                        . TABELA_PROJETO['sala'] . ", "
                        . TABELA_PROJETO['stand'] . ", "
                        . TABELA_PROJETO['orientador']
                        . ") VALUES (?, ?, ?, ?, ?, ?)";
        $stmtProjeto = $mysqli->prepare($queryProjeto);
        $stmtProjeto->bind_param("ssssis", $tituloProjeto, $descricaoProjeto, $blocoProjeto, $salaProjeto, $standProjeto, $orientadorProjeto);

        if ($stmtProjeto->execute()) {
            echo "<script>alert('Projeto criado com sucesso!')</script>";
        } else {
            echo "<script>alert('Ocorreu um erro ao inserir o projeto.')</script>";
            echo "<script>window.location.href = '../views/criar_projeto.php'</script>";
            exit();
        }

        echo "<script>window.location.href = '../views/projetos.php'</script>";
        exit();
    } else {
        echo "<script>alert('Todos os campos precisam estar preenchidos.')</script>";
        echo "<script>window.location.href = '../views/criar_projeto.php'</script>";
        exit();
    }
} else {
    echo "<script>window.location.href = '../views/home.php'</script>";
    exit();
}