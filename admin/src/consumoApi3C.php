<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../back/classes/Database.php';
set_time_limit(400);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['admin'])) {
    $url = '../../views/tela_home.php';
    header("Location: $url");
    exit();
}

set_time_limit(400);

$endpointProjetos = "https://etecmcm.com.br/feiraTecnologica-3C/Backend/api/projetos";
$endpointAlunosProjeto = "https://etecmcm.com.br/feiraTecnologica-3C/Backend/api/projetos/alunos";

$dadosProjetos = json_decode(file_get_contents($endpointProjetos), true);

//Limpando o banco
$database = new Database($mysqli);
$database->deletarDados(TABELA_LOCALIZACAO_PROJETO['nome_tabela']);
$database->resetarAutoIncrement(TABELA_LOCALIZACAO_PROJETO['nome_tabela']);
$database->deletarDados(TABELA_ODS_PROJETO['nome_tabela']);
$database->resetarAutoIncrement(TABELA_ODS_PROJETO['nome_tabela']);
$database->deletarDados(TABELA_PROJETO_ALUNO['nome_tabela']);
$database->resetarAutoIncrement(TABELA_PROJETO_ALUNO['nome_tabela']);
$database->deletarDados(TABELA_ALUNO['nome_tabela']);
$database->resetarAutoIncrement(TABELA_ALUNO['nome_tabela']);
$database->votoInsert(true);
$database->deletarDados(TABELA_VOTO['nome_tabela']);
$database->resetarAutoIncrement(TABELA_VOTO['nome_tabela']);
$database->deletarDados(TABELA_PROJETO['nome_tabela']);
$database->resetarAutoIncrement(TABELA_PROJETO['nome_tabela']);

