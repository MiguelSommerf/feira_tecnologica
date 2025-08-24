<?php
//Codado por Miguel Luiz Sommerfeld - 3°F Turma B
require_once '../config/connect.php';
require_once 'classes/VerificarCampos.php';

$dataJSON = file_get_contents("php://input");
$data = json_decode($dataJSON, true);

$nome = $data['nomeGoogle'];
$email = $data['emailGoogle'];
$data_nascimento = $data['dataNascGoogle'];

$verif = new VerificarCampos($mysqli);
$verif->verificarNome($nome);
$verif->verificarEmail($email);
$verif->verificarDataDeNascimento($data_nascimento);

if(!empty($nome) && !empty($email) && !empty($data_nascimento)){
    if(isset($email)){
        $query = "SELECT email FROM tbl_users WHERE email = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows > 0){
            $mensagem = [
                'error' => 'O endereço de e-mail inserido já foi cadastrado. Tente utilizar outro endereço de e-mail.'
            ];
            echo json_encode($mensagem);
            exit();
        }else{
            $query = "INSERT INTO tbl_users (nome, email, data_nasc) VALUES (?, ?, ?)";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("sss", $nome, $email, $data_nascimento);
            $stmt->execute();
            $stmt->close();
        }
    }
}

require_once 'login_api.php';
exit();
