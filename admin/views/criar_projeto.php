<?php 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['admin']) or $_SESSION['admin'] !== 1) {
    header('Location: ../views/home.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <title>Criar Projeto</title>
</head>
<body>
    <div class="nav-bar">
        <div class="nav-bar-content">
            <a href="projetos.php">Voltar</a>
        </div>
    </div>
    <div class="container">
        <h2>Crie um projeto</h2>

        <!-- Formulário para criação. -->
        <form method="POST" action="../src/projeto.php">
            <label>Título:</label>
            <input type="text" name="titulo" placeholder="Título do projeto" required>

            <label>Descrição:</label>
            <textarea name="descricao" id="descricao" minlength="15" maxlength="200" placeholder="Digite até 200 caractéres" required></textarea>

            <label>Bloco:</label>
            <select name="bloco" id="bloco" required>
                <option value="A">A</option>
                <option value="B">B</option>
            </select>

            <label>Sala:</label>
            <select name="sala" id="sala" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
            </select>
            
            <label>Stand:</label>
            <select name="stand" id="stand" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
            </select>

            <label>Orientador:</label>
            <input type="text" name="orientador" placeholder="Orientador do projeto" required>
            
            <button type="submit">Criar</button>
        </form>
    </div>
</body>
</html>