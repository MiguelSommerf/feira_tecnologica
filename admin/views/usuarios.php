<?php
require_once __DIR__ . '/../../config/database.php';

session_start();
if (!isset($_SESSION['admin']) or $_SESSION['admin'] !== 1) {
    header('Location: ../views/home.php');
    exit('Você não tem permissão para acessar esta página.');
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <title>Usuários</title>
</head>
<body>
    <div class="nav-bar">
        <div class="nav-bar-content">
            <a href="../views/home.php">Voltar</a>
        </div>
    </div>
    <div class="container">
        <?php
            $query = "SELECT * FROM " . TABELA_USUARIO['nome_tabela'] . " WHERE " . TABELA_USUARIO['admin'] . " = 0";
            $stmt = $mysqli->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<p>Usuários Comuns</p>";
                echo "<table>";
                echo "<tr><th>Username</th>";
                echo "<th>Opções</th></tr>";
                foreach ($result as $usuario) {
                    echo "<tr><td>" . htmlspecialchars($usuario['nome_usuario']) . "</td>";
                    echo "<td>
                        <div class='button-group'>
                            <form class='ocult' action='../src/admin.php' method='POST'>
                                <input type='hidden' name='id_usuario' value=" . $usuario['id_usuario'] . ">
                                <button class='btn-admin' type='submit' onclick='return adminFunction()'>Tornar Admin</button>
                            </form>
                            <form class='ocult' action='../src/deleteUser.php' method='POST'>
                                <input type='hidden' name='id_usuario' value=" . $usuario['id_usuario'] . ">
                                <button class='btn-delete' type='submit' onclick='return deleteUser()'>Deletar</button>
                            </form>
                        </div>
                    </td></tr>";
                }
                echo "</table>";
            } else {
                echo "<strong><p>Nenhum usuário comum encontrado.</p></strong>";
            }
        ?>
        <?php
            $query = "SELECT * FROM " . TABELA_USUARIO['nome_tabela'] . " WHERE " . TABELA_USUARIO['admin'] . " = 1";
            $stmt = $mysqli->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<p>Usuários Admin</p>";
                echo "<table>";
                echo "<tr><th>Username</th>";
                echo "<th>Opções</th></tr>";
                foreach ($result as $usuario) {
                    echo "<tr><td>" . $usuario['nome_usuario'] . "</td>";
                    echo "<td>
                            <div class='button-group'>
                                <form class='ocult' action='../src/admin.php' method='POST'>
                                    <input type='hidden' name='id_usuario' value=" . $usuario['id_usuario'] . ">
                                    <button class='btn-admin' type='submit' onclick='return standardFunction()'>Tornar Padrão</button>
                                </form>
                                <form class='ocult' action='../src/deleteUser.php' method='POST'>
                                    <input type='hidden' name='id_usuario' value=" . $usuario['id_usuario'] . ">
                                    <button class='btn-delete' type='submit' onclick='return deleteUser()'>Deletar</button>
                                </form>
                            </div>
                        </td></tr>";
                }
                echo "</table>";
            }
        ?>
    </div>
    <script src="../../assets/JS/adminFunctions.js"></script>
</body>
</html>