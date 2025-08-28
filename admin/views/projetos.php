<?php
require_once __DIR__ . '/../../config/database.php';

session_start();
if (!isset($_SESSION['admin']) or $_SESSION['admin'] !== 1) {
    header('Location: ../views/home.php');
    exit('Você não tem permissão para acessar esta página.');
}

# Esse SELECT é pra trazer todos os dados que podem ser alterados, dos projetos.
$sqlProjeto = "SELECT " . TABELA_PROJETO['id'] . ", " 
                        . TABELA_PROJETO['titulo'] . ", " 
                        . TABELA_PROJETO['sala'] . ", " 
                        . TABELA_PROJETO['bloco'] . ", " 
                        . TABELA_PROJETO['stand'] . " FROM " 
                        . TABELA_PROJETO['nome_tabela'] . " ORDER BY " 
                        . TABELA_PROJETO['id'] . " ASC";
$resultProjeto = $mysqli->query($sqlProjeto);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Deleta as FK e depois o projeto
    $sqlDeletarFK = "DELETE FROM " . TABELA_PROJETO_ALUNO['nome_tabela'] . " WHERE " . TABELA_PROJETO_ALUNO['projeto'] . " = ?";
    $stmt1 = $mysqli->prepare($sqlDeletarFK);
    $stmt1->bind_param("i", $_POST['id_projeto']);
    $stmt1->execute();

    $sqlDeletarFK = "DELETE FROM " . TABELA_ODS_PROJETO['nome_tabela'] . " WHERE " . TABELA_ODS_PROJETO['projeto'] . " = ?";
    $stmt2 = $mysqli->prepare($sqlDeletarFK);
    $stmt2->bind_param("i", $_POST['id_projeto']);
    $stmt2->execute();

    $sqlDeletarProjeto = "DELETE FROM " . TABELA_PROJETO['nome_tabela'] . " WHERE " . TABELA_PROJETO['id'] . " = ?";
    $stmt3 = $mysqli->prepare($sqlDeletarProjeto);
    $stmt3->bind_param("i", $_POST['id_projeto']);
    $stmt3->execute();

    $stmt1->close();
    $stmt2->close();
    $stmt3->close();
    echo "<script>alert('Projeto excluído com sucesso!')</script>";
    echo "<script>window.location.href = 'projetos.php';</script>";
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <title>Projetos</title>
</head>
<body>
    <div class="nav-bar">
        <div class="nav-bar-content">
            <a href="home.php">Voltar</a>
            <a href="criar_projeto.php">Criar Projeto</a>
        </div>
    </div>

    <!-- Div para organizar os projetos em coluna, do primeiro ao último. -->
    <div class="container">
        <h2>Projetos Cadastrados</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Sala</th>
                    <th>Bloco</th>
                    <th>Stand</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Todos vão ter o botão "editar", que vai mandar o admin para a tela alterar_projeto-->
                <?php while ($row = $resultProjeto->fetch_assoc()): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($row['id_projeto']); ?></strong></td>
                        <td><?= htmlspecialchars($row['titulo_projeto']); ?></td>
                        <td><?= htmlspecialchars($row['sala_projeto']); ?></td>
                        <td><?= htmlspecialchars($row['bloco_projeto']); ?></td>
                        <td><?= htmlspecialchars($row['stand_projeto']); ?></td>
                        <td>
                            <div class="actions">
                                <form action="alterar_projeto.php" method="GET">
                                    <input type="hidden" name="id_projeto" value="<?= $row['id_projeto'] ?>">
                                    <button type="submit">Editar</button>
                                </form>
                                <form method="POST">
                                    <input type="hidden" name="id_projeto" value="<?= $row['id_projeto'] ?>">
                                    <button class="btn-delete" type="submit" onclick="deleteProject()">Excluir</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <script src="../../assets/JS/adminFunctions.js"></script>
</body>
</html>