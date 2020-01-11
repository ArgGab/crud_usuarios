<?php

    class Usuario{

        private $pdo;

        public function __construct(){
            $dsn = "mysql:dbname=crud_total_control;host=localhost";
            $user = "root";
            $pass = "";
            try{
                $this->pdo = new PDO($dsn, $user, $pass);
            }catch(PDOExceptions $e){
                echo "ERRO: ".$e->getMessage();
            }

        }

        public function obterIdCadastro(){

            $sql = "SELECT COUNT CODIGO_USUARIO from usuarios";
            $result = $this->pdo->query($sql);

            if($result > 0){

                $result = $result->fetch() + 1;
                return $result;
            }else{
                return 1;
            }
        }

        public function inserirUsuario($tipo_pessoa, $nome_cliente, $cpf_cnpj, $razao_social, $endereco, $numero, $complemento, $cep, $municipio, $cidade, $email, $telefone, $celular, $cliente, $fornecedor, $funcionario){
            
            if($this->existeUsuario($cpf_cnpj)){
                return 0;
            }else{
                $sql = "INSERT INTO usuarios (TIPO_PESSOA, NOME_CLIENTE, CPF_CNPJ, RAZAO_SOCIAL, ENDERECO, NUMERO, COMPLEMENTO, CEP, MUNICIPIO, CIDADE, EMAIL, TELEFONE, CELULAR, CLIENTE, FORNECEDOR, FUNCIONARIO)
                        VALUES ($tipo_pessoa, $nome_cliente, $cpf_cnpj, $razao_social, $endereco, $numero, $complemento, $cep, $municipio, $cidade, $email, $telefone, $celular, $cliente, $fornecedor, $funcionario)";
                $this->pdo->query($sql);
                return 1;
                
            }

        }

        private function existeUsuario($cpf_cnpj){
            $sql = "SELECT * FROM usuarios WHERE CPF_CNPJ = $cpf_cnpj";
            $result = $this->pdo->query($sql);

            if ($result->rowCount() > 0){
                return 0;
            }else{
                return 1;
            }
        }
    }

?>