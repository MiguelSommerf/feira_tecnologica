<?php
#Modificado por Miguel Luiz Sommerfeld às 16:53 no dia 10/06/2025 - Team Leader (Turma B)
require_once '../config/connect.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Arrays para os selects
$blocos = ['A', 'B'];

// Captura os filtros
$filtroTitulo = trim($_GET['titulo'] ?? null);
$filtroNome = trim($_GET['nome'] ?? null);
$filtroCurso = trim($_GET['curso'] ?? null);
$filtroSerie = trim($_GET['serie'] ?? null);
$filtroOds = trim($_GET['ods'] ?? null);
$filtroBloco = trim($_GET['bloco'] ?? null);

// Query com filtros
$query = "SELECT DISTINCT a.serie, a.curso, p.id_projetos, p.titulo_projeto, p.descricao_projeto,
          p.bloco, p.sala, p.stand, p.prof_orientador
          FROM tbl_projetos AS p
          INNER JOIN tb_integrantes AS i ON p.id_projetos = i.id_projetos
          INNER JOIN tbl_alunos AS a ON a.id_aluno = i.id_aluno
          INNER JOIN ods_projeto AS op ON op.id_projetos = p.id_projetos
          INNER JOIN tbl_ods AS o ON o.id_ods = op.id_ods";

$params = [];
$types = "";

if ($filtroNome) {
    $query .= " AND a.nome LIKE ?";
    $params[] .= "%" . $filtroNome . "%";
    $types .= "s";
}

if ($filtroCurso) {
    $query .= " AND a.curso = ?";
    $params[] .= $filtroCurso;
    $types .= "s";
}

if ($filtroSerie) {
    $query .= " AND a.serie = ?";
    $params[] .= $filtroSerie;
    $types .= "s";
}

if ($filtroOds) {
    $query .= " AND o.ods LIKE ?";
    $params[] .= "%" . $filtroOds . "%";
    $types .= "s";
}

if ($filtroBloco) {
    $query .= " AND p.bloco = ?";
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
        <button class="btn-voltar" onclick="history.back()">Voltar</button>
    
        <div class="filtros">
            <form method="GET">
                <select name="curso" id="curso" class="botao">
                    <option value="" disabled selected>Curso</option>
                    <?php
                    $queryCurso = "SELECT DISTINCT curso FROM tbl_alunos";
                    $resultCurso = $mysqli->query($queryCurso);
                    
                    while ($row = $resultCurso->fetch_assoc()):
                        $curso = $row['curso'];
                    ?>

                    <option value="<?= $curso ?>" <?= $filtroCurso == $curso ? 'selected' : '' ?>>
                        <?= strtoupper($curso) ?>
                    </option>
                    
                    <?php endwhile; ?>
                </select>

                <select name="serie" id="serie" class="botao">
                    <option value="" disabled selected>Série</option>
                    <option value="">Todas</option>
                        <?php
                        $querySerie = "SELECT DISTINCT serie FROM tbl_alunos";
                        $resultSerie = $mysqli->query($querySerie);

                        while ($row = $resultSerie->fetch_assoc()):
                            $serie = $row['serie'];
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

                <input type="text" name="orientador" id="orientador" class="botao" placeholder="Orientador">

                <input type="text" name="nome" id="nome" class="botao" value="<?= htmlspecialchars($filtroNome ?? null) ?>" placeholder="Nome do Aluno:">

                <input type="text" name="ods" id="ods" class="botao" value="" placeholder="Tema (ODS):">
                <button type="submit" class="botao">Filtrar</button>
            </form>
        </div>

        <h2>Resultados: <?=$result->num_rows ?></h2>
        <?php
        if ($result->num_rows > 0) :
            while ($row = $result->fetch_assoc()) :
                $queryAluno = "SELECT nome FROM tb_integrantes as i
                            INNER JOIN tbl_projetos AS p ON p.id_projetos = i.id_projetos
                            INNER JOIN tbl_alunos as a ON a.id_aluno = i.id_aluno
                            WHERE i.id_projetos = ?";
                $stmt = $mysqli->prepare($queryAluno);
                $stmt->bind_param("i", $row['id_projetos']);
                $stmt->execute();
                $resultAlunos = $stmt->get_result();

                $queryOds = "SELECT ods FROM ods_projeto AS op
                            INNER JOIN tbl_projetos as p ON op.id_projetos = p.id_projetos
                            INNER JOIN tbl_ods AS o ON o.id_ods = op.id_ods
                WHERE op.id_projetos = ?";
                $stmtOds = $mysqli->prepare($queryOds);
                $stmtOds->bind_param("i", $row['id_projetos']);
                $stmtOds->execute();
                $resultOds = $stmtOds->get_result();
        ?>

        <div class="linha-projeto">
            <div class="container-projeto">

                <div class="projetos">
                    <div class="projeto-nome">
                        <h3><?php
                            echo $row['titulo_projeto'] . " - ";
                            echo ucfirst($row['serie']) . " ";
                            echo strtoupper($row['curso']); ?>
                        </h3>
                    </div>
                    
                    <div class="projeto-lugar">
                        <?php
                        echo "Sala: " . htmlspecialchars($row['sala']) . " - ";
                        echo "Stand: " . htmlspecialchars($row['stand']) . " - ";
                        echo "Bloco: " . htmlspecialchars($row['bloco']);
                        ?>
                    </div>
                    <div class="projeto-lugar">
                        <p><strong>Aluno:</strong>
                            <?php
                            while ($rowAluno = $resultAlunos->fetch_assoc()) {
                                $aluno = $rowAluno['nome'];
                                echo htmlspecialchars($aluno) . "; ";
                            }
                            ?>
                        </p>
                        <p><strong>ODS:</strong>
                            <?php
                            while ($rowOds = $resultOds->fetch_assoc()) {
                                $ods = $rowOds['ods'];
                                echo htmlspecialchars($ods) . "; ";
                            }
                            ?>
                        </p>
                        <p><strong>Orientador:</strong>
                            <?= htmlspecialchars($row['prof_orientador']) ?>
                        </p>
                        <p><strong>Posição no Ranking:</strong>
                            <?= $row['posicao'] ?? '?' ?>
                        </p>
                    </div>
                        <?php endwhile; ?>
                        <?php else: ?>
                            <h1>Nenhum trabalho encontrado com os filtros selecionados.</h1>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="mySideMenu" class="side-menu">
        <a href="javascript:void(0)" class="close-btn" onclick="closeMenu()">&times;</a>
        <a href="tela_mapa.php">Mapa</a>
        <a href="tela_projetos.php">Projetos</a>
        <a href="tela_ranking.php">Ranking</a>
        <a href="tela_cursos.php">Cursos</a>
        <a href="tela_sobreEtec.php">Sobre a Etec</a>
        <a href="../index.php">Início</a>
        <?php if(isset($_SESSION['id'])): ?>
        <a href="../back/logout.php" class="deslogar" id="deslogar" name="deslogar">Sair da Conta</a>
        <?php endif; ?>
    </div>
    

    <script>
        document
            .getElementById("mobile-menu")
            .addEventListener("click", function () {
                this.classList.toggle("active");
                openMenu();
            });

        function openMenu() {
            document.getElementById("mySideMenu").style.width = "250px";
        }

        function closeMenu() {
            document.getElementById("mySideMenu").style.width = "0";
            document.getElementById("mobile-menu").classList.remove("active");
        }
    </script>
</body>

</html>
