<?php
require_once 'database.php';

$endpointProjetos = "https://etecmcm.com.br/feiraTecnologica-3C/Backend/api/projetos";
$dadosProjetos = json_decode(file_get_contents($endpointProjetos), true);

$queryDelete = "DELETE FROM " . TABELA_PROJETO['nome_tabela'];

foreach ($dadosProjetos as $projeto) {
    $projeto = [
        'titulo_projeto' => $dadosProjetos['titulo_projeto'],
        'descricao_projeto' => $dadosProjetos['descricao'],
        'orientador_projeto' => $dadosProjetos['orientador']
    ];

    $posicaoProjeto = [
        'bloco_projeto' => $dadosProjetos['bloco'],
        'sala_projeto'  => $dadosProjetos['sala'],
        'posicao_projeto' => $dadosProjetos['posicao'],
        'stand_projeto'   => 1//$dados['stand']
    ];

    $queryInsertProjeto = "INSERT INTO " . TABELA_PROJETO['nome_tabela'] . " VALUES (DEFAULT, ?, ?, ?,)";
    $stmtInsertProjeto = $mysqli->prepare($queryInsertProjeto);
    $stmtInsertProjeto->bind_param("sss", $projeto['titulo_projeto'], $projeto['descricao_projeto'], $projeto['orientador_projeto']);


    //faltam os dados dos alunos para a inserção.
}