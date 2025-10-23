<?php
require_once __DIR__ . '/../../config/database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin']) or $_SESSION['admin'] !== 1) {
    header('Location: ../views/home.php');
    exit('Você não tem permissão para acessar esta página.');
}

# Esse SELECT é pra trazer todos os dados que podem ser alterados, dos projetos.
$sqlProjeto = "SELECT " . "p." . TABELA_PROJETO['id'] . ", " 
                        . "p." . TABELA_PROJETO['titulo'] . ", " 
                        . "sa." . TABELA_SALA['sala'] . ", " 
                        . "b." . TABELA_BLOCO['bloco'] . " FROM " 
                        . TABELA_PROJETO['nome_tabela'] . " AS p 
                        INNER JOIN " . TABELA_LOCALIZACAO_PROJETO['nome_tabela'] . " AS lp ON p." . TABELA_PROJETO['id'] . " = lp." . TABELA_LOCALIZACAO_PROJETO['projeto'] . " 
                        INNER JOIN " . TABELA_BLOCO['nome_tabela'] . " AS b ON b." . TABELA_BLOCO['id'] . " = lp." . TABELA_LOCALIZACAO_PROJETO['bloco'] . " 
                        INNER JOIN " . TABELA_SALA['nome_tabela'] . " AS sa ON sa." . TABELA_SALA['id'] . " = lp." . TABELA_LOCALIZACAO_PROJETO['sala'] . " 
                        ORDER BY " . TABELA_PROJETO['id'] . " ASC";
$resultProjeto = $mysqli->query($sqlProjeto);

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
        </div>
    </div>

    <!-- Div para organizar os projetos em coluna, do primeiro ao último. -->
    <div class="container">
        <?php if ($resultProjeto->num_rows > 0): ?>
            <h2>Projetos Cadastrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Sala</th>
                        <th>Bloco</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Todos vão ter o botão "editar", que vai mandar o admin para a tela alterar_projeto-->
                    <?php while ($row = $resultProjeto->fetch_assoc()): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($row['id_projeto']); ?></strong></td>
                            <td><?= htmlspecialchars($row['titulo_projeto']); ?></td>
                            <td><?= htmlspecialchars($row['nome_sala']); ?></td>
                            <td><?= htmlspecialchars($row['nome_bloco']); ?></td>
                            <td>
                                <div class="actions">
                                    <form action="alterar_projeto.php" method="GET">
                                        <input type="hidden" name="id_projeto" value="<?= $row['id_projeto'] ?>">
                                        <button type="submit">Editar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <h2>Nenhum projeto registrado.</h2>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script src="../../assets/js/adminFunctions.js"></script>
</body>
</html>