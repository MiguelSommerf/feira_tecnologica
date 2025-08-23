<?php
require_once '../config/connect.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$id_projeto = isset($_POST['id_projeto']) ? (int)$_POST['id_projeto'] : null;
$titulo_projeto = isset($_POST['titulo_projeto']) ? $_POST['titulo_projeto'] : null;

$queryAluno = "SELECT nome FROM tb_integrantes as i
                INNER JOIN tbl_projetos AS p ON p.id_projetos = i.id_projetos
                INNER JOIN tbl_alunos as a ON a.id_aluno = i.id_aluno
                WHERE i.id_projetos = ?";
$stmtAluno = $mysqli->prepare($queryAluno);
$stmtAluno->bind_param("i", $id_projeto);
$stmtAluno->execute();
$resultAlunos = $stmtAluno->get_result();

$querySerieCurso = "SELECT DISTINCT a.serie, a.curso FROM tbl_projetos AS p
          INNER JOIN tb_integrantes AS i ON p.id_projetos = i.id_projetos
          INNER JOIN tbl_alunos AS a ON a.id_aluno = i.id_aluno";
$stmtSerieCurso = $mysqli->prepare($querySerieCurso);
$stmtSerieCurso->execute();
$resultSerieCurso = $stmtSerieCurso->get_result();

if (!isset($id_projeto)) {
    echo "<script>alert('Não há nenhum projeto para avaliar.')</script>";
    echo "<script>window.history.back()</script>";
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
        
    <button class="btn-voltar" onclick="history.back()">Voltar</button>
        
        <div class="avaliacao-container">
            <div class="avaliacao-header">
                <div class="avaliacao-infos">
                    <div class="campo">
                        <input type="text" value="Projeto: <?= $titulo_projeto ?>" readonly>
                    </div>
                    <div class="campo">
                        <input type="text" value="Alunos: <?php while ($row = $resultAlunos->fetch_assoc()) echo $row['nome'] . '; ';
                        ?>" readonly/>
                    </div>
                    <div class="campo">
                        <input type="text" value="Série: <?php while ($rowSerieCurso = $resultSerieCurso->fetch_assoc()) echo $rowSerieCurso['serie'] . '° ' . $rowSerieCurso['curso']; ?>" readonly>
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
    </main>

    <div id="mySideMenu" class="side-menu">
      <a href="javascript:void(0)" class="close-btn" onclick="closeMenu()">&times;</a>
      <a href="tela_mapa.php">Mapa</a>
      <a href="tela_avaliacao.php">Avaliação</a>
      <a href="tela_projetos.php">Projetos</a>
      <a href="tela_ranking.php">Ranking</a>
      <a href="tela_cursos.php">Cursos</a>
      <a href="tela_sobreEtec.php">Sobre a Etec</a>
      <a href="tela_acessibilidade.php">Acessibilidade</a>
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
      
        document.getElementById('mobile-menu').addEventListener('click', function() {
            this.classList.toggle('active');
            openMenu();
        });
        function openMenu() {
            document.getElementById('mySideMenu').style.width = '250px';
        }
        function closeMenu() {
            document.getElementById('mySideMenu').style.width = '0';
            document.getElementById('mobile-menu').classList.remove('active');
        }
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
</body>
</html>