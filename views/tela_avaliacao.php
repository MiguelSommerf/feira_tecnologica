<?php
require_once '../config/database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$id_projeto = isset($_POST['id_projeto']) ? (int)$_POST['id_projeto'] : null;
$titulo_projeto = isset($_POST['titulo_projeto']) ? $_POST['titulo_projeto'] : null;

$queryAluno = "SELECT " . TABELA_ALUNO['nome'] . " FROM " . TABELA_PROJETO_ALUNO['nome_tabela'] . " as i
                INNER JOIN " . TABELA_PROJETO['nome_tabela'] . " AS p ON p." . TABELA_PROJETO['id'] . " = i." . TABELA_PROJETO_ALUNO['projeto'] . "
                INNER JOIN " . TABELA_ALUNO['nome_tabela'] . " AS a ON a." . TABELA_ALUNO['id'] . " = i." . TABELA_PROJETO_ALUNO['aluno'] . "
                WHERE i." . TABELA_PROJETO_ALUNO['projeto'] . " = ?";
$stmtAluno = $mysqli->prepare($queryAluno);
$stmtAluno->bind_param("i", $id_projeto);
$stmtAluno->execute();
$resultAlunos = $stmtAluno->get_result();

$querySerieCurso = "SELECT DISTINCT a." . TABELA_ALUNO['serie'] . ", a." . TABELA_ALUNO['curso'] . " FROM " . TABELA_PROJETO['nome_tabela'] . " AS p
          INNER JOIN " . TABELA_PROJETO_ALUNO['nome_tabela'] . " AS i ON p." . TABELA_PROJETO['id'] . " = i." . TABELA_PROJETO_ALUNO['projeto'] . "
          INNER JOIN " . TABELA_ALUNO['nome_tabela'] . " AS a ON a." . TABELA_ALUNO['id'] . " = i." . TABELA_PROJETO_ALUNO['aluno'] . 
          " WHERE p.id_projeto = ?";
$stmtSerieCurso = $mysqli->prepare($querySerieCurso);
$stmtSerieCurso->bind_param("i", $id_projeto);
$stmtSerieCurso->execute();
$resultSerieCurso = $stmtSerieCurso->get_result();

if (!isset($_SESSION['id'])) {
    echo "<script>alert('Você precisa estar logado para acessar essa página.')</script>";
    echo "<script>window.location.href = 'tela_home.php'</script>";
    exit();
}

if (!isset($id_projeto)) {
    echo "<script>alert('Não há nenhum projeto selecionado)</script>";
    echo "<script>window.location.href = '../views/tela_projetos.php'</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação dos projetos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Karantina:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/avaliacao.css">
</head>
<body class="telaAvaliacao">
    <header>
      <div class="menu-toggle" id="mobile-menu">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
      </div>
      <div class="logo-container">
        <img src="../assets/img/etecmcm.png" alt="Logo MCM"/>
      </div>
      <div class="ORGInfoHeader">
        <h1>Avaliação</h1>
      </div>
    </header>
    <main>
        <button class="btn-voltar" onclick="window.location.href = '../views/tela_projetos.php'">Voltar</button>
        <div class="avaliacao-container">
            <div class="avaliacao-header">
                <div class="avaliacao-infos">
                    <div class="campo">
                        <input type="text" value="Projeto: <?= $titulo_projeto ?>" readonly>
                    </div>
                    <div class="campo">
                        <input type="text" value="Alunos: <?php while ($row = $resultAlunos->fetch_assoc()) echo $row['nome_aluno'] . '; ';
                        ?>" readonly/>
                    </div>
                    <div class="campo">
                        <input type="text" value="Série: <?php while ($rowSerieCurso = $resultSerieCurso->fetch_assoc()) echo $rowSerieCurso['serie_aluno'] . '° ' . $rowSerieCurso['curso_aluno']; ?>" readonly>
                    </div>
                </div>
            </div>
            <form action="../back/avaliacao.php" method="post">
                <input type="hidden" name="id_projeto" value="<?=$id_projeto?>">
                <div class="avaliacao-linha">
                    <span><strong>Nota:</strong></span>
                    <div class="avaliacao-estrelas-container">
                        <input type="hidden" name="estrelas" id="nota" value="" required>
                        <div class="avaliacao-estrelas" data-id="0"></div>
                    </div>
                </div>
                <div class="avaliacao-comentario">
                    <textarea name="comentario" class="avaliacao-textarea" placeholder="Deixe um comentário..."></textarea>
                    <button type="submit" class="avaliacao-button" id="">Enviar</button>
                </div>
            </form>
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
      <?php else: ?>
      <a href="tela_login.php">Entrar</a>
      <?php endif; ?>
    </div>
    <script>
        //Script da avalicao
        function criarEstrelas(container, numEstrelas = 5) {
        for (let i = 0; i < numEstrelas; i++) {
            const inputNota = document.getElementById('nota');
            const estrela = document.createElement("span");
            estrela.innerHTML = "★";
            estrela.classList.add("avaliacao-estrela");
            estrela.addEventListener("click", function () {
            const todasEstrelas = container.querySelectorAll(".avaliacao-estrela"); 
            todasEstrelas.forEach((s, idx) => {
                s.classList.toggle("checked", idx <= i);
            });
            
            inputNota.value = i + 1; 
            });
            container.appendChild(estrela);
        }
        }
        document.querySelectorAll('.avaliacao-estrelas').forEach(containerEstrela => {
        criarEstrelas(containerEstrela);
        });

        const formulario = document.querySelector('form');
        formulario.addEventListener('submit', function(e){
            const inputNota = document.getElementById('nota');

            if (inputNota.value === "") {
                alert('Selecione a quantidade de estrelas para enviar a avaliação.');
                e.preventDefault();
            }
        })
    </script>
    <script src="../assets/js/menuLateral.js"></script>
</body>
</html>