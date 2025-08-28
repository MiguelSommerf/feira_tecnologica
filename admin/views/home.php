<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <title>Home Page</title>
</head>
<body>
    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (empty($_SESSION['admin'])) {
        unset($_SESSION['admin']);
    }

    if (!empty($_SESSION['id']) && $_SESSION['admin'] === 1) {

        if (!empty($_SESSION['admin'])): ?>
            <div class="nav-bar">
                <div class="nav-bar-content">
                    <a href="projetos.php">Projetos</a>
                    <a href="usuarios.php">Usuários</a>
                    <a href="../../back/logout.php">Logout</a>
                </div>
            </div>
            <div class="container">
                <h1>Olá, Admin!</h1>
                <p>Você tem acesso a todas as funcionalidades do sistema.</p>
            </div>
        <?php endif; ?>
    <?php
    } else {
        $url = '../../index.php';
        header("Location: $url");
        exit();
    }
    ?>
</body>
</html>