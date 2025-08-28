<?php 
require_once __DIR__ . '/../../config/database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['admin']) or $_SESSION['admin'] !== 1) {
    header('Location: ../Views/home.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $bloco = $_POST['bloco'];
    $sala = $_POST['sala'];
    $stand = $_POST['stand'];
    $orientador = $_POST['orientador'];

    // Primeiro: verificar se já existe esse stand na mesma sala e bloco
    $sqlVerificar = "SELECT " . TABELA_PROJETO['id'] . " FROM " 
                    . TABELA_PROJETO['nome_tabela'] . " WHERE " 
                    . TABELA_PROJETO['bloco'] . " = ? AND " 
                    . TABELA_PROJETO['sala'] . " = ? AND " 
                    . TABELA_PROJETO['stand'] . " = ?";

    $stmtVerificar = $mysqli->prepare($sqlVerificar);
    $stmtVerificar->bind_param("sii", $bloco, $sala, $stand);
    $stmtVerificar->execute();
    $stmtVerificar->store_result();

    if ($stmtVerificar->num_rows > 0) {
        echo "<script>alert('Já existe um projeto cadastrado nesse Stand da mesma Sala e Bloco!')</script>";
        echo "<script>window.location.href='criar_projeto.php'</script>";
        $stmtVerificar->close();
        exit();
    }
    $stmtVerificar->close();

    // Inserir o novo projeto no banco de dados
    $sqlCriarProjeto = "INSERT INTO "   . TABELA_PROJETO['nome_tabela']. " (" 
                                        . TABELA_PROJETO['titulo']     . ", "
                                        . TABELA_PROJETO['descricao']  . ", " 
                                        . TABELA_PROJETO['bloco']      . ", " 
                                        . TABELA_PROJETO['sala']       . ", " 
                                        . TABELA_PROJETO['stand']      . ", "
                                        . TABELA_PROJETO['orientador'] . ") VALUES (?, ?, ?, ?, ?, ?)";

    $stmtInsert = $mysqli->prepare($sqlCriarProjeto);
    $stmtInsert->bind_param("sssiis", $titulo, $descricao, $bloco, $sala, $stand, $orientador);
    
    if ($stmtInsert->execute()) {
        echo "<script>alert('Projeto criado com sucesso!')</script>";
        echo "<script>window.location.href='projetos.php'</script>";
    } else {
        echo "<script>alert('Ocorreu um erro ao inserir o projeto.')</script>";
        echo "<script>window.location.href='criar_projeto.php'</script>";
    }

    $stmtInsert->close();
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <title>Criar Projeto</title>
</head>
<body>
    <div class="nav-bar">
        <div class="nav-bar-content">
            <a href="projetos.php">Voltar</a>
        </div>
    </div>
    <div class="container">
        <h2>Crie um projeto</h2>

        <!-- Formulário para criação. -->
        <form method="POST">
            <label>Título:</label>
            <input type="text" name="titulo" placeholder="Título do projeto" required>

            <label>Descrição:</label>
            <textarea name="descricao" id="descricao" minlength="15" maxlength="200" placeholder="Digite até 200 caractéres" required></textarea>

            <label>Bloco:</label>
            <select name="bloco" id="bloco" required>
                <option value="A">A</option>
                <option value="B">B</option>
            </select>

            <label>Sala:</label>
            <select name="sala" id="sala" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
            </select>
            
            <label>Stand:</label>
            <select name="stand" id="stand" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
            </select>

            <label>Orientador:</label>
            <input type="text" name="orientador" placeholder="Orientador do projeto" required>
            
            <button type="submit">Criar</button>
        </form>
    </div>
</body>
</html>