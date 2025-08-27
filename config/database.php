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
    'bloco'       => 'bloco_projeto',
    'sala'        => 'sala_projeto',
    'posicao'     => 'posicao_projeto',
    'stand'       => 'stand_projeto',
    'orientador'  => 'orientador_projeto'
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