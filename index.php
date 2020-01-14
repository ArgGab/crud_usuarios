<?php

require './scripts/usuario.class.php';
$usuario = new Usuario; 

$codigo_usuario = $usuario->obterIdCadastro(); //obtendo código que aparece na tela de cadastro

if(isset($_POST['cadastrar'])){

    // VERIFICAR SE OS CAMPOS FORAM ENVIADOS
    if(!empty($_POST['tipo_de_pessoa']) && !empty($_POST['nome']) && !empty($_POST['endereco']) && !empty($_POST['cep']) && !empty($_POST['municipio']) && !empty($_POST['cidade'])){
        $tipo_de_pessoa = $_POST['tipo_de_pessoa'];

        //verificando se é pessoa fisica e se enviou CPF
        if($tipo_de_pessoa == 'fisica'){
            if(!empty($_POST['cpf'])){
                $nome = addslashes($_POST['nome']);
                $razao_social = "";
                $endereco = addslashes($_POST['endereco']);
                $cep = addslashes($_POST['cep']);
                $municipio = addslashes($_POST['municipio']);
                $cidade = addslashes($_POST['cidade']);
                $cpf_cnpj = addslashes($_POST['cpf']);
                $email = addslashes($_POST['email']);
                $telefone = addslashes($_POST['telefone']);
                $celular = addslashes($_POST['celular']);
                $numero = addslashes($_POST['numero']);
                $complemento = addslashes($_POST['complemento']);

                //verificando se foi enviado pelo menos um tipo de usuario e salvando-o;

                if(!empty($_POST['cliente']) || !empty($_POST['fornecedor']) || !empty($_POST['funcionario'])){

                    $cliente = 0; //default
                    $fornecedor = 0; //default
                    $funcionario = 0; //default

                    if(isset($_POST['cliente'])){$cliente = $_POST['cliente'];}
                    if(isset($_POST['fornecedor'])){$fornecedor = $_POST['fornecedor'];}
                    if(isset($_POST['funcionario'])){$funcionario = $_POST['funcionario'];}


                    //Se chegou até aqui, tudo foi enviado corretamente - Inserir no Banco

                    if($usuario->inserirUsuario($tipo_de_pessoa, $nome, $cpf_cnpj, $razao_social, $endereco, $numero, $complemento, $cep, $municipio, $cidade, $email, $telefone, $celular, $cliente, $fornecedor, $funcionario)){
                        echo "<script>alert('Usuário inserido com sucesso!')</script>";
                        echo "<script>location.href='index.php'</script>"; //redirecionando com javascript para ver o alert e para atualizar número do código.
                        
                    }else{
                        echo "<script>alert('CPF/CNPJ já cadastrado.')</script>";
                    }

                }else{
                    echo "<script>alert('Pelo menos uma opção de tipo de usuario deve ser selecionada.')</script>";
                }
                }else{
                    echo "<script>alert('O preenchimento do CPF é obrigatório.')</script>";
                }
        
            //Se chegou até aqui é jurídica verificando se enviou CNPJ e Razão social

        }else if (empty($_POST['razao_social']) || empty($_POST['cnpj'])){
                
            echo "<script>alert('Os campos Razão Social e CNPJ são obrigatórios para pessoas Jurídicas.')</script>";

        }else{
            $razao_social = addslashes($_POST['razao_social']);
            $nome = addslashes($_POST['nome']);
            $endereco = addslashes($_POST['endereco']);
            $cep = addslashes($_POST['cep']);
            $municipio = addslashes($_POST['municipio']);
            $cidade = addslashes($_POST['cidade']);
            $cpf_cnpj = addslashes($_POST['cnpj']);
            $email = addslashes($_POST['email']);
            $telefone = addslashes($_POST['telefone']);
            $celular = addslashes($_POST['celular']);
            $numero = addslashes($_POST['numero']);
            $complemento = addslashes($_POST['complemento']);

            //verificando se foi enviado pelo menos um tipo de usuario e salvando-o;

            if(!empty($_POST['cliente']) || !empty($_POST['fornecedor']) || !empty($_POST['funcionario'])){

                $cliente = 0; //default
                $fornecedor = 0; //default
                $funcionario = 0; //default

                if(isset($_POST['cliente'])){$cliente = $_POST['cliente'];}
                if(isset($_POST['fornecedor'])){$fornecedor = $_POST['fornecedor'];}
                if(isset($_POST['funcionario'])){$funcionario = $_POST['funcionario'];}


                //Se chegou até aqui, tudo foi enviado corretamente - Inserir no Banco

                if($usuario->inserirUsuario($tipo_de_pessoa, $nome, $cpf_cnpj, $razao_social, $endereco, $numero, $complemento, $cep, $municipio, $cidade, $email, $telefone, $celular, $cliente, $fornecedor, $funcionario)){
                    echo "<script>alert('Usuário inserido com sucesso!')</script>";
                    echo "<script>location.href='index.php'</script>"; //redirecionando com javascript para ver o alert e para atualizar número do código.
                    
                }else{
                    echo "<script>alert('CPF/CNPJ já cadastrado.')</script>";
                }

            }else{
                echo "<script>alert('Pelo menos uma opção de tipo de usuario deve ser selecionada.')</script>";
            }
        }

    }else{
        echo "<script>alert('Os campos: Tipo de Pessoa, CPF/CNPJ, Nome/Nome Fantasia, Razão Social, CEP, Endereço, Cidade e Município são obrigatórios')</script>";
    }
}

include './templates/template_index.php';

?>