foreach ($dadosProjetos as $id => $projeto) {
    $projeto = [
        'titulo_projeto' => !empty($dadosProjetos[$id]['titulo_projeto']) ? $dadosProjetos[$id]['titulo_projeto'] : "",
        'descricao_projeto' => !empty($dadosProjetos[$id]['descricao']) ? $dadosProjetos[$id]['descricao'] : "",
        'orientador_projeto' => !empty($dadosProjetos[$id]['orientador']) ? $dadosProjetos[$id]['orientador'] : ""
    ];

    if ($dadosProjetos[$id]['bloco'] === 'A') {
        $bloco = 1;
    }

    if ($dadosProjetos[$id]['bloco'] === 'B') {
        $bloco = 2;
    }

    $posicaoProjeto = [
        'bloco_projeto' => !empty($bloco) ? $bloco : "",
        'sala_projeto'  => 1
    ];

    if ($dadosProjetos[$id]['sala'] !== '24') {
        $posicaoProjeto['sala_projeto'] = $dadosProjetos[$id]['sala'];
    }

    //Inserindo projetos
    $queryInsertProjeto = "INSERT INTO " . TABELA_PROJETO['nome_tabela'] . " VALUES (DEFAULT, ?, ?, ?)";
    $stmtInsertProjeto = $mysqli->prepare($queryInsertProjeto);
    $stmtInsertProjeto->bind_param("sss", $projeto['titulo_projeto'], $projeto['descricao_projeto'], $projeto['orientador_projeto']);
    $stmtInsertProjeto->execute();
    $stmtInsertProjeto->close();

    $queryIdProjeto = "SELECT " . TABELA_PROJETO['id'] . " FROM " . TABELA_PROJETO['nome_tabela'] . " WHERE " . TABELA_PROJETO['descricao'] . " = (?)";
    $stmtIdProjeto = $mysqli->prepare($queryIdProjeto);
    $stmtIdProjeto->bind_param("s", $projeto['descricao_projeto']);
    $stmtIdProjeto->execute();
    $resultIdProjeto = $stmtIdProjeto->get_result()->fetch_assoc();

    if ($dadosProjetos[$id]['id_projeto'] !== 0) {
        $idProjeto = json_encode([
            'id_projeto' => (int) $dadosProjetos[$id]['id_projeto']
        ]);

        $resultOds = $database->postApi('https://etecmcm.com.br/feiraTecnologica-3C/Backend/api/projetos/ods-projeto', $idProjeto);

        //Inserindo na tabela relacional de ODS's e projetos
        foreach ($resultOds as $ods) {
            $queryOdsProjeto = "INSERT INTO " . TABELA_ODS_PROJETO['nome_tabela'] . " VALUES (?, ?)";
            $stmtOdsProjeto = $mysqli->prepare($queryOdsProjeto);
            $stmtOdsProjeto->bind_param("ii", $ods->id_ods, $resultIdProjeto['id_projeto']);
            $stmtOdsProjeto->execute();
        }

        $resultAlunos = $database->postApi('https://etecmcm.com.br/feiraTecnologica-3C/Backend/api/projetos/alunos', $idProjeto);

        foreach ($resultAlunos as $aluno) {
            $nomeALuno = $aluno->nome_aluno;
            $serieAluno = substr($aluno->id_aluno, 0, 1);
            $cursoAluno = substr($aluno->id_aluno, 1, 1);

            if ($cursoAluno === 'A' or $cursoAluno === 'D') {
                $cursoAluno = 'Administração';
            }
            
            if ($cursoAluno === 'B' or $cursoAluno === 'R') {
                $cursoAluno = 'Recursos Humanos';
            }
            
            if ($cursoAluno === 'C' or $cursoAluno === 'F') {
                $cursoAluno = 'Informática';
            }

            if ($cursoAluno === 'I' or $cursoAluno === 'H') {
                $cursoAluno = 'Química';
            }

            if ($cursoAluno === 'K') {
                $cursoAluno = 'Logística';
            }

            //Inserindo alunos
            $queryInsertAluno = "INSERT INTO " . TABELA_ALUNO['nome_tabela'] . " VALUES (DEFAULT, ?, ?, ?)";
            $stmtInsertAluno = $mysqli->prepare($queryInsertAluno);
            $stmtInsertAluno->bind_param("sss", $nomeALuno, $serieAluno, $cursoAluno);
            $stmtInsertAluno->execute();

            $querySelectAluno = "SELECT " . TABELA_ALUNO['id'] . " FROM " . TABELA_ALUNO['nome_tabela'] . " WHERE " . TABELA_ALUNO['nome'] . " = (?) AND " . TABELA_ALUNO['serie'] . " = (?) AND " . TABELA_ALUNO['curso'] . " = (?)";
            $stmtSelectAluno = $mysqli->prepare($querySelectAluno);
            $stmtSelectAluno->bind_param("sss", $nomeALuno, $serieAluno, $cursoAluno);
            $stmtSelectAluno->execute();
            $idAluno = $stmtSelectAluno->get_result()->fetch_assoc();
            $stmtSelectAluno->close();

            //Inserindo na tabela relacional de projetos e alunos
            $queryInsertProjetoAluno = "INSERT INTO " . TABELA_PROJETO_ALUNO['nome_tabela'] . " VALUES (?, ?)";
            $stmtInsertProjetoAluno = $mysqli->prepare($queryInsertProjetoAluno);
            $stmtInsertProjetoAluno->bind_param("ii", $resultIdProjeto['id_projeto'], $idAluno['id_aluno']);
            $stmtInsertProjetoAluno->execute();
        }

        //Inserindo localização projeto
        $queryLocalizacao = "INSERT INTO " . TABELA_LOCALIZACAO_PROJETO['nome_tabela'] . " VALUES (?, ?, ?)";
        $stmtLocalizacao = $mysqli->prepare($queryLocalizacao);
        $stmtLocalizacao->bind_param("iii", $posicaoProjeto['bloco_projeto'], $posicaoProjeto['sala_projeto'], $resultIdProjeto['id_projeto']);
        $stmtLocalizacao->execute();
    }
}

$database->votoInsert(false);

$url = '../views/home.php';
header("Location: $url");