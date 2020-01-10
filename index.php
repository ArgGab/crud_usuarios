<?php

if(isset($_POST['edicao'])){
    include './templates/template_edicao.php';
}else{
    include './templates/template_index.php';
}

if(isset($_POST['cadastrar'])){ 

    // VERIFICAR SE OS CAMPOS FORAM ENVIADOS
if(!empty($_POST['tipo_de_pessoa']) && !empty($_POST['nome']) && !empty($_POST['cpf_cnpj']) && !empty($_POST['endereco']) && !empty($_POST['cep']) && !empty($_POST['municipio']) && !empty($_POST['cidade'])){

    //obtendo campos com proteção

    $tipo_de_pessoa = $_POST['tipo_de_pessoa'];
    $nome = addslashes($_POST['nome']);
    $endereco = addslashes($_POST['endereco']);
    $cep = addslashes($_POST['cep']);
    $municipio = addslashes($_POST['municipio']);
    $cidade = addslashes($_POST['cidade']);
    $cpf_cnpj = addslashes($_POST['cpf_cnpj']);
    $email = addslashes($_POST['email']);
    $telefone = addslashes($_POST['telefone']);
    $celular = addslashes($_POST['celular']);
    $numero = addslashes($_POST['numero']);
    $complemento = addslashes($_POST['complemento']);



    //verificando se é Juridico e se enviou Razão Social.

    if($tipo_de_pessoa == 'juridica' && empty($_POST['razao_social'])){
        echo "<script type='text/javascript'>alert('O campo Razão Social é obrigatório para pessoas Jurídicas.')</script>";
    }else{
        $razao_social = addslashes($_POST['razao_social']);
    }
    echo $razao_social;
    //verificando se foi enviado pelo menos um tipo de usuario e salvando-o;

    if(!empty($_POST['cliente']) || !empty($_POST['fornecedor']) || !empty($_POST['funcionario'])){

        //zerando para evitar warning
        $cliente = 0; //default
        $fornecedor = 0; //default
        $funcionario = 0; //default

        if(isset($_POST['cliente'])){$cliente = $_POST['cliente'];}
        if(isset($_POST['fornecedor'])){$fornecedor = $_POST['fornecedor'];}
        if(isset($_POST['funcionario'])){$funcionario = $_POST['funcionario'];}

    }else{
        echo "<script type='text/javascript'>alert('Pelo menos uma opção de tipo de usuario deve ser selecionada.')</script>";
    }



}else{
    echo "<script type='text/javascript'>alert('Os campos: Tipo de Pessoa, CPF/CNPJ, Nome/Nome Fantasia, Razão Social, CEP, Endereço, Cidade e Município são obrigatórios')</script>";
}

}else if(isset($_POST['editar'])){ 



}



?>