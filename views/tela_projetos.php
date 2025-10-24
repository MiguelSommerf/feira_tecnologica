<?php
#Modificado por Miguel Luiz Sommerfeld às 23:09 no dia 26/08/2025 - Team Leader (Turma B)
require_once '../config/database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Arrays para os selects
$blocos = ['A', 'B'];

// Captura os filtros
$filtroTitulo = !empty($_GET['titulo']) ? trim($_GET['titulo']) : null;
$filtroNome = !empty($_GET['nome']) ? trim($_GET['nome']) : null;
$filtroCurso = !empty($_GET['curso']) ? trim($_GET['curso']) : null;
$filtroSerie = !empty($_GET['serie']) ? trim($_GET['serie']) : null;
$filtroOds = !empty($_GET['ods']) ? trim($_GET['ods']) : null;
$filtroBloco = !empty($_GET['bloco']) ? trim($_GET['bloco']) : null;

// Query com filtros
$query = "SELECT DISTINCT a." . TABELA_ALUNO['serie'] . ",
         a." . TABELA_ALUNO['curso'] . ",
         p." . TABELA_PROJETO['id'] . ",
         p." . TABELA_PROJETO['titulo'] . ",
         p." . TABELA_PROJETO['descricao'] . ",
         lo." . TABELA_LOCALIZACAO_PROJETO['bloco'] . ",
         lo." . TABELA_LOCALIZACAO_PROJETO['sala'] . ",
         p." . TABELA_PROJETO['orientador'] . "
         FROM " . TABELA_PROJETO['nome_tabela'] . " AS p
         INNER JOIN " . TABELA_LOCALIZACAO_PROJETO['nome_tabela'] . " AS lo ON p." . TABELA_PROJETO['id'] . " = lo." . TABELA_LOCALIZACAO_PROJETO['projeto'] . "
         INNER JOIN " . TABELA_PROJETO_ALUNO['nome_tabela'] . " AS i ON p." . TABELA_PROJETO['id'] . " = i." . TABELA_PROJETO_ALUNO['projeto'] . "
         INNER JOIN " . TABELA_ALUNO['nome_tabela'] . " AS a ON a." . TABELA_ALUNO['id'] . " = i." . TABELA_PROJETO_ALUNO['aluno'] . "
         INNER JOIN " . TABELA_ODS_PROJETO['nome_tabela'] . " AS op ON op." . TABELA_ODS_PROJETO['projeto'] . " = p." . TABELA_PROJETO['id'] . "
         INNER JOIN " . TABELA_ODS['nome_tabela'] . " AS o ON o.". TABELA_ODS['id'] ." = op." . TABELA_ODS_PROJETO['ods'];

$params = [];
$types = "";

if ($filtroNome) {
    $query .= " AND a.". TABELA_ALUNO['nome'] ." LIKE ?";
    $params[] .= "%" . $filtroNome . "%";
    $types .= "s";
}

if ($filtroCurso) {
    $query .= " AND a." . TABELA_ALUNO['curso'] . " = ?";
    $params[] .= $filtroCurso;
    $types .= "s";
}

if ($filtroSerie) {
    $query .= " AND a." . TABELA_ALUNO['serie'] . " = ?";
    $params[] .= $filtroSerie;
    $types .= "s";
}

if ($filtroOds) {
    $query .= " AND o." . TABELA_ODS['nome'] . " LIKE ?";
    $params[] .= "%" . $filtroOds . "%";
    $types .= "s";
}

if ($filtroBloco) {
    $query .= " AND lo.". TABELA_LOCALIZACAO_PROJETO['bloco'] ." = ?";
    $params[] .= $filtroBloco;
    $types .= "s";
}

$stmt = $mysqli->prepare($query);

if ($params) {
    $stmt->bind_param($types, ...$params); // '...' o splat operator ou argument unpacking transforma um array em multiplos argumentos individuais, assim permite que eu passe um array como argumento na função bind_param()
}

$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projetos</title>
    <link rel="stylesheet" href="../assets/css/projetos.css">
</head>
<body>
    <main>
        <header>
            <a href="tela_home.php"><img class="setaVoltar" src="../assets/img/setaVoltar.png" alt="Voltar"></a>
            <img class="logoMCM" src="../assets/img/etecmcm.png" alt="Logo MCM">
        </header>
        <div class="filtros">
            <form method="GET">
                <select name="curso" id="curso" class="botao">
                    <option value="" disabled selected>Curso</option>
                    <option value="">Todos</option>
                    <?php
                    $queryCurso = "SELECT DISTINCT " . TABELA_ALUNO['curso'] . " FROM " . TABELA_ALUNO['nome_tabela'];
                    $resultCurso = $mysqli->query($queryCurso);
                    
                    while ($row = $resultCurso->fetch_assoc()):
                        $curso = $row['curso_aluno'];
                    ?>

                    <option value="<?= htmlspecialchars($curso) ?>" <?= $filtroCurso == $curso ? 'selected' : '' ?>>
                        <?= strtoupper(htmlspecialchars($curso)) ?>
                    </option>
                    
                    <?php endwhile; ?>
                </select>

                <select name="serie" id="serie" class="botao">
                    <option value="" disabled selected>Série</option>
                    <option value="">Todas</option>
                        <?php
                        $querySerie = "SELECT DISTINCT " . TABELA_ALUNO['serie'] . " FROM " . TABELA_ALUNO['nome_tabela'];
                        $resultSerie = $mysqli->query($querySerie);

                        while ($row = $resultSerie->fetch_assoc()):
                            $serie = $row['serie_aluno'];
                        ?>

                        <option value="<?= $serie ?>" <?= $filtroSerie == $serie ? 'selected' : '' ?>>
                            <?= strtoupper($serie) ?>
                        </option>
                        <?php endwhile; ?>
                </select>

                <select name="bloco" id="bloco" class="botao">
                    <option value="" disabled selected>Bloco</option>
                    <option value="">Todos</option>
                        <?php foreach ($blocos as $bloco): ?>
                            <option value="<?= $bloco ?>" <?= $filtroBloco == $bloco ? 'selected' : '' ?>>
                                <?= $bloco ?>
                            </option>
                        <?php endforeach; ?>
                </select>

                <input type="text" name="nome" id="nome" class="botao" value="<?php if (isset($filtroNome)) { echo htmlspecialchars($filtroNome); } ?>" placeholder="Nome do Aluno:">

                <input type="text" name="ods" id="ods" class="botao" value="" placeholder="Tema (ODS):">
                <button type="submit" class="botao">Filtrar</button>
            </form>
        </div>

        <h1>Resultados: <?=$result->num_rows ?></h1>
        <?php
            if ($result->num_rows > 0): ?>
            <div class='linha-projeto'>
                <?php
                while ($row = $result->fetch_assoc()):
                    $queryAluno = "SELECT " . TABELA_ALUNO['nome'] . " FROM " . TABELA_PROJETO_ALUNO['nome_tabela'] . " AS i
                                  INNER JOIN " . TABELA_PROJETO['nome_tabela'] . " AS p ON p." . TABELA_PROJETO['id'] . " = i." . TABELA_PROJETO_ALUNO['projeto'] . "
                                  INNER JOIN " . TABELA_ALUNO['nome_tabela'] . " AS a ON a." . TABELA_ALUNO['id'] . " = i." . TABELA_PROJETO_ALUNO['aluno'] . "
                                  WHERE i." . TABELA_PROJETO_ALUNO['projeto'] . " = ?";
                    $stmt = $mysqli->prepare($queryAluno);
                    $stmt->bind_param("i", $row['id_projeto']);
                    $stmt->execute();
                    $resultAlunos = $stmt->get_result();

                    $queryOds = "SELECT " . TABELA_ODS['nome'] . " FROM " . TABELA_ODS_PROJETO['nome_tabela'] . " AS op
                                INNER JOIN " . TABELA_PROJETO['nome_tabela'] . " AS p ON op." . TABELA_ODS_PROJETO['projeto'] . " = p." . TABELA_PROJETO['id'] . "
                                INNER JOIN " . TABELA_ODS['nome_tabela'] . " AS o ON o." . TABELA_ODS['id'] . " = op." . TABELA_ODS_PROJETO['ods'] . "
                    WHERE op." . TABELA_ODS_PROJETO['projeto'] . " = ?";
                    $stmtOds = $mysqli->prepare($queryOds);
                    $stmtOds->bind_param("i", $row['id_projeto']);
                    $stmtOds->execute();
                    $resultOds = $stmtOds->get_result();
        ?>
            <div class="projetos">
                <div class="projeto-nome">
                    <h3><?php
                            echo $row['titulo_projeto'];
                        ?>
                    </h3>
                </div>
                <div class="projeto-dados">
                    <p>
                        <bold>Local:</bold>
                        <?php
                            echo "Sala: " . htmlspecialchars($row['fk_id_sala']) . " - ";
                            if ($row['fk_id_bloco'] == 1) {
                                echo 'Bloco: A';
                            } else {
                                echo 'Bloco: B';
                            }
                        ?>
                    </p>
                    <p>
                        <bold>Curso:</bold>
                        <?php
                            echo ucfirst($row['serie_aluno']) . "° ";
                            echo strtoupper($row['curso_aluno']);
                        ?>
                    </p>
                    <p>
                        <bold>Alunos:</bold>
                        <?php
                        while ($rowAluno = $resultAlunos->fetch_assoc()) {
                            $aluno = $rowAluno['nome_aluno'];
                            echo htmlspecialchars($aluno) . "; ";
                        }
                        ?>
                    </p>
                    <p>
                        <bold>ODS:</bold>
                        <?php
                        while ($rowOds = $resultOds->fetch_assoc()) {
                            $ods = $rowOds['nome_ods'];
                            echo htmlspecialchars($ods) . "; ";
                        }
                        ?>
                    </p>
                    <p>
                        <bold>Orientador:</bold>
                        <?= htmlspecialchars($row['orientador_projeto']) ?>
                    </p>
                    <p>
                        <bold>Posição no Ranking:</bold>
                        <?= $row['posicao_projeto'] ?? 'Não definido' ?>
                    </p>
                    <form action="tela_avaliacao.php" method="post">
                        <input type="hidden" name="id_projeto" value="<?= $row['id_projeto']; ?>">
                        <input type="hidden" name="titulo_projeto" value="<?= $row['titulo_projeto']; ?>">
                        <button type="submit" class="avaliar">Avaliar</button>
                    </form>
                </div>
            </div>
                <?php endwhile; ?>
                <?php else: ?>
                    <h1>Nenhum trabalho encontrado com os filtros selecionados.</h1>
                <?php endif; ?>
        </div>
    </main>
</body>
</html>