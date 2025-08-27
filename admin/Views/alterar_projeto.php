<?php
require_once __DIR__ . '/../../config/database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['admin']) or $_SESSION['admin'] != true) {
    header('Location: ../Views/home.php');
    exit();
}

$id = !empty($_GET['id_projeto']) ? $_GET['id_projeto'] : null;
if (!isset($id)) {
    header("Location: projetos.php");
    exit();
}

# Altera os dados do projeto quando o form é enviado.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $sala = $_POST['sala'];
    $bloco = $_POST['bloco'];
    $stand = $_POST['stand'];

    $queryAlterarProjeto = "UPDATE " . TABELA_PROJETO['nome_tabela'] . " SET " . TABELA_PROJETO['sala'] . " = ?, " . TABELA_PROJETO['bloco'] . " = ?, " . TABELA_PROJETO['stand'] . " = ? WHERE " . TABELA_PROJETO['id'] . " = ?";
    $stmtAlterarProjeto = $mysqli->prepare($queryAlterarProjeto);
    $stmtAlterarProjeto->bind_param("isii", $sala, $bloco, $stand, $id);
    $stmtAlterarProjeto->execute();

    header("Location: projetos.php");
    exit();
}

# Pega os dados do projeto.
$sqlSelecionarProjeto = "SELECT * FROM " . TABELA_PROJETO['nome_tabela'] . " WHERE " . TABELA_PROJETO['id'] . " = ?";
$stmtSelecionarProjeto = $conn->prepare($sql);
$stmtSelecionarProjeto->bind_param("i", $id);
$stmtSelecionarProjeto->execute();
$projeto = $stmtSelecionarProjeto->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/projetos.css">
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
            <label>Sala:</label>
            <input type="text" name="sala" value="<?= htmlspecialchars($projeto['sala_projeto']) ?>" required>
            
            <label>Bloco:</label>
            <input type="text" name="bloco" value="<?= htmlspecialchars($projeto['bloco_projeto']) ?>" required>
            
            <label>Stand:</label>
            <input type="text" name="stand" value="<?= htmlspecialchars($projeto['stand_projeto']) ?>" required>
            
            <button type="submit">Salvar</button>
        </form>
    </div>
</body>
</html>