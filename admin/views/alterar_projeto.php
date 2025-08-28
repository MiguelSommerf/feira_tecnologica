<?php
require_once __DIR__ . '/../../config/database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['admin']) or $_SESSION['admin'] !== 1) {
    header('Location: ../views/home.php');
    exit();
}

$id = !empty($_GET['id_projeto']) ? $_GET['id_projeto'] : null;
if (!isset($id)) {
    header("Location: projetos.php");
    exit();
}

# Altera os dados do projeto quando o form é enviado.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $sala = $_POST['sala'];
    $bloco = $_POST['bloco'];
    $stand = $_POST['stand'];
    $orientador = $_POST['orientador'];

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

    $queryAlterarProjeto = "UPDATE ". TABELA_PROJETO['nome_tabela'] . " SET " 
                                    . TABELA_PROJETO['titulo'] . " = ?, " 
                                    . TABELA_PROJETO['descricao'] . " = ?, " 
                                    . TABELA_PROJETO['bloco'] . " = ?, " 
                                    . TABELA_PROJETO['sala'] . " = ?, " 
                                    . TABELA_PROJETO['stand'] . " = ?, " 
                                    . TABELA_PROJETO['orientador'] . " = ? WHERE " 
                                    . TABELA_PROJETO['id'] . " = ?";
    $stmtAlterarProjeto = $mysqli->prepare($queryAlterarProjeto);
    $stmtAlterarProjeto->bind_param("sssiisi", $titulo, $descricao, $bloco, $sala, $stand, $orientador, $id);
    $stmtAlterarProjeto->execute();

    echo "<script>alert('Projeto alterado com sucesso!')</script>";
    echo "<script>window.location.href='projetos.php'</script>";
    exit();
}

# Pega os dados do projeto.
$sqlSelecionarProjeto = "SELECT * FROM " . TABELA_PROJETO['nome_tabela'] . " WHERE " . TABELA_PROJETO['id'] . " = ?";
$stmtSelecionarProjeto = $mysqli->prepare($sqlSelecionarProjeto);
$stmtSelecionarProjeto->bind_param("i", $id);
$stmtSelecionarProjeto->execute();
$projeto = $stmtSelecionarProjeto->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <title>Editar Projeto</title>
</head>
<body>
    <div class="nav-bar">
        <div class="nav-bar-content">
            <a href="projetos.php">Voltar</a>
        </div>
    </div>

    <div class="container">
        <h2>Editando Projeto ID <?= $id ?></h2>

        <!-- Formulário para alteração. -->
        <form method="POST">
            <label>Título:</label>
            <input type="text" name="titulo" value="<?= htmlspecialchars($projeto['titulo_projeto']) ?>" placeholder="Novo título do projeto" required>

            <label>Descrição:</label>
            <textarea name="descricao" id="descricao" minlength="15" maxlength="200" placeholder="Digite até 200 caractéres" required><?= htmlspecialchars($projeto['descricao_projeto']) ?></textarea>

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
            <input type="text" name="orientador" value="<?= htmlspecialchars($projeto['orientador_projeto']) ?>" placeholder="Orientador do projeto" required>
            
            <button type="submit">Salvar</button>
        </form>
    </div>
</body>
</html>