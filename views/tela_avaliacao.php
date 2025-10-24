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
    <title>Avalie esse projeto</title>
    <link rel="stylesheet" href="../assets/css/avaliacao.css">
</head>
<body>
    <main>
        <header>
            <a href="tela_home.php"><img class="setaVoltar" src="../assets/img/setaVoltar.png" alt="Voltar"></a>
            <img class="logoMCM" src="../assets/img/etecmcm.png" alt="Logo MCM">
        </header>
        <div class="container" style="width: 60%;">
            <p>Clique na estrela para avaliar.</p>
        </div>
        <div class="container">
            <div class="separacao">
                <div class="projeto">
                    <p style="font-weight: bold; font-size: 32px;">Projeto:</p>
                    <p class="info"><?= $titulo_projeto ?></p>
                    <p style="font-weight: bold; font-size: 32px;">Alunos:</p>
                    <p class="info"><?php while ($row = $resultAlunos->fetch_assoc()) echo htmlspecialchars($row['nome_aluno']) . ';<br> '?></p>
                    <p style="font-weight: bold; font-size: 32px;">Série:</p>
                    <p class="info"><?php while ($rowSerieCurso = $resultSerieCurso->fetch_assoc()) echo $rowSerieCurso['serie_aluno'] . '° ' . $rowSerieCurso['curso_aluno']; ?></p>
                </div>
            </div>
            <form action="../back/avaliacao.php" method="POST">
                <input type="hidden" name="id_projeto" value="<?=$id_projeto?>">
                <div class="separacao">
                    <p style="font-size: 32px;">Avalicação do projeto:</p>
                    <div class="avaliacao-estrelas-container">
                        <input type="hidden" name="estrelas" id="nota" value="" required>
                        <div class="avaliacao-estrelas" data-id="0"></div>
                    </div>
                </div>
                <div class="separacao">
                    <textarea name="comentario" class="avaliacao-textarea" placeholder="Deixe um comentário"></textarea>
                    <button type="submit">Enviar</button>
                </div>
            </form>
            <h2 style="font-family: 'ArchivoBlack'; color: white; font-size: 40px;">Avaliação</h2>
        </div>
    </main>
    <script>
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
</body>
</html>