<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Home Page</title>
</head>
<body>
    <?php
    session_start();

    if (isset($_SESSION['id'])) {
        if (!isset($_SESSION['admin'])) {
            $_SESSION['admin'] = false;
        }
        
        if ($_SESSION['admin'] == 1): ?>
            <div class="nav-bar">
                <div class="nav-bar-content">
                    <a href="projetos.php">Projetos</a>
                    <a href="login_form.php">Deslogar</a>
                </div>
            </div>
            <div class="container">
                <h1>Olá, Admin!</h1>
                <p>Você tem acesso moderado ao sistema.</p>
            </div>
        <?php elseif ($_SESSION['admin'] == 2): ?>
            <div class="nav-bar">
                <div class="nav-bar-content">
                    <a href="projetos.php">Projetos</a>
                    <a href="usuarios.php">Usuários</a>
                    <a href="login_form.php">Deslogar</a>
                </div>
            </div>
            <div class="container">
                <h1>Olá, Admin avançado!</h1>
                <p>Você tem acesso a todas as funcionalidades do sistema.</p>
            </div>
        <?php else: ?>
            <div class="nav-bar">
                <div class="nav-bar-content">
                    <a href="login_form.php">Login</a>
                </div>
            </div>
            <div class="container">
            <h1>Olá, Usuário!</h1>
                <div class="video">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/i97OkCXwotE?si=l-gZcCw12C17OMJO" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
        <?php endif; ?>
    <?php
    } else {
        header('Location: login_form.php');
        exit();
    }
    ?>
</body>
</html>