<?php
require_once 'connect.php';

const TABELA_USUARIO = [
    'nome_tabela'     => 'tb_usuario',
    'id'              => 'id_usuario',
    'admin'           => 'is_admin',
    'nome'            => 'nome_usuario',
    'email'           => 'email_usuario',
    'senha'           => 'senha_usuario',
    'data_nascimento' => 'data_nascimento_usuario'
];

const TABELA_PROJETO = [
    'nome_tabela' => 'tb_projeto',
    'id'          => 'id_projeto',
    'titulo'      => 'titulo_projeto',
    'descricao'   => 'descricao_projeto',
    'orientador'  => 'orientador_projeto',
];

const TABELA_ODS = [
    'nome_tabela' => 'tb_ods',
    'id'          => 'id_ods',
    'nome'        => 'nome_ods'
];

const TABELA_ODS_PROJETO = [
    'nome_tabela' => 'tb_ods_projeto',
    'ods'         => 'fk_id_ods',
    'projeto'     => 'fk_id_projeto'
];

const TABELA_PROJETO_ALUNO = [
    'nome_tabela' => 'tb_projeto_aluno',
    'projeto'     => 'fk_id_projeto',
    'aluno'       => 'fk_id_aluno'
];

const TABELA_VOTO = [
    'nome_tabela' => 'tb_voto',
    'id'          => 'id_voto',
    'data'        => 'data_hora_voto',
    'valor'       => 'valor_voto',
    'comentario'  => 'comentario_voto',
    'usuario'     => 'fk_id_usuario',
    'projeto'     => 'fk_id_projeto'
];

const TABELA_ALUNO = [
    'nome_tabela' => 'tb_aluno',
    'id'          => 'id_aluno',
    'nome'        => 'nome_aluno',
    'serie'       => 'serie_aluno',
    'curso'       => 'curso_aluno'
];

const TABELA_FEEDBACK = [
    'nome_tabela' => 'tb_feedback',
    'id'          => 'id_feedback',
    'usuario'     => 'fk_id_usuario',
    'nota'        => 'nota_feedback',
    'comentario'  => 'comentario_feedback',
    'data'        => 'data_envio_feedback'
];

const TABELA_BLOCO = [
    'nome_tabela' => 'tb_bloco',
    'id'          => 'id_bloco',
    'bloco'       => 'nome_bloco'
];

const TABELA_SALA = [
    'nome_tabela' => 'tb_sala',
    'id'          => 'id_sala',
    'sala'        => 'nome_sala'
];

const TABELA_STAND = [
    'nome_tabela' => 'tb_stand',
    'id'          => 'id_stand',
    'stand'       => 'numero_stand'
];

const TABELA_LOCALIZACAO_PROJETO = [
    'nome_tabela' => 'tb_localizacao_projeto',
    'bloco'       => 'fk_id_bloco',
    'sala'        => 'fk_id_sala',
    'stand'       => 'fk_id_stand',
    'projeto'     => 'fk_id_projeto'
];

const TABELA_LOG_USUARIO = [
    'nome_tabela' => 'tb_log_usuario',
    'id'          => 'id_log_usuario',
    'admin'       => 'fk_id_admin',
    'usuario'     => 'fk_id_usuario'
];