<?php
#Modificado por Miguel Luiz Sommerfeld às 23:09 no dia 26/08/2025 - Team Leader (Turma B)
require_once '../config/database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Arrays para os selects
$blocos = ['A', 'B'];

// Captura os filtros
$filtroTitulo = !empty($filtroTitulo) ? trim($_GET['titulo']) : null;
$filtroNome = !empty($filtroNome) ? trim($_GET['nome']) : null;
$filtroCurso = !empty($filtroCurso) ? trim($_GET['curso']) : null;
$filtroSerie = !empty($filtroSerie) ? trim($_GET['serie']) : null;
$filtroOds = !empty($filtroOds) ? trim($_GET['ods']) : null;
$filtroBloco = !empty($filtroBloco) ? trim($_GET['bloco']) : null;

// Query com filtros
$query = "SELECT DISTINCT a." . TABELA_ALUNO['serie'] . ",
         a." . TABELA_ALUNO['curso'] . ",
         p." . TABELA_PROJETO['id'] . ",
         p." . TABELA_PROJETO['titulo'] . ",
         p." . TABELA_PROJETO['descricao'] . ",
         lo." . TABELA_LOCALIZACAO_PROJETO['bloco'] . ",
         lo." . TABELA_LOCALIZACAO_PROJETO['sala'] . ",
         lo." . TABELA_LOCALIZACAO_PROJETO['stand'] . ",
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Grenze:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script type="text/javascript" src="https://cdn.rybena.com.br/dom/master/latest/rybena.js"></script>
    <link rel="stylesheet" href="../assets/css/filtro.css">
</head>
<body class="TelaProjetos">
    <header>
        <div class="menu-toggle" id="mobile-menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
        <div class="logo-container">
            <img src="../assets/img/etecmcm.png" alt="Logo MCM" />
        </div>
        <div class="ORGInfoHeader">
            <h1>Projetos</h1>
        </div>
    </header>

    <main class="main-projetos">
        <button class="btn-voltar" onclick="window.location.href = '../views/tela_home.php'">Voltar</button>
        <div class="filtros">
            <form method="GET">
                <select name="curso" id="curso" class="botao">
                    <option value="" disabled selected>Curso</option>
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

        <h2>Resultados: <?=$result->num_rows ?></h2>
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
                        echo $row['titulo_projeto'] . " - ";
                        echo ucfirst($row['serie_aluno']) . "° ";
                        echo strtoupper($row['curso_aluno']); ?>
                    </h3>
                </div>
                <div class="projeto-lugar">
                    <?php
                    echo "Sala: " . htmlspecialchars($row['fk_id_sala']) . " - ";
                    echo "Stand: " . htmlspecialchars($row['fk_id_stand']) . " - ";
                    echo "Bloco: " . htmlspecialchars($row['fk_id_bloco']);
                    ?>
                </div>
                <div class="projeto-lugar">
                    <p><strong>Alunos:</strong>
                        <?php
                        while ($rowAluno = $resultAlunos->fetch_assoc()) {
                            $aluno = $rowAluno['nome_aluno'];
                            echo htmlspecialchars($aluno) . "; ";
                        }
                        ?>
                    </p>
                    <p><strong>ODS:</strong>
                        <?php
                        while ($rowOds = $resultOds->fetch_assoc()) {
                            $ods = $rowOds['nome_ods'];
                            echo htmlspecialchars($ods) . "; ";
                        }
                        ?>
                    </p>
                    <p><strong>Orientador:</strong>
                        <?= htmlspecialchars($row['orientador_projeto']) ?>
                    </p>
                    <p><strong>Posição no Ranking:</strong>
                        <?= $row['posicao_projeto'] ?? '?' ?>
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
    <div id="mySideMenu" class="side-menu">
        <a href="javascript:void(0)" id="close-btn" class="close-btn">&times;</a>
        <a href="../index.php">Início</a>
        <?php if (!empty($_SESSION['admin'])): ?>
        <a href="../admin/views/home.php">Admin</a>
        <?php endif; ?>
        <a href="tela_mapa.php">Mapa</a>
        <a href="tela_projetos.php">Projetos</a>
        <a href="tela_ranking.php">Ranking</a>
        <a href="tela_cursos.php">Cursos</a>
        <a href="tela_sobreEtec.php">Sobre a Etec</a>
        <?php if(isset($_SESSION['id'])): ?>
        <a href="../back/logout.php" class="deslogar" id="deslogar" name="deslogar">Sair da Conta</a>
        <?php endif; ?>
    </div>
    <script src="../assets/js/menuLateral.js"></script>
</body>
</html>