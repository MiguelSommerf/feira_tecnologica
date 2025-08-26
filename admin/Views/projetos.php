<?php
require_once '../config/connect.php';

session_start();
if (!isset($_SESSION['admin']) or $_SESSION['admin'] != true) {
    header('Location: ../Views/home.php');
    exit('Você não tem permissão para acessar esta página.');
}

# Esse SELECT é pra trazer todos os dados que podem ser alterados, dos projetos.
$sql = "SELECT id_projeto, sala, bloco, stand FROM tb_projetos ORDER BY id_projeto ASC";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/projetos.css">
    <title>Projetos</title>
</head>
<body>
    <div class="nav-bar">
        <div class="nav-bar-content">
            <a href="home.php">Voltar</a>
        </div>
    </div>

    <!-- Div para organizar os projetos em coluna, do primeiro ao último. -->
    <div class="container">
        <h2>Projetos Cadastrados</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sala</th>
                    <th>Bloco</th>
                    <th>Stand</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <!-- Todos vão ter o botão "editar", que vai mandar o admin para a tela alterar_projeto-->
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id_projeto'] ?></td>
                        <td><?= htmlspecialchars($row['sala']) ?></td>
                        <td><?= htmlspecialchars($row['bloco']) ?></td>
                        <td><?= htmlspecialchars($row['stand']) ?></td>
                        <td>
                            <form action="alterar_projeto.php" method="GET">
                                <input type="hidden" name="id_projeto" value="<?= $row['id_projeto'] ?>">
                                <button type="submit">Editar</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>