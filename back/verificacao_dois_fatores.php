<?php
//Codado por Miguel Luiz Sommerfeld - 3°F Turma B
require_once '../config/connect.php';
require_once 'classes/EnviarEmail.php';

$emailUsuario = isset($_POST['email']) ? $_POST['email'] : null;
$inputCodigo = isset($_POST['codigo']) ? $_POST['codigo'] : null;

if ($inputCodigo) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (isset($_SESSION['hashcode-time'])) {
        if (time() - $_SESSION['hashcode-time'] > 600) {
            echo "<script>alert('Código expirado.')</script>";
            echo "<script>window.location.href = '../views/tela_2step.php'</script>";
            exit();
        }
    }

    $twoStep = password_verify($inputCodigo, $_SESSION['hashcode']);

    if ($twoStep) {
        $_SESSION['redefine'] = true;
        unset($_SESSION['hashcode']);
        unset($_SESSION['hashcode-time']);
        
        header('Location: ../views/tela_2step.php');
        exit();
    } else {
        echo "<script>alert('Código incorreto.')</script>";
        echo "<script>window.location.href = '../views/tela_2step.php'</script>";
        exit();
    }
}

$queryEmailExistente = "SELECT email FROM tbl_users WHERE email = ?";
$stmtEmailExistente = $mysqli->prepare($queryEmailExistente);
$stmtEmailExistente->bind_param("s", $emailUsuario);
$stmtEmailExistente->execute();
$resultEmailExistente = $stmtEmailExistente->get_result();

if ($resultEmailExistente->num_rows === 1) {

    if ($emailUsuario) {
        $codigoVerificacao = mt_rand(100000, 999999);
        $envio = new EnviarEmail();
        $envio->enviarCodigo($emailUsuario, $codigoVerificacao, "Código de redefinição de senha:");

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['hashcode'] = password_hash($codigoVerificacao, PASSWORD_DEFAULT);
        $_SESSION['hashcode-time'] = time();
        $_SESSION['email'] = $emailUsuario;

        header('Location: ../views/tela_2step.php');
        exit();
    } else {
        echo "<script>window.location.href = '../views/tela_login.php'</script>";
        exit();
    }
} else {
    echo "<script>alert('O endereço de e-mail digitado ainda não foi cadastrado.')</script>";
    echo "<script>window.location.href = '../views/tela_2step.php'</script>";
    exit();
}

echo "<script>window.history.back();</script>";
exit();
