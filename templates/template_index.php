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
                    <input class="form-control input-group-text" type="text" value="<?=$codigo_usuario?>" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label>Tipo de Pessoa *</label>
                    <select id="inputState" class="form-control" name="tipo_de_pessoa" onfocus="verificaPessoa()">
                        <option selected value=""></option>
                        <option value="fisica">Física</option>
                        <option value="juridica">Jurídica</option>
                    </select>
                </div>
                <div class="form-group col-md-6" id="cpf_cnpj">
                    <label>CPF/CNPJ *</label>
                    <input class="form-control" type="text" readonly placeholder="Selecione o tipo de Pessoa">
                </div>
                <div class="form-group col-md-4" id="cnpj" style="display:none">
                    <label>CNPJ *</label>
                    <input class="form-control" type="text" name="cnpj" id="cnpj_input" placeholder ="Ex: 00000000000000">
                </div>
                <div class="form-group col-md-2" id="cnpj_button" style="display:none">
                    <label>&nbsp;</label>
                    <button type="button" class="btn btn-primary form-control" name="cadastrar" onclick="consultaCNPJ()">Consultar CNPJ</button>
                </div>
                <div class="form-group col-md-6" id="cpf" style="display:none"> 
                    <label id="cpf_cnpj_name">CPF *</label>
                    <input class="form-control" type="text" name="cpf" id="cpf_input" placeholder ="Ex: 000.000.000-00">
                </div>
                <div class="form-group col-md-6">
                    <label id="nome">Nome/Nome Fantasia *</label>
                    <input type="text" class="form-control" name="nome" id="nome_input">
                </div>
                <div class="form-group col-md-6">
                    <label id="razao_label">Razão Social</label>
                    <input type="text" class="form-control" name="razao_social" readonly id="razao"> 
                </div>
                <div class="form-group col-md-12">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" id="email">
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
            <input type="text" class="form-control" id="cep" name="cep" onblur="consultaCEP()">
            </div>
            <div class="form-group col-md-8">
            <label>Endereço *</label>
            <input type="text" class="form-control" name="endereco" id="endereco">
            </div>
            <div class="form-group col-md-2">
                <label>Número</label>
                <input type="text" class="form-control" name="numero" id="numero">
            </div>
            <div class="form-group col-md-4">
                <label>Complemento</label>
                <input type="text" class="form-control" name="complemento" id="complemento">
            </div>
            <div class="form-group col-md-4">
            <label>Município *</label>
            <input type="text" class="form-control" name="municipio" id="municipio">
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
                $('#cnpj').css("display","none");
                $('#cnpj_button').css("display","none");
                $('#cpf').css("display","block");
                $('#cpf_cnpj').css("display","none");
                $('#razao').attr("readonly", "readonly");
                $('#razao_label').html('Razão Social');
            }else if(value=="juridica"){
                $('#nome').html("Nome Fantasia *");
                $('#cnpj').css("display","block");
                $('#cnpj_button').css("display","block");
                $('#cpf').css("display","none");
                $('#cpf_cnpj').css("display","none");
                $('#razao').removeAttr("readonly");
                $('#razao_label').html('Razão Social *');
            }else{
                $('#nome').html("Nome/Nome Fantasia *");
                $('#cnpj').css("display","none");
                $('#cnpj_button').css("display","none");
                $('#cpf').css("display","none");
                $('#cpf_cnpj').css("display","block");
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
            $('#cpf_input').mask('000.000.000-00',  {reverse: false});
            $('#cnpj_input').mask('00000000000000',  {reverse: false});
            $('#cep').mask('00000000', {reverse: false});
        }

        function consultaCNPJ() {
            var dados = $.parseJSON($.ajax({
                type: "POST",
                url: './scripts/consultaapi.php',
                data:{cnpj:$("#cnpj_input").val()},
                async: false
                
            }).responseText);

            if(dados.status == "ERROR"){
                alert('CNPJ Inválido');
            }else{
                $('#cnpj_input').val(dados.cnpj);
                $('#nome_input').val(dados.fantasia);
                $('#razao').val(dados.nome);
                $('#email').val(dados.email);
                $('#telefone').val(dados.telefone);
                $('#cep').val(dados.cep);
                $('#endereco').val(dados.logradouro + ", " + dados.bairro);
                $('#numero').val(dados.numero);
                $('#complemento').val(dados.complemento);
                $('#municipio').val(dados.municipio);
            }
        }

        function consultaCEP(){
            if($('#cep').val() != ""){
                var dados = $.parseJSON($.ajax({
                type: "POST",
                url: './scripts/consultaapi.php',
                data: {cep:$("#cep").val()},
                async: false
                    
                }).responseText);
                if("erro" in dados){
                    alert("CEP não encontrado");
                }else{
                    $('#cep').val(dados.cep);
                    $('#endereco').val(dados.logradouro + ", " + dados.bairro);
                    $('#numero').val(dados.numero);
                    $('#complemento').val(dados.complemento);
                    $('#municipio').val(dados.localidade);
                }
            }
        }


    </script>
</body>
</html>