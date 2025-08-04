<?php
//Codado por Miguel Luiz Sommerfeld - 3°F Turma B
require __DIR__ . '/../../config/smtp_config.php';

use PHPMailer\PHPMailer\Exception;

class EnviarEmail{

    public function enviarCodigo($codigo) {
        global $email;

        try {
            // Configurações de envio
            $email->setFrom("etecmcm@etec.sp.gov.br", "ETEC MCM");
            $email->addAddress("miguel.sommerfeldluiz@gmail.com", "Miguel Sommerfeld");

            // Conteúdo
            $email->isHTML(true);
            $email->Subject = "Código de redefinição de senha:";
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
}