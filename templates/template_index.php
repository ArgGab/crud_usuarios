<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro Usuário</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
    <link rel="stylesheet" href="./css/style.css">

</head>
<body onload="masks()"> 
    <div class="container">
        <form method="POST">
            <nav class="nav nav-pills nav-fill">
                <button type="submit" class="btn btn-link" name="cadastro">Cadastro</button>
                <button type="submit" class="btn btn-link" name="edicao">Edição</button>
            </nav>
        </form>
        <h1>Cadastro de Usuarios</h1>
        <small>(*) Campos Obrigatórios!</small>
        <br><br>
        <form method="POST">
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label>Código</label>
                    <input class="form-control input-group-text" type="text" value="@" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label>Tipo de Pessoa *</label>
                    <select id="inputState" class="form-control" name="tipo_de_pessoa" onfocus="verificaPessoa()">
                        <option selected value=""></option>
                        <option value="fisica">Física</option>
                        <option value="juridica">Jurídica</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label id="cpf_cnpj_name">CPF/CNPJ *</label>
                    <input class="form-control" type="text" name="cpf_cnpj" id="cpf_cnpj_field" readonly placeholder="Selecione o Tipo de Pessoa">
                </div>
                <div class="form-group col-md-6">
                    <label>Nome/Nome Fantasia *</label>
                    <input type="text" class="form-control" name="nome">
                </div>
                <div class="form-group col-md-6">
                    <label id="razao_label">Razão Social</label>
                    <input type="text" class="form-control" name="razao_social" readonly id="razao"> 
                </div>
                <div class="form-group col-md-12">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="form-group col-md-6">
                    <label>Telefone</label>
                    <input type="text" class="form-control" name="telefone" id="telefone">
                </div>
                <div class="form-group col-md-6">
                    <label>Celular</label>
                    <input type="text" class="form-control" name="celular" id="celular">
                </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-2">
            <label>CEP *</label>
            <input type="text" class="form-control" id="cep" name="cep">
            </div>
            <div class="form-group col-md-8">
            <label>Endereço *</label>
            <input type="text" class="form-control" name="endereco">
            </div>
            <div class="form-group col-md-2">
                <label>Número</label>
                <input type="text" class="form-control" name="numero">
            </div>
            <div class="form-group col-md-4">
                <label>Complemento</label>
                <input type="text" class="form-control" name="complemento">
            </div>
            <div class="form-group col-md-4">
            <label>Município *</label>
            <input type="text" class="form-control" name="municipio">
            </div>
            <div class="form-group col-md-4">
            <label>Cidade *</label>
            <input type="text" class="form-control" name="cidade">
            </div>
            <div class="col-sm-2">Tipo de Usuario</div>
            <div class="col-sm-10">
            <small>Selecionar pelo menos um</small>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="cliente" value="1">
                <label class="form-check-label">Cliente</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="fornecedor" value="1">
                <label class="form-check-label">Fornecedor</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="funcionario" value="1">
                <label class="form-check-label">Funcionário</label>
            </div>
            </div>
            <button type="submit" class="btn btn-primary" name="cadastrar">Cadastrar</button>
        </form>
    </div>
    <script type="text/javascript">
        function alterarFormulario(value){
            if(value == 'fisica'){
                $('#nome').html("Nome *");
                $('#cpf_cnpj_name').html('CPF *');
                $('#cpf_cnpj_field').mask('000.000.000-00', {reverse:false});
                $('#cpf_cnpj_field').removeAttr("readonly");
                $('#cpf_cnpj_field').removeAttr("placeholder");
                $('#razao').attr("readonly", "readonly");
                $('#razao_label').html('Razão Social');
            }else if(value=="juridica"){
                $('#nome').html("Nome Fantasia *");
                $('#cpf_cnpj_name').html('CNPJ *');
                $('#cpf_cnpj_field').mask('00.000.000/0000-00', {reverse:false});
                $('#cpf_cnpj_field').removeAttr("readonly");
                $('#cpf_cnpj_field').removeAttr("placeholder");
                $('#razao').removeAttr("readonly");
                $('#razao_label').html('Razão Social *');
            }else{
                $('#nome').html("Nome/Nome Fantasia *");
                $('#cpf_cnpj_name').html('CPF/CNPJ *');
                $('#cpf_cnpj_field').attr("readonly","readonly");
                $('#cpf_cnpj_field').attr("placeholder","Selecione o Tipo de Pessoa");
                $('#razao').attr("readonly", "readonly");
                $('#razao_label').html('Razão Social');
            }
        }
        function verificaPessoa(){
            $('select').change(function (){
                var value = $("select option:selected").val();
                alterarFormulario(value);
            });
                
        }
        function masks(){
            $('#cep').focus(function (){
                $(this).mask('00000-000', {reverse:false});
            });

            $('#telefone').focus(function (){
                $(this).mask('(00) 0000-0000', {reverse:false});
            });

            $('#celular').focus(function (){
                $(this).mask('(00) 0 0000-0000', {reverse:false});
            });
        }
    </script>
</body>
</html>