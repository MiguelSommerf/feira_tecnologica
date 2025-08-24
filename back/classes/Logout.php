<?php
//Codado por Miguel Luiz Sommerfeld - 3°F Turma B
class Logout{

    public function logout(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        session_destroy();
    }

    public function logoutDirecionado(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        };

        session_destroy();
        header('Location: ./index.php');
    }
}
