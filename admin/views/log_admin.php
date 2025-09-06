<?php
require_once __DIR__ . '/../../config/database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['admin'])) {
    header("Location: ../../index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <title>Logs</title>
</head>
<body>
    <div class="nav-bar">
        <div class="nav-bar-content">
            <a href="home.php">Voltar</a>
        </div>
    </div>
    <div>
        <center>
        <?php
        $queryLogs = "SELECT * FROM " . TABELA_LOG_USUARIO['nome_tabela'];
        $stmtLogs = $mysqli->prepare($queryLogs);
        $stmtLogs->execute();
        $resultLogs = $stmtLogs->get_result();

        if ($resultLogs->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID LOG</th>
                        <th>E-MAIL ADMIN</th>
                        <th>E-MAIL USUARIO</th>
                        <th>DATA LOG</th>
                    </tr>
                </thead>
        <?php foreach ($resultLogs as $log): ?>
                <tbody>
                    <tr>
                        <td><?= $log['id_log_usuario']; ?></td>
                        <td><?= $log['email_admin']; ?></td>
                        <td><?= $log['email_usuario']; ?></td>
                        <td><?= $log['data_log']; ?></td>
                    </tr>
                </tbody>
        <?php endforeach; ?>
            </table>
        <?php else: ?>
            <h2>Não há registros no sistema.</h2>
        <?php endif; ?>
        </center>
    </div>
</body>
</html>