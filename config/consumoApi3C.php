<?php
require_once 'database.php';

$endpointProjetos = "https://etecmcm.com.br/feiraTecnologica-3C/Backend/api/projetos";
$dadosProjetos = json_decode(file_get_contents($endpointProjetos), true);

$queryDelete = "DELETE FROM " . TABELA_LOCALIZACAO_PROJETO['nome_tabela'];
$stmtDelete = $mysqli->prepare($queryDelete);
$stmtDelete->execute();

$queryDelete = "DELETE FROM " . TABELA_ODS_PROJETO['nome_tabela'];
$stmtDelete = $mysqli->prepare($queryDelete);
$stmtDelete->execute();

$queryDelete = "DELETE FROM " . TABELA_PROJETO_ALUNO['nome_tabela'];
$stmtDelete = $mysqli->prepare($queryDelete);
$stmtDelete->execute();

$queryDelete = "DELETE FROM " . TABELA_VOTO['nome_tabela'];
$stmtDelete = $mysqli->prepare($queryDelete);
$stmtDelete->execute();

$queryDelete = "DELETE FROM " . TABELA_PROJETO['nome_tabela'];
$stmtDelete = $mysqli->prepare($queryDelete);
$stmtDelete->execute();


foreach ($dadosProjetos as $id => $projeto) {
    $projeto = [
        'titulo_projeto' => $dadosProjetos[$id]['titulo_projeto'],
        'descricao_projeto' => $dadosProjetos[$id]['descricao'],
        'orientador_projeto' => "teste"//$dadosProjetos[$id]['orientador']
    ];

    $posicaoProjeto = [
        'bloco_projeto' => $dadosProjetos['bloco'],
        'sala_projeto'  => $dadosProjetos['sala'],
        'posicao_projeto' => $dadosProjetos['posicao']
    ];

    var_dump($projeto, $posicaoProjeto);
    die();

    $queryInsertProjeto = "INSERT INTO " . TABELA_PROJETO['nome_tabela'] . " VALUES (DEFAULT, ?, ?, ?)";
    $stmtInsertProjeto = $mysqli->prepare($queryInsertProjeto);
    $stmtInsertProjeto->bind_param("sss", $projeto['titulo_projeto'], $projeto['descricao_projeto'], $projeto['orientador_projeto']);


    //faltam os dados dos alunos para a inserção.
}