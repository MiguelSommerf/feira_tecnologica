<?php
//Codado por Miguel Luiz Sommerfeld - 3°F Turma B
require_once __DIR__ . '/../../config/database.php';

class VerificarCampos{
    private $mysqli;

    public function __construct($mysqli){
        $this->mysqli = $mysqli;
    }

    public function verificarNome($nome){
        if(isset($nome)){
            if(strlen($nome === 0)){
                echo "<script>alert('É necessário que o campo nome seja preenchido.')</script>";
                echo "<script>window.history.back();</script>";
                exit();
            }
        }
    }

    public function verificarEmail($email){
        if(isset($email)){
            if(strlen($email) === 0){
                echo "<script>alert('É necessário que o campo e-mail seja preenchido.')</script>";
                echo "<script>window.history.back();</script>";
                exit();
            }
        }
    }

    public function verificarSenha($senha){
        if(isset($senha)){
            if(strlen($senha) === 0){
                echo "<script>alert('É necessário que o campo senha seja preenchido.')</script>";
                echo "<script>window.history.back();</script>";
                exit();
            }
        }
    }

    public function verificarDataDeNascimento($data_nascimento){
        if(isset($data_nascimento)){
            if(strlen($data_nascimento === 0)){
                echo "<script>alert('É necessário que o campo de data de nascimento seja preenchido.')</script>";
                echo "<script>window.history.back();</script>";
                exit();
            }
        }
    }

    public function verificarEmailExistente($email){
       $email = trim(strtolower($email));
       $sql_query = "SELECT " . TABELA_USUARIO['email'] . " FROM " . TABELA_USUARIO['nome_tabela'] . " WHERE " . TABELA_USUARIO['email'] . " = ?";
       $stmt = $this->mysqli->prepare($sql_query);
       $stmt->bind_param("s", $email);
       $stmt->execute();
       $result = $stmt->get_result();

       if($result->num_rows > 0){
        echo "<script>alert('O endereço de e-mail digitado já foi cadastrado. Tente utilizar outro endereço de e-mail.')</script>";
        echo "<script>window.history.back();</script>";
        exit();
       }
    }

    public function verificarEspacoEmBranco($campo) {
        if (strpos($campo, " ") == true) {
            echo "<script>alert('Os campos e-mail e senha não podem conter espaços em branco!')</script>";
            echo "<script>window.history.back()</script>";
            exit();
        }
    }
}
