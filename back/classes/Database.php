<?php
require_once __DIR__ . '/../../config/database.php';

class Database
{
    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function deletarDados(string $campo): void
    {
        $queryDelete = "DELETE FROM " . $campo;
        $stmtDelete = $this->mysqli->prepare($queryDelete);
        $stmtDelete->execute();
        $stmtDelete->close();
    }

    public function resetarAutoIncrement(string $campo): void
    {
        $querySetAutoIncrement = "ALTER TABLE $campo AUTO_INCREMENT = 1";
        $stmtSetAutoIncrement = $this->mysqli->prepare($querySetAutoIncrement);
        $stmtSetAutoIncrement->execute();
        $stmtSetAutoIncrement->close();
    }

    public function retornarIdSala($sala): int
    {
        switch ($sala) {
            case 1:
                return 1;
        }

        return 0;
    }

    public function votoInsert(bool $backup): void
    {
        if ($backup === true) {
            $querySelectTodosVotos = "SELECT * FROM " . TABELA_VOTO['nome_tabela'];
            $stmtSelectTodosVotos = $this->mysqli->prepare($querySelectTodosVotos);
            $stmtSelectTodosVotos->execute();
            $resultSelectTodosVotos = $stmtSelectTodosVotos->get_result();
    
            if ($resultSelectTodosVotos->num_rows > 0) {
                while ($voto = $resultSelectTodosVotos->fetch_assoc()) {
                    $queryInsertVoto = "INSERT INTO " . TABELA_VOTO_BACKUP['nome_tabela'] . " VALUES (DEFAULT, ?, ?, ?, ?, ?)";
                    $stmtInsertVoto = $this->mysqli->prepare($queryInsertVoto);
                    $stmtInsertVoto->bind_param("sisii", $voto['data_hora_voto'], $voto['valor_voto'], $voto['comentario_voto'], $voto['fk_id_usuario'], $voto['fk_id_projeto']);
                    $stmtInsertVoto->execute();
                }
            }
        }

        if ($backup === false) {
            $querySelectTodosVotos = "SELECT * FROM " . TABELA_VOTO_BACKUP['nome_tabela'];
            $stmtSelectTodosVotos = $this->mysqli->prepare($querySelectTodosVotos);
            $stmtSelectTodosVotos->execute();
            $resultSelectTodosVotos = $stmtSelectTodosVotos->get_result();

            if ($resultSelectTodosVotos->num_rows > 0) {
                while ($voto = $resultSelectTodosVotos->fetch_assoc()) {
                    $queryInsertVoto = "INSERT INTO " . TABELA_VOTO['nome_tabela'] . " VALUES (DEFAULT, ?, ?, ?, ?, ?)";
                    $stmtInsertVoto = $this->mysqli->prepare($queryInsertVoto);
                    $stmtInsertVoto->bind_param("sisii", $voto['data_hora_voto'], $voto['valor_voto'], $voto['comentario_voto'], $voto['fk_id_usuario'], $voto['fk_id_projeto']);
                    $stmtInsertVoto->execute();
                }
            }
        }
    }
    public function postApi($url, $dados)
    {
        $ch = curl_init();
        $chOptions = [
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json'
            ],
            CURLOPT_POST => true,
            CURLOPT_URL => $url,
            CURLOPT_POSTFIELDS => $dados,
            CURLOPT_RETURNTRANSFER => true
        ];
        curl_setopt_array($ch, $chOptions);
        
        $result = json_decode(curl_exec($ch));
        curl_close($ch);

        return $result;
    }
}