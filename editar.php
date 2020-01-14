<?php
require './scripts/usuario.class.php';
$usuario = new Usuario; 
if(isset($_POST['cadastro'])){
    header("Location: index.php");
}

if(isset($_GET['excluir'])){
    $usuario_id = addslashes($_GET['usuario_id']);
    $result = $usuario->excluirUsuario($usuario_id);

    if($result){
        echo "<script>alert('Usuario Excluído com sucesso!')</script>";
        echo "<script>location.href='editar.php'</script>";
    }else{
        echo "<script>alert('Ocorreu um erro durante a exclusão!')</script>";
    }

}
$filtro = "";

if(isset($_POST['buscar'])){
    if(isset($_POST['tipo_de_pessoa']) && !empty($_POST['tipo_de_pessoa'])){
        $tipo_de_pessoa = $_POST['tipo_de_pessoa'];
        $filtro .= " AND TIPO_PESSOA = '$tipo_de_pessoa'";
    }
    if(isset($_POST['cpf_cnpj']) && !empty($_POST['cpf_cnpj'])){
        $cpf_cnpj = addslashes($_POST['cpf_cnpj']);
        $filtro .= " AND CPF_CNPJ = '$cpf_cnpj'";
    }
    if(isset($_POST['nome']) && !empty($_POST['nome'])){
        $nome = addslashes($_POST['nome']);
        $filtro .= " AND NOME_CLIENTE = '$nome'";
    }
    if(isset($_POST['razao_social'])  && !empty($_POST['razao_social'])){
        $razao = addslashes($_POST['razao_social']);
        $filtro .= " AND RAZAO_SOCIAL = '$razao'";
    }
    if(isset($_POST['cep'])  && !empty($_POST['cep'])){
        $cep = addslashes($_POST['cep']);
        $filtro .= " AND CEP = '$cep'";
    }
    if(isset($_POST['cliente'])){
        $cliente = $_POST['cliente'];
        $filtro .= " AND CLIENTE = '$cliente'";
    }
    if(isset($_POST['fornecedor'])){
        $fornecedor = $_POST['fornecedor'];
        $filtro .= " AND FORNECEDOR = '$fornecedor'";
    }
    if(isset($_POST['funcionario'])){
        $funcionario = $_POST['funcionario'];
        $filtro .= " AND FUNCIONARIO = '$funcionario'";
    }
}

if(isset($_GET['editar'])){
    $usuario_id = addslashes($_GET['usuario_id']);
    $filtro = "AND CODIGO_USUARIO = $usuario_id";
    $result = $usuario->obterUsuarios($filtro);
    foreach($result as $dados){
    }

    $cpf = "";
    $cnpj = "";
    $razao_social = "";
    $cliente = "";
    $fornecedor = "";
    $funcionario = "";

    if($dados['TIPO_PESSOA'] == 'fisica'){
        $tipo_pessoa = "Física";
        $cpf_cnpj_field = '<div class="form-group col-md-6" id="cpf" style="display:block">
        <label>CPF</label>
        <input class="form-control" type="text" name="cpf" id="cpf_input" value="'.$dados['CPF_CNPJ'].'"readonly>
        </div>';
        $name_field = "Nome";
        $razao_field = "readonly";
    }else{
        $tipo_pessoa = "Jurídica";
        $cpf_cnpj_field = ' <div class="form-group col-md-6" id="cnpj" style="display:block">
        <label>CNPJ</label>
        <input class="form-control" type="text" name="cnpj" id="cnpj_input" value="'.$dados['CPF_CNPJ'].'" readonly>
    </div>';
        $name_field = "Nome Fantasia";
        $razao_field = "";
        $razao_social = $dados['RAZAO_SOCIAL'];
    }

    if($dados['CLIENTE']){
        $cliente = "checked";
    }
    if($dados['FORNECEDOR']){
        $fornecedor = "checked";
    }
    if($dados['FUNCIONARIO']){
        $funcionario = "checked";
    }

    if(isset($_POST['alterar'])){

        // VERIFICAR SE OS CAMPOS FORAM ENVIADOS
        if(!empty($_POST['nome']) && !empty($_POST['endereco']) && !empty($_POST['cep']) && !empty($_POST['municipio']) && !empty($_POST['cidade'])){
    
            if($dados['TIPO_PESSOA'] == "fisica"){
                    $nome = addslashes($_POST['nome']);
                    $razao_social = "";
                    $endereco = addslashes($_POST['endereco']);
                    $cep = addslashes($_POST['cep']);
                    $municipio = addslashes($_POST['municipio']);
                    $cidade = addslashes($_POST['cidade']);
                    $email = addslashes($_POST['email']);
                    $telefone = addslashes($_POST['telefone']);
                    $celular = addslashes($_POST['celular']);
                    $numero = addslashes($_POST['numero']);
                    $complemento = addslashes($_POST['complemento']);
    
            //verificando se é pessoa juridica e se enviou CNPJ
            }else if($dados['TIPO_PESSOA'] == 'juridica'){
    
                //verificando se enviou a razao social.
                if(empty($_POST['razao_social'])){
                    echo "<script>alert('O campo Razão Social é obrigatório para pessoas Jurídicas.')</script>";
                }else{
                    $razao_social = addslashes($_POST['razao_social']);
                    $nome = addslashes($_POST['nome']);
                    $endereco = addslashes($_POST['endereco']);
                    $cep = addslashes($_POST['cep']);
                    $municipio = addslashes($_POST['municipio']);
                    $cidade = addslashes($_POST['cidade']);
                    $email = addslashes($_POST['email']);
                    $telefone = addslashes($_POST['telefone']);
                    $celular = addslashes($_POST['celular']);
                    $numero = addslashes($_POST['numero']);
                    $complemento = addslashes($_POST['complemento']);
                }
            }
    
            //verificando se foi enviado pelo menos um tipo de usuario e salvando-o;
    
            if(!empty($_POST['cliente']) || !empty($_POST['fornecedor']) || !empty($_POST['funcionario'])){
    
                $cliente = 0; //default
                $fornecedor = 0; //default
                $funcionario = 0; //default
    
                if(isset($_POST['cliente'])){$cliente = $_POST['cliente'];}
                if(isset($_POST['fornecedor'])){$fornecedor = $_POST['fornecedor'];}
                if(isset($_POST['funcionario'])){$funcionario = $_POST['funcionario'];}

                if($usuario->atualizarDados($nome, $razao_social, $endereco, $cep, $municipio, $cidade, $email, $telefone, $celular, $numero, $complemento, $cliente, $fornecedor, $funcionario, $usuario_id)){
                    echo "<script>alert('Informações alteradas com sucesso!')</script>";
                    echo "<script>location.href='editar.php?editar=true&usuario_id=$usuario_id'</script>"; //redirecionando com javascript para visualizar o alert!
                }else{
                    echo "<script>alert('Ocorreu um erro, revise seus dados.')</script>";
                }
    
            }else{
                echo "<script>alert('Pelo menos uma opção de tipo de usuario deve ser selecionada.')</script>";
            }
    
        }else{
            echo "<script>alert('Os campos: Nome/Nome Fantasia, Razão Social, CEP, Endereço, Cidade e Município são obrigatórios')</script>";
        }
    }
    include './templates/update_form_block.php';
}else{
    include './templates/template_edicao.php';
}

?>