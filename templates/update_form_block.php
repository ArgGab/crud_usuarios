<html lang="pt-br">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/style.css">

</head>
<body> 
    <div class="container">
        <small>(*) Campos Obrigatórios!</small>
        <br><br>
        <form method="POST" action="editar.php?editar=true&usuario_id=<?=$dados['CODIGO_USUARIO']?>">
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label>Código</label>
                    <input class="form-control input-group-text" type="text" value="<?=$dados['CODIGO_USUARIO']?>" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label>Tipo de Pessoa</label>
                    <select id="inputState" class="form-control" name="tipo_de_pessoa" readonly>
                        <option><?=$tipo_pessoa?></option>
                    </select>
                </div>
                <?=$cpf_cnpj_field?>
                <div class="form-group col-md-6">
                    <label id="nome"><?=$name_field?> *</label>
                    <input type="text" class="form-control" name="nome" value="<?=$dados['NOME_CLIENTE']?>">
                </div>
                <div class="form-group col-md-6">
                    <label id="razao_label">Razão Social</label>
                    <input type="text" class="form-control" name="razao_social" <?=$razao_field?> value="<?=$razao_social?>"> 
                </div>
                <div class="form-group col-md-12">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="<?=$dados['EMAIL']?>">
                </div>
                <div class="form-group col-md-6">
                    <label>Telefone</label>
                    <input type="text" class="form-control" name="telefone" value="<?=$dados['TELEFONE']?>">
                </div>
                <div class="form-group col-md-6">
                    <label>Celular</label>
                    <input type="text" class="form-control" name="celular" value="<?=$dados['CELULAR']?>">
                </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-2">
            <label>CEP *</label>
            <input type="text" class="form-control" id="cep" name="cep" onblur="consultaCEP()" maxlength="8" value="<?=$dados['CEP']?>">
            </div>
            <div class="form-group col-md-8">
            <label>Endereço *</label>
            <input type="text" class="form-control" name="endereco" id="endereco" value="<?=$dados['ENDERECO']?>">
            </div>
            <div class="form-group col-md-2">
                <label>Número</label>
                <input type="text" class="form-control" name="numero" id="numero" value="<?=$dados['NUMERO']?>">
            </div>
            <div class="form-group col-md-4">
                <label>Complemento</label>
                <input type="text" class="form-control" name="complemento" id="complemento" value="<?=$dados['COMPLEMENTO']?>">
            </div>
            <div class="form-group col-md-4">
            <label>Município *</label>
            <input type="text" class="form-control" name="municipio" id="municipio" value="<?=$dados['MUNICIPIO']?>">
            </div>
            <div class="form-group col-md-4">
            <label>Cidade *</label>
            <input type="text" class="form-control" name="cidade" value="<?=$dados['CIDADE']?>">
            </div>
            <div class="col-sm-2">Tipo de Usuario</div>
            <div class="col-sm-10">
            <small>Selecionar pelo menos um</small>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="cliente" <?=$cliente?> value="1">
                <label class="form-check-label">Cliente</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="fornecedor" <?=$fornecedor?> value="1">
                <label class="form-check-label">Fornecedor</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="funcionario" <?=$funcionario?> value="1">
                <label class="form-check-label">Funcionário</label>
            </div>
            </div>
            <button type="submit" class="btn btn-primary" name="alterar">Atualizar Dados</button>
        </form>
    </div>

    <script type="text/javascript">
        function consultaCEP(){
            if($('#cep').val() != ""){
                var dados = $.parseJSON($.ajax({
                type: "POST",
                url: 'consultaapi.php',
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