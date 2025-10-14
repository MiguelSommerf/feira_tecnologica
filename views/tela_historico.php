<?php
require_once '../config/database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Consulta principal de projetos
$query = "SELECT DISTINCT 
            a." . TABELA_ALUNO['serie'] . " AS serie_aluno,
            a." . TABELA_ALUNO['curso'] . " AS curso_aluno,
            p." . TABELA_PROJETO['id'] . " AS id_projeto,
            p." . TABELA_PROJETO['titulo'] . " AS titulo_projeto,
            p." . TABELA_PROJETO['descricao'] . " AS descricao_projeto,
            lo." . TABELA_LOCALIZACAO_PROJETO['bloco'] . " AS fk_id_bloco,
            lo." . TABELA_LOCALIZACAO_PROJETO['sala'] . " AS fk_id_sala,
            lo." . TABELA_LOCALIZACAO_PROJETO['stand'] . " AS fk_id_stand,
            p." . TABELA_PROJETO['orientador'] . " AS orientador_projeto
          FROM " . TABELA_PROJETO['nome_tabela'] . " AS p
          INNER JOIN " . TABELA_LOCALIZACAO_PROJETO['nome_tabela'] . " AS lo 
              ON p." . TABELA_PROJETO['id'] . " = lo." . TABELA_LOCALIZACAO_PROJETO['projeto'] . "
          INNER JOIN " . TABELA_PROJETO_ALUNO['nome_tabela'] . " AS i 
              ON p." . TABELA_PROJETO['id'] . " = i." . TABELA_PROJETO_ALUNO['projeto'] . "
          INNER JOIN " . TABELA_ALUNO['nome_tabela'] . " AS a 
              ON a." . TABELA_ALUNO['id'] . " = i." . TABELA_PROJETO_ALUNO['aluno'] . "
          INNER JOIN " . TABELA_ODS_PROJETO['nome_tabela'] . " AS op 
              ON op." . TABELA_ODS_PROJETO['projeto'] . " = p." . TABELA_PROJETO['id'] . "
          INNER JOIN " . TABELA_ODS['nome_tabela'] . " AS o 
              ON o." . TABELA_ODS['id'] . " = op." . TABELA_ODS_PROJETO['ods'];

$stmt = $mysqli->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Grenze:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script type="text/javascript" src="https://cdn.rybena.com.br/dom/master/latest/rybena.js"></script>
    <link rel="stylesheet" href="../assets/css/projetos.css">
</head>
<body>
<main>
    <h1>Projetos Avaliados</h1>

    <?php if ($result->num_rows > 0): ?>
        <div class='linha-projeto'>
            <?php while ($row = $result->fetch_assoc()): ?>

                <?php
                // Busca alunos do projeto
                $queryAluno = "SELECT " . TABELA_ALUNO['nome'] . " AS nome_aluno 
                               FROM " . TABELA_PROJETO_ALUNO['nome_tabela'] . " AS i
                               INNER JOIN " . TABELA_ALUNO['nome_tabela'] . " AS a 
                                   ON a." . TABELA_ALUNO['id'] . " = i." . TABELA_PROJETO_ALUNO['aluno'] . "
                               WHERE i." . TABELA_PROJETO_ALUNO['projeto'] . " = ?";
                $stmtAluno = $mysqli->prepare($queryAluno);
                $stmtAluno->bind_param("i", $row['id_projeto']);
                $stmtAluno->execute();
                $resultAlunos = $stmtAluno->get_result();

                // Busca ODS do projeto
                $queryOds = "SELECT " . TABELA_ODS['nome'] . " AS nome_ods 
                             FROM " . TABELA_ODS_PROJETO['nome_tabela'] . " AS op
                             INNER JOIN " . TABELA_ODS['nome_tabela'] . " AS o 
                                 ON o." . TABELA_ODS['id'] . " = op." . TABELA_ODS_PROJETO['ods'] . "
                             WHERE op." . TABELA_ODS_PROJETO['projeto'] . " = ?";
                $stmtOds = $mysqli->prepare($queryOds);
                $stmtOds->bind_param("i", $row['id_projeto']);
                $stmtOds->execute();
                $resultOds = $stmtOds->get_result();
                ?>

                <div class="projetos">
                    <div class="projeto-nome">
                        <h3><?= htmlspecialchars($row['titulo_projeto']); ?></h3>
                    </div>
                    <div class="projeto-dados">
                        <p>
                            <b>Local:</b>
                            <?php
                                echo "Sala: " . htmlspecialchars($row['fk_id_sala']) . " - ";
                                echo "Stand: " . htmlspecialchars($row['fk_id_stand']) . " - ";
                                echo "Bloco: " . ($row['fk_id_bloco'] == 1 ? 'A' : 'B');
                            ?>
                        </p>

                        <p>
                            <b>Curso:</b>
                            <?= ucfirst($row['serie_aluno']) . "° " . strtoupper($row['curso_aluno']); ?>
                        </p>

                        <p>
                            <b>Alunos:</b>
                            <?php while ($rowAluno = $resultAlunos->fetch_assoc()): ?>
                                <?= htmlspecialchars($rowAluno['nome_aluno']) ?>;
                            <?php endwhile; ?>
                        </p>

                        <p>
                            <b>ODS:</b>
                            <?php while ($rowOds = $resultOds->fetch_assoc()): ?>
                                <?= htmlspecialchars($rowOds['nome_ods']) ?>;
                            <?php endwhile; ?>
                        </p>

                        <p>
                            <b>Orientador:</b>
                            <?= htmlspecialchars($row['orientador_projeto']); ?>
                        </p>

                        <p>
                            <b>Posição no Ranking:</b>
                            <?= $row['posicao_projeto'] ?? 'Não definido'; ?>
                        </p>
                    </div>
                </div>

            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <h2 style="text-align:center;">Nenhum trabalho encontrado.</h2>
    <?php endif; ?>
</main>
</body>
</html>
