<?php
// Feito por Enzo Móbile de Oliveira - 3º F Turma A
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../back/classes/VerificarCampos.php';
require_once '../back/classes/EnviarEmail.php';

if (isset($_POST['nameuser']) && ($_POST['emailuser']) && ($_POST['passuser']) && ($_POST['birthuser'])) {
    $verif = new VerificarCampos($mysqli);

    $verif->verificarNome($_POST['nameuser']);
    $verif->verificarEmail($_POST['emailuser']);
    $verif->verificarSenha($_POST['passuser']);
    $verif->verificarDataDeNascimento($_POST['birthuser']);
    $verif->verificarEspacoEmBranco($_POST['emailuser']);
    $verif->verificarEspacoEmBranco($_POST['passuser']);

    // Caso tudo esteja preenchido, vai enviar o e-mail de verificação
    if ((!empty($_POST['emailuser']) && !empty($_POST['passuser'])) && (!empty($_POST['nameuser']) && !empty($_POST['birthuser']))) {
        $codigoVerificacao = mt_rand(100000, 999999);
        $envio = new EnviarEmail();
        $envio->enviarCodigo($_POST['emailuser'], $codigoVerificacao, "Código de confirmação de e-mail:");

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['nameuser'] = ucfirst(trim($_POST['nameuser']));
        $_SESSION['emailuser'] = strtolower(trim($_POST['emailuser']));
        $_SESSION['passuser'] = $_POST['passuser'];
        $_SESSION['birthuser'] = $_POST['birthuser'];

        $_SESSION['verificando'] = 1;

        $_SESSION['hashcode'] = password_hash($codigoVerificacao, PASSWORD_DEFAULT);
        $_SESSION['hashcode-time'] = time();

        echo "<script>window.location.href = '../views/tela_verificarEmail.php'</script>";
        exit();
    } else {
        echo "<script>alert('Preencha todos os campos.')</script>";
        exit();
    }
}

if (isset($_SESSION['hashcode']) && isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];

    if (isset($_SESSION['hashcode-time'])) {
        if (time() - $_SESSION['hashcode-time'] > 600) {
            echo "<script>alert('Código expirado.')</script>";
            echo "<script>window.location.href = '../views/tela_cadastro.php'</script>";
            exit();
        }
    }

    $verificacao = password_verify($codigo, $_SESSION['hashcode']);

    if ($verificacao) {
        unset($_SESSION['hashcode']);
        unset($_SESSION['hashcode-time']);
        unset($_SESSION['verificando']);
        require_once 'cadastro.php';
    } else {
        echo "<script>alert('Código incorreto.')</script>";
        exit();
    }
}
