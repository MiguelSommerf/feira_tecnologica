<?php
require_once '../config/connect.php';

session_start();
if (!isset($_SESSION['admin']) or $_SESSION['admin'] != true) {
    header('Location: ../Views/home.php');
    exit('Você não tem permissão para acessar esta página.');
}

$id = $_GET['id_projeto'] ?? null;
if (!$id) {
    echo "ID inválido.";
    header("Location: projetos.php");
    exit();
}

# Altera os dados do projeto quando o form é enviado.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sala = $_POST['sala'];
    $bloco = $_POST['bloco'];
    $stand = $_POST['stand'];

    $sql = "UPDATE tb_projetos SET sala=?, bloco=?, stand=? WHERE id_projeto=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isii", $sala, $bloco, $stand, $id);
    $stmt->execute();

    header("Location: projetos.php");
    exit();
}

# Pega os dados do projeto.
$sql = "SELECT * FROM tb_projetos WHERE id_projeto=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$projeto = $stmt->get_result()->fetch_assoc();
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
            <input type="text" name="sala" value="<?= htmlspecialchars($projeto['sala']) ?>" required>
            
            <label>Bloco:</label>
            <input type="text" name="bloco" value="<?= htmlspecialchars($projeto['bloco']) ?>" required>
            
            <label>Stand:</label>
            <input type="text" name="stand" value="<?= htmlspecialchars($projeto['stand']) ?>" required>
            
            <button type="submit">Salvar</button>
        </form>
    </div>
</body>
</html>