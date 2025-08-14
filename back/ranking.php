<?php
require_once '../config/connect.php';

// Pega todos os nomes e id's diferentes dos projetos que receberam votos
$sql_nomes = "SELECT DISTINCT v.id_projetos, p.titulo_projeto FROM tbl_projetos as p
              INNER JOIN tb_votos AS v ON p.id_projetos = v.id_projetos";
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
        $id_projeto = $row['id_projetos'];
        $nomeProjeto = $row["titulo_projeto"];

        // proteção contra SQL Injection
        $nomeSeguro = $mysqli->real_escape_string($nomeProjeto);

        // pega o total de pontos que o projeto recebeu 
        $sql_total = "SELECT SUM(valor_voto) AS total FROM tb_votos WHERE id_projetos = ?";
        $stmt_total = $mysqli->prepare($sql_total);
        $stmt_total->bind_param("i", $id_projeto);
        $stmt_total->execute();
        $result_total = $stmt_total->get_result();
        
        $total = $result_total->fetch_assoc()["total"];

        // pega quantos votos esse projeto recebeu no total
        $sql_qtd_votos = "SELECT COUNT(*) AS qtd FROM tb_votos WHERE id_projetos = ?";
        $stmt_qtd_votos = $mysqli->prepare($sql_qtd_votos);
        $stmt_qtd_votos->bind_param("i", $id_projeto);
        $stmt_qtd_votos->execute();
        $result_qtd_votos = $stmt_qtd_votos->get_result();

        $qtd_votos = $result_qtd_votos->fetch_assoc()["qtd"];

        // conta quantas  5 esse projeto recebeu
        $sql_qtd_5 = "SELECT COUNT(*) AS qtd5 FROM tb_votos WHERE id_projetos = ? AND valor_voto = 5";
        $stmt_qtd_5 = $mysqli->prepare($sql_qtd_5);
        $stmt_qtd_5->bind_param("i", $id_projeto);
        $stmt_qtd_5->execute();
        $result_qtd_5 = $stmt_qtd_5->get_result();

        $qtd5 = $result_qtd_5->fetch_assoc()["qtd5"];

        // conta quantas 4 ou 5 ele recebeu
        $sql_qtd_45 = "SELECT COUNT(*) AS qtd45 FROM tb_votos WHERE id_projetos = ? AND valor_voto IN (4, 5)";
        $stmt_qtd_45 = $mysqli->prepare($sql_qtd_45);
        $stmt_qtd_45->bind_param("i", $id_projeto);
        $stmt_qtd_45->execute();
        $result_qtd_45 = $stmt_qtd_45->get_result();

        $qtd45 = $result_qtd_45->fetch_assoc()["qtd45"];

        // coloca isso no array de ranking 
        $ranking[] = [
            "nome" => $nomeProjeto,
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
        <div class="container-projeto">
            <div class="foto-perfil" alt="Foto de Perfil"></div>
    
            <div class="projetos">
                <div class="projeto-nome">Projeto ' . htmlspecialchars($item["nome"]) . ' - ' . htmlspecialchars($item["curso"]) . ' 
                    <div class="colocacao">' . $posicao . 'º lugar</div>
                </div>
                <div class="projeto-lugar">Sala ' . htmlspecialchars($item["sala"]) . ', Stand ' . htmlspecialchars($item["stand"]) . ' - Bloco ' . htmlspecialchars($item["bloco"]) . '</div>
            </div>
        </div>';
        
        $resultados[] = $linha;
        $posicao++;
    }

} else {
    echo "<script>alert('Nenhum projeto com votos ainda.')</script>";
    echo "<script>window.history.back()</script>";
    exit();
}
?>