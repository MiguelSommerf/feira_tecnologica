<?php
require_once __DIR__ . '/../../config/connect.php';

session_start();
if (!isset($_SESSION['is_admin']) or $_SESSION['is_admin'] !== 2) {
    header('Location: ../Views/home.php');
    exit('Você não tem permissão para acessar esta página.');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <script>
        function deleteFunction() {
            const confirmacao = confirm('Você tem certeza que deseja deletar este usuário?');
            return confirmacao;
        }

        function adminFunction() {
            const confirmacao = confirm('Você tem certeza que deseja tornar este usuário administrador?');
            return confirmacao;
        }

        function standardFunction() {
            const confirmacao = confirm('Você tem certeza que deseja tornar este administrador um usuário padrão?');
            return confirmacao;
        }
    </script>
    <title>Usuários</title>
</head>
<body>
    <div class="nav-bar">
        <div class="nav-bar-content">
            <a href="../Views/home.php">Voltar</a>
        </div>
    </div>
    <div class="container">
        <p>Usuários Comuns</p>
        <?php
        $query = "SELECT * FROM usuarios WHERE is_admin = 0";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Username</th>";
            echo "<th>Opções</th></tr>";
            foreach ($result as $usuario) {
                echo "<tr><td>" . $usuario['nome_usuario'] . "</td>";
                echo "<td>
                    <div class='button-group'>
                        <form class='ocult' action='../App/admin.php' method='POST'>
                            <input type='hidden' name='id_usuario' value='" . $usuario['id_usuario'] . "'>
                            <button class='btn-admin' type='submit' onclick='return adminFunction()'>Tornar Admin</button>
                        </form>
                        <form class='ocult' action='../App/deleteUser.php' method='POST'>
                            <input type='hidden' name='id_usuario' value='" . $usuario['id_usuario'] . "'>
                            <button class='btn-delete' type='submit' onclick='return deleteFunction()'>Deletar</button>
                        </form>
                    </div>
                </td></tr>";
            }
            echo "</table>";
        }
        ?>
        <p>Usuários Admin's</p>
        <?php
        $query = "SELECT * FROM usuarios WHERE is_admin = 1";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Username</th>";
            echo "<th>Opções</th></tr>";
            foreach ($result as $usuario) {
                echo "<tr><td>" . $usuario['nome_usuario'] . "</td>";
                echo "<td>
                        <div class='button-group'>
                            <form class='ocult' action='../App/admin.php' method='POST'>
                                <input type='hidden' name='id_usuario' value='" . $usuario['id_usuario'] . "'>
                                <button class='btn-admin' type='submit' onclick='return standardFunction()'>Tornar Padrão</button>
                            </form>
                            <form class='ocult' action='../App/deleteUser.php' method='POST'>
                                <input type='hidden' name='id_usuario' value='" . $usuario['id_usuario'] . "'>
                                <button class='btn-delete' type='submit' onclick='return deleteFunction()'>Deletar</button>
                            </form>
                        </div>
                    </td></tr>";
            }
            echo "</table>";
        }
        ?>
    </div>
</body>
</html>