<?php

    class Usuario{

        private $pdo;

        public function __construct(){
            $dsn = "mysql:dbname=crud_total_control;host=localhost;charset=utf8";
            $user = "root";
            $pass = "";
            try{
                $this->pdo = new PDO($dsn, $user, $pass);
            }catch(PDOExceptions $e){
                echo "ERRO: ".$e->getMessage();
            }

        }

        public function obterIdCadastro(){

            $sql = "SELECT COUNT(CODIGO_USUARIO) AS codigos from usuarios";
            $sql = $this->pdo->query($sql);
            $result = $sql->fetch(PDO::FETCH_ASSOC);


            if($result["codigos"] > 0){
 
                return $result["codigos"] + 1;
            }else{
                return 1;
            }
        }

        public function inserirUsuario($tipo_pessoa, $nome_cliente, $cpf_cnpj, $razao_social, $endereco, $numero, $complemento, $cep, $municipio, $cidade, $email, $telefone, $celular, $cliente, $fornecedor, $funcionario){
            
            if(!$this->existeUsuario($cpf_cnpj)){

                $sql = "INSERT INTO usuarios (TIPO_PESSOA, NOME_CLIENTE, CPF_CNPJ, RAZAO_SOCIAL, ENDERECO, NUMERO, COMPLEMENTO, CEP, MUNICIPIO, CIDADE, EMAIL, TELEFONE, CELULAR, CLIENTE, FORNECEDOR, FUNCIONARIO)
                        VALUES ('$tipo_pessoa', '$nome_cliente', '$cpf_cnpj', '$razao_social', '$endereco', '$numero', '$complemento', '$cep', '$municipio', '$cidade', '$email', '$telefone', '$celular', '$cliente', '$fornecedor', '$funcionario')";
                
                if($sql = $this->pdo->query($sql)){
                    return 1;
                }
                    return 0;
                

            }else{

                return 0;
            }

        }
        public function obterUsuarios(){
            $sql = "SELECT * FROM usuarios WHERE STATUS = 'A'";
            $sql = $this->pdo->query($sql);

            if($sql->rowCount() > 0){
                $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }else{
                return array();
            }
            
        }

        private function existeUsuario($cpf_cnpj){
    
            $sql = "SELECT * FROM usuarios WHERE CPF_CNPJ = '$cpf_cnpj'";
            $sql = $this->pdo->query($sql);
    
            if ($sql->rowCount() > 0){
                return 1;
            }else{
                return 0;
            }
        }
    }

?>