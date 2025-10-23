<?php
require_once '../config/database.php';

// Pega todos os nomes e id's diferentes dos projetos que receberam votos
$sql_nomes = "SELECT DISTINCT v." . TABELA_VOTO['projeto'] . ", " . "p." . TABELA_PROJETO['titulo'] . ", " . "b." . TABELA_BLOCO['bloco'] . ", " . "sa." . TABELA_SALA['sala'] . ", " . "sa." . TABELA_SALA['sala'] . ", " . "a." . TABELA_ALUNO['serie'] . ", " . "a." . TABELA_ALUNO['curso'] . " FROM " . TABELA_PROJETO['nome_tabela'] . " as p
              INNER JOIN " . TABELA_VOTO['nome_tabela'] . " AS v ON p." . TABELA_PROJETO['id'] . " = v." . TABELA_VOTO['projeto'] . "
              INNER JOIN " . TABELA_PROJETO_ALUNO['nome_tabela'] . " AS i ON i." . TABELA_PROJETO_ALUNO['projeto'] . " = p." . TABELA_PROJETO['id'] . " 
              INNER JOIN " . TABELA_LOCALIZACAO_PROJETO['nome_tabela'] . " AS lp ON lp." . TABELA_LOCALIZACAO_PROJETO['projeto'] . " = p." . TABELA_PROJETO['id'] . " 
              INNER JOIN " . TABELA_BLOCO['nome_tabela'] . " AS b on b." . TABELA_BLOCO['id'] . " = lp." . TABELA_LOCALIZACAO_PROJETO['bloco'] . " 
              INNER JOIN " . TABELA_SALA['nome_tabela'] . " AS sa ON sa." . TABELA_SALA['id'] . " = lp." . TABELA_LOCALIZACAO_PROJETO['sala'] . " 
              INNER JOIN " . TABELA_ALUNO['nome_tabela'] . " AS a ON a." . TABELA_ALUNO['id'] . " = i." . TABELA_PROJETO_ALUNO['aluno'];
$stmt = $mysqli->prepare($sql_nomes);
$stmt->execute();
$result_nomes = $stmt->get_result();

// cria um array vazio para guardar o ranking
$ranking = [];

$resultados = [];

// se realmente encontrar os nomes
if ($result_nomes->num_rows > 0) {

    // vai percorrendo cada nome de projeto
    while ($row = $result_nomes->fetch_assoc()) {
        $id_projeto = $row['fk_id_projeto'];
        $nomeProjeto = $row["titulo_projeto"];
        $blocoProjeto = $row['nome_bloco'];
        $salaProjeto = $row['nome_sala'];
        $serieAluno = $row['serie_aluno'];
        $cursoProjeto = $row['curso_aluno'];

        // proteção contra SQL Injection
        $nomeSeguro = $mysqli->real_escape_string($nomeProjeto);

        // pega o total de pontos que o projeto recebeu 
        $sql_total = "SELECT SUM(". TABELA_VOTO['valor'] . ") AS total FROM " . TABELA_VOTO['nome_tabela'] . " WHERE " . TABELA_VOTO['projeto'] . " = ?";
        $stmt_total = $mysqli->prepare($sql_total);
        $stmt_total->bind_param("i", $id_projeto);
        $stmt_total->execute();
        $result_total = $stmt_total->get_result();
        
        $total = $result_total->fetch_assoc()["total"];

        // pega quantos votos esse projeto recebeu no total
        $sql_qtd_votos = "SELECT COUNT(*) AS qtd FROM " . TABELA_VOTO['nome_tabela'] . " WHERE " . TABELA_VOTO['projeto'] . " = ?";
        $stmt_qtd_votos = $mysqli->prepare($sql_qtd_votos);
        $stmt_qtd_votos->bind_param("i", $id_projeto);
        $stmt_qtd_votos->execute();
        $result_qtd_votos = $stmt_qtd_votos->get_result();

        $qtd_votos = $result_qtd_votos->fetch_assoc()["qtd"];

        // conta quantas  5 esse projeto recebeu
        $sql_qtd_5 = "SELECT COUNT(*) AS qtd5 FROM " . TABELA_VOTO['nome_tabela'] . " WHERE " . TABELA_VOTO['projeto'] . " = ? AND " . TABELA_VOTO['valor'] . " = 5";
        $stmt_qtd_5 = $mysqli->prepare($sql_qtd_5);
        $stmt_qtd_5->bind_param("i", $id_projeto);
        $stmt_qtd_5->execute();
        $result_qtd_5 = $stmt_qtd_5->get_result();

        $qtd5 = $result_qtd_5->fetch_assoc()["qtd5"];

        // conta quantas 4 ou 5 ele recebeu
        $sql_qtd_45 = "SELECT COUNT(*) AS qtd45 FROM " . TABELA_VOTO['nome_tabela'] . " WHERE " . TABELA_VOTO['projeto'] . " = ? AND " . TABELA_VOTO['valor'] . " IN (4, 5)";
        $stmt_qtd_45 = $mysqli->prepare($sql_qtd_45);
        $stmt_qtd_45->bind_param("i", $id_projeto);
        $stmt_qtd_45->execute();
        $result_qtd_45 = $stmt_qtd_45->get_result();

        $qtd45 = $result_qtd_45->fetch_assoc()["qtd45"];

        // coloca isso no array de ranking 
        $ranking[] = [
            "nome" => $nomeProjeto,
            "serie" => $serieAluno,
            "curso" => $cursoProjeto,
            "bloco" => $blocoProjeto,
            "sala" => $salaProjeto,
            "total" => (int)$total,
            "qtd_votos" => (int)$qtd_votos,
            "qtd5" => (int)$qtd5,
            "qtd45" => (int)$qtd45
        ];
    }

    // parte que ordena o ranking 
    usort($ranking, function ($a, $b) {

        // primeiro compara o total de pontos, lembrando que o maior vence
        if ($b["total"] != $a["total"]) {
            return $b["total"] - $a["total"];
        }

        // se empatar no total, vence quem teve menos votos
        if ($a["qtd_votos"] != $b["qtd_votos"]) {
            return $a["qtd_votos"] - $b["qtd_votos"];
        }

        // se ainda empatar, vai pelo que recebeu mais notas 5
        if ($b["qtd5"] != $a["qtd5"]) {
            return $b["qtd5"] - $a["qtd5"];
        }

        // e se ainda empatar, quem teve mais 4 e 5 juntos vence
        return $b["qtd45"] - $a["qtd45"];
    });


    // mostra o ranking tudo certo aqui embaixo  
    $posicao = 1;
    foreach ($ranking as $item) {
        $linha = '
        <div class="projetos">
        <div class="projeto-nome">Projeto: ' . htmlspecialchars($item["nome"]) . ' 
        <div class="colocacao">' . $posicao . 'º lugar</div>
        </div>
        <div class="projeto-dados">Turma: ' . $item["serie"] . 'º ' . $item["curso"] . '</div>
        </div>';
        
        // Se a posição for uma dessas, a linha fica nula.
        if ($posicao == 1 || $posicao == 2 || $posicao == 3) {
            $linha = "";
            $rank = $posicao;
        }

        if ($rank) {
            $nome[] = $item["nome"];
            $top[] = $posicao;
        }

        $resultados[] = $linha;
        $posicao++;
    }

} else {
    echo "<script>alert('Nenhum projeto com votos ainda.')</script>";
    echo "<script>window.location.href = '../views/tela_projetos.php'</script>";
    exit();
}
