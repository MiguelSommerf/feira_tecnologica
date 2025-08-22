<?php
//Codado por Miguel Luiz Sommerfeld - 3°F Turma B
require __DIR__ . '/../../config/smtp_config.php';

use PHPMailer\PHPMailer\Exception;

class EnviarEmail{

    public function enviarCodigo($emailUsuario, $codigo, $assunto) {
        global $email;

        try {
            // Configurações de envio
            $email->setFrom(SMTP_USER, "Feira Tecnológica");
            $email->addAddress($emailUsuario);

            // Conteúdo
            $email->isHTML(true);
            $email->Subject = "$assunto";
            $email->Body = "<center>
                                <h1>Não compartilhe esse código:</h1><br>
                                <h1>$codigo</h1><br>
                                <h3>Etec MCM - Centro Paula Souza</h3>
                            </center>";
            $email->AltBody = "Código de redefinição de senha: $codigo";

            // Envio de e-mail
            $email->send();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function reenviarCodigo() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['hashcode']) or empty($_SESSION['email'])) {
            header('Location: ../views/tela_login.php');
            exit();
        };

        if ((time() - $_SESSION['hashcode-time']) < 60) {
            echo "<script>alert('Aguarde 1 minuto antes de pedir o reenvio de código.')</script>";
            echo "<script>window.location.href = '../views/tela_2step.php'</script>";
            exit();
        }

        if ((time() - $_SESSION['hashcode-time']) >= 60) {
            $codigoVerificacao = mt_rand(100000, 999999);
            $_SESSION['hashcode'] = password_hash($codigoVerificacao, PASSWORD_DEFAULT);
            $_SESSION['hashcode-time'] = time();
            $envioEmail = new EnviarEmail();
            $envioEmail->enviarCodigo($_SESSION['email'], $codigoVerificacao, "Reenvio de código de redefinição de senha:");
            
            header('Location: ../views/tela_2step.php');
            exit();
        }
    }
}