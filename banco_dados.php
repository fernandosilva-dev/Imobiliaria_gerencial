<?php


// *** DEFINE CONFIGURAÇÕES DE PÁGINA E DE ACESSO AO BANCO DE DADOS ***

set_time_limit(60);

//Informa a tabela de códigos de caracteres
header('Content-type:text/html; charset=utf-8');

//Requer o uso do arquivo externo de configurações 
require('configuracoes.php');


// *** CRIA BASE DE DADOS ***


//Realiza a conexão

$vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha);
if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}

//Cria o código SQL
$vSql='CREATE DATABASE IF NOT EXISTS '.$vBaseDados.';';

//Executa o código SQL
$vExecucao=mysqli_query($vConexao, $vSql);
if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

//Exibe mensagem
echo '<p>Base de dados IMOBILIARIA disponível para uso.</p>';

//Fecha a conexão
mysqli_close($vConexao);


// *** CRIA TABELA USUARIOS***


//Realiza a conexão
$vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}

//Cria o código SQL
$vSql='CREATE TABLE IF NOT EXISTS usuarios
         (
         id INT(10) NOT NULL AUTO_INCREMENT, 
         nome VARCHAR(40),
		 senha VARCHAR(40),
		 tipo INT(10),
		 consultar BOOLEAN,
		 inserir BOOLEAN,
		 editar BOOLEAN,
		 excluir BOOLEAN,
         PRIMARY KEY (id),
		 CONSTRAINT usuarios_senha UNIQUE (senha)
         ); ';

//Executa o código SQL
$vExecucao=mysqli_query($vConexao, $vSql);
if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

//Exibe mensagem
echo '<p>Tabela USUARIOS disponível para uso.</p>';

//Fecha a conexão
mysqli_close($vConexao);


// *** INSERE REGISTROS TABELA USUARIOS***


//Realiza a conexão
$vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}

//Cria o código SQL
$vSql='INSERT INTO usuarios
        (nome, senha, tipo, consultar, inserir, editar, excluir)
       VALUES
        ("fernando", "admin", "1", "1", "1", "1", "1"),
        ("chico", "buarque", "2", "1", "1", "0", "0"),
        ("bob", "esponja", "3", "1", "1", "1", "0"),
        ("tulio", "getulio", "4",  "1", "1", "0", "0");';       

//Executa o código SQL
$vExecucao=mysqli_query($vConexao, $vSql);
if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

//Exibe mensagem
echo '<p>Registros em USUARIOS disponíveis para uso.</p>';

//Fecha a conexão
mysqli_close($vConexao);

// *** CRIA TABELA CIDADES***


//Realiza a conexão
$vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}

//Cria o código SQL
$vSql='CREATE TABLE IF NOT EXISTS cidades
         (
         id INT(10) NOT NULL AUTO_INCREMENT, 
         nome VARCHAR(40),
         PRIMARY KEY (id)
         ); ';

//Executa o código SQL
$vExecucao=mysqli_query($vConexao, $vSql);
if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

//Exibe mensagem
echo '<p>Tabela CIDADES disponível para uso.</p>';

//Fecha a conexão
mysqli_close($vConexao);


// *** INSERE REGISTROS TABELA CIDADES***


//Realiza a conexão
$vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}

//Cria o código SQL
$vSql='INSERT INTO cidades
        (nome)
       VALUES
        ("tramandai"),
        ("osorio"),
        ("imbé"),
        ("capão"),
        ("torres");';       

//Executa o código SQL
$vExecucao=mysqli_query($vConexao, $vSql);
if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

//Exibe mensagem
echo '<p>Registros em CIDADES disponíveis para uso.</p>';

//Fecha a conexão
mysqli_close($vConexao);


// *** CRIA TABELA CLIENTES***


//Realiza a conexão
$vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}

//Cria o código SQL
$vSql='CREATE TABLE IF NOT EXISTS clientes
         (
         id INT(10) NOT NULL AUTO_INCREMENT, 
         nome VARCHAR(40), 
         data_nasc DATE, 
         telefone VARCHAR(20), 
         cpf VARCHAR(20), 
         rg VARCHAR(20), 
         email VARCHAR(40), 
         logradouro VARCHAR(40), 
         numero VARCHAR(10), 
         bairro VARCHAR(20), 
		 complemento VARCHAR(10),
		 cidade INT(10),
		 cep VARCHAR(10),
		 uf VARCHAR(2),
		 CONSTRAINT clientes_cidade FOREIGN KEY (cidade) REFERENCES cidades(id),
		 CONSTRAINT clientes_cpf UNIQUE (cpf),
         PRIMARY KEY (id)
         ); ';

//Executa o código SQL
$vExecucao=mysqli_query($vConexao, $vSql);
if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

//Exibe mensagem
echo '<p>Tabela CLIENTES disponível para uso.</p>';

//Fecha a conexão
mysqli_close($vConexao);


// *** INSERE REGISTROS TABELA CLIENTES***


//Realiza a conexão
$vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}

//Cria o código SQL
$vSql='INSERT INTO clientes
        (nome, data_nasc, telefone, cpf, rg, email, logradouro, numero, bairro, complemento, cidade, cep, uf)
       VALUES
        ("Chico Buarque", "1970/01/01", "1000-1000", "710.555.228-02", "4125678909", "chico_buarque@teste.com.br", "tiaraju1", "8080", "AP101", "blocoA", "1", "95.590-000", "RS"),
        ("Cristiano Ronaldo", "1970/02/02", "2000-2000", "710.555.228-67", "4125678909", "CR_7@teste.com.br", "tiaraju2", "8081", "AP109", "blocoB", "1", "95.590-000", "RS"),
        ("Neymar Junior", "1974/04/04", "1000-1050", "780.555.228-10", "4625679010", "ney_caicai@teste.com.br", "tiaraju4", "8084", "AP104", "blocoD", "1", "95.590-000", "RS");';

//Executa o código SQL
$vExecucao=mysqli_query($vConexao, $vSql);
if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

//Exibe mensagem
echo '<p>Registros em CLIENTES disponíveis para uso.</p>';

//Fecha a conexão
mysqli_close($vConexao);

// *** CRIA TABELA FUNCIONARIOS***
//Realiza a conexão
$vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}

//Cria o código SQL
$vSql='CREATE TABLE IF NOT EXISTS funcionarios
         (
         id INT(10) NOT NULL AUTO_INCREMENT, 
         nome VARCHAR(40), 
         data_nasc DATE, 
         telefone VARCHAR(20), 
         cpf VARCHAR(20), 
         rg VARCHAR(20), 
         email VARCHAR(40), 
         logradouro VARCHAR(40), 
         numero VARCHAR(10), 
         bairro VARCHAR(20), 
		 complemento VARCHAR(10),
		 cidade INT(10),
		 cep VARCHAR(10),
		 uf VARCHAR(2),
		 tipo VARCHAR(40),
		 CONSTRAINT funcionarios_cidade FOREIGN KEY (cidade) REFERENCES cidades(id),
         PRIMARY KEY (id)
         ); ';

//Executa o código SQL
$vExecucao=mysqli_query($vConexao, $vSql);
if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

//Exibe mensagem
echo '<p>Tabela FUNCIONARIOS disponível para uso.</p>';

//Fecha a conexão
mysqli_close($vConexao);

// *** INSERE REGISTROS TABELA FUNCIONARIOS***


//Realiza a conexão
$vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}

//Cria o código SQL
$vSql='INSERT INTO funcionarios
        (nome, data_nasc, telefone, cpf, rg, email, logradouro, numero, bairro, complemento, cidade, cep, uf, tipo)
       VALUES
        ("Chico Buarque", "1970/01/01", "000-100", "581.979.140-08", "41289908", "chico_buarque@teste.com", "guilherme esperb" , "1820", "centro", "casa1", "1", "95.590-000", "RS", "2"),
        ("Cleo Pires", "1988/05/04", "000-200", "681.979.140-80", "5928980941", "cleo_pires@teste.com", "guilherme esperb" , "1420", "terminal", "apt2", "2", "95.590-000", "RS", "3")';

//Executa o código SQL
$vExecucao=mysqli_query($vConexao, $vSql);
if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

//Exibe mensagem
echo '<p>Registros em FUNCIONARIOS disponíveis para uso.</p>';

//Fecha a conexão
mysqli_close($vConexao);

// *** CRIA TABELA HISTORICO***


//Realiza a conexão
$vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}

//Cria o código SQL
$vSql='CREATE TABLE IF NOT EXISTS historicos
         (
         id INT(10) NOT NULL AUTO_INCREMENT, 
         descricao VARCHAR(40),
         PRIMARY KEY (id)
         ); ';

//Executa o código SQL
$vExecucao=mysqli_query($vConexao, $vSql);
if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

//Exibe mensagem
echo '<p>Tabela HISTORICO disponível para uso.</p>';

//Fecha a conexão
mysqli_close($vConexao);


// *** INSERE REGISTROS TABELA HISTORICO***


//Realiza a conexão
$vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}

//Cria o código SQL
$vSql='INSERT INTO historicos
        (descricao)
       VALUES
        ("vendas"),
        ("alugueis"),
        ("agua"),
        ("luz");';       

//Executa o código SQL
$vExecucao=mysqli_query($vConexao, $vSql);
if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

//Exibe mensagem
echo '<p>Registros em HISTORICO disponíveis para uso.</p>';

//Fecha a conexão
mysqli_close($vConexao);

// *** CRIA TABELA CAIXA***


//Realiza a conexão
$vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}

//Cria o código SQL
$vSql='CREATE TABLE IF NOT EXISTS caixa
         (
         id INT(10) NOT NULL AUTO_INCREMENT, 
         data DATE,
		 historico INT(10),
		 receita FLOAT(10,2),
		 despesa FLOAT(10,2),
		 pago BOOLEAN,
         PRIMARY KEY (id),
		 CONSTRAINT caixa_historico FOREIGN KEY (historico) REFERENCES historicos(id)
         ); ';

//Executa o código SQL
$vExecucao=mysqli_query($vConexao, $vSql);
if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

//Exibe mensagem
echo '<p>Tabela CAIXA disponível para uso.</p>';

//Fecha a conexão
mysqli_close($vConexao);


// *** INSERE REGISTROS TABELA CAIXA***


//Realiza a conexão
$vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}

//Cria o código SQL
$vSql='INSERT INTO caixa
        (data, historico, receita, despesa, pago)
       VALUES
        ("2020/01/01", "1", "2000", "0", "1"),
        ("2020/02/02", "2", "2000", "0", "1"),
        ("2020/03/03", "3", "2000", "0", "1"),
        ("2020/04/04", "4", "10000", "0", "0");';       

//Executa o código SQL
$vExecucao=mysqli_query($vConexao, $vSql);
if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

//Exibe mensagem
echo '<p>Registros em CAIXA disponíveis para uso.</p>';

//Fecha a conexão
mysqli_close($vConexao);


// *** CRIA TABELA IMOVEIS***


//Realiza a conexão
$vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}

//Cria o código SQL
$vSql='CREATE TABLE IF NOT EXISTS imoveis
         (
         id INT(10) NOT NULL AUTO_INCREMENT, 
         setor VARCHAR(10), 
         quadra VARCHAR(10), 
         lote VARCHAR(10), 
         sublote VARCHAR(10), 
         anexo VARCHAR(10), 
         logradouro VARCHAR(40), 
         numero VARCHAR(10), 
         complemento VARCHAR(20),
         bairro VARCHAR(20), 
		 cidade INT(10),
                 cep VARCHAR(20),
		 uf VARCHAR(2),
		 proprietario INT(10),
		 descricao TEXT,
		 foto VARCHAR(100),
		 preco FLOAT(10,2),
         PRIMARY KEY (id),
         CONSTRAINT imoveis_cidade FOREIGN KEY (cidade) REFERENCES cidades(id),
		 CONSTRAINT imoveis_proprietario FOREIGN KEY (proprietario) REFERENCES clientes(id)
         ); ';

//Executa o código SQL
$vExecucao=mysqli_query($vConexao, $vSql);
if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

//Exibe mensagem
echo '<p>Tabela IMOVEIS disponível para uso.</p>';

//Fecha a conexão
mysqli_close($vConexao);


// *** INSERE REGISTROS TABELA IMOVEIS***


//Realiza a conexão
$vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}

//Cria o código SQL
$vSql='INSERT INTO imoveis
        (setor, quadra, lote, sublote, anexo, logradouro, numero, bairro, cidade, uf, proprietario, descricao, foto, preco)
       VALUES
        ("222", "233", "444", "5555", "4", "flores da cunha", "4422", "portelinha", "1", "RS", "2" , "1" , "condo.JPG" , "180000"),
        ("333", "666", "999", "7777", "2", "joao de magalhaes", "7722", "terminal", "1", "RS", "2" , "2" , "house.JPG" , "140000");';

//Executa o código SQL
$vExecucao=mysqli_query($vConexao, $vSql);
if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

//Exibe mensagem
echo '<p>Registros em IMOVEIS disponíveis para uso.</p>';

//Fecha a conexão
mysqli_close($vConexao);


// *** CRIA TABELA MENSAGENS***


//Realiza a conexão
$vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}

//Cria o código SQL
$vSql='CREATE TABLE IF NOT EXISTS mensagens
         (
         id INT(20) NOT NULL AUTO_INCREMENT, 
         nome VARCHAR(40),
         email VARCHAR(40),
         telefone VARCHAR(20),
         mensagem VARCHAR(100),
         PRIMARY KEY (id)
         ); ';

//Executa o código SQL
$vExecucao=mysqli_query($vConexao, $vSql);
if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

//Exibe mensagem
echo '<p>Tabela MENSAGENS disponível para uso.</p>';

//Fecha a conexão
mysqli_close($vConexao);


// *** CRIA TABELA GALERIA ***


//Realiza a conexão
$vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}

//Cria o código SQL
$vSql='CREATE TABLE IF NOT EXISTS galeria
         (
         id INT(10) NOT NULL AUTO_INCREMENT, 
         arquivo VARCHAR(80), 
         descricao TEXT, 
         PRIMARY KEY (id)
         ); ';

//Executa o código SQL
$vExecucao=mysqli_query($vConexao, $vSql);
if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

//Exibe mensagem
echo '<p>Tabela GALERIA disponível para uso.</p>';


// *** INSERE REGISTROS ***


//Cria o código SQL
$vSql='INSERT INTO galeria
        (arquivo, descricao)
       VALUES
        ("imovel_01.jpg", "Casa de Alvenaria"), 
        ("imovel_02.jpg", "Apartamento de luxo"),        
        ("imovel_03.jpg", "Sala comercial");';       

//Executa o código SQL
$vExecucao=mysqli_query($vConexao, $vSql);
if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

//Exibe mensagem
echo '<p>Registros em IMAGENS disponíveis para uso.</p>';

//Fecha a conexão
mysqli_close($vConexao);












?>
