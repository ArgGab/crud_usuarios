<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edição de Usuários</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
</head>
<body onload="mascarar()">
    <div class="container"> 
        <nav class="nav nav-pills nav-fill">
            <a class="nav-item nav-link" href="index.php">Cadastro</a>
            <a class="nav-item nav-link active" href="editar.php">Edição</a>
        </nav>
        <br><br>
        <form method="POST" action="<?=$_SERVER['PHP_SELF']?>">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Tipo de Pessoa</label>
                        <select id="inputState" class="form-control" name="tipo_de_pessoa" onfocus="verificaPessoa()">
                            <option selected value="">&nbsp;</option>
                            <option value="fisica">Física</option>
                            <option value="juridica">Jurídica</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>CPF/CNPJ</label>
                        <input class="form-control" type="text" id="cpf_cnpj" name="cpf_cnpj">
                    </div>
                    <div class="form-group col-md-6">
                        <label id="nome">Nome/Nome Fantasia</label>
                        <input type="text" class="form-control" name="nome" id="nome_input">
                    </div>
                    <div class="form-group col-md-6">
                        <label id="razao_label">Razão Social</label>
                        <input type="text" class="form-control" name="razao_social" id="razao"> 
                    </div>
                    <div class="form-group col-md-12">
                    <label>CEP</label>
                    <input type="text" class="form-control" id="cep" name="cep">
                    </div>
                    <div class="col-sm-2">Tipo de Usuario</div>
                    <div class="col-sm-10">
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
                <button type="submit" class="btn btn-primary" name="buscar">Buscar Usuário</button>
            </form>
        </div>
    </div>
    <br><br>
    <table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">Código</th>
        <th scope="col">Pessoa</th>
        <th scope="col">Nome</th>
        <th scope="col">Razão Social</th>
        <th scope="col">CPF/CNPJ</th>
        <th scope="col">Endereço</th>
        <th scope="col">Número</th>
        <th scope="col">Municipio</th>
        <th scope="col">Email</th>
        <th></th>
        <th></th>
        </tr>
    </thead>
    <tbody>
    <?php
        
        $result = $usuario->obterUsuarios($filtro);

        if(empty($result)){
            echo "<tr><td colspan='10' align='center'>Não existem usuários cadastrados!<td><tr>";
        }else{
            foreach($result as $usuario){
                echo'<tr>
                <th scope="row">'.$usuario['CODIGO_USUARIO'].'</th>
                <td>'.$usuario['TIPO_PESSOA'].'</td>
                <td>'.$usuario['NOME_CLIENTE'].'</td>
                <td>'.$usuario['RAZAO_SOCIAL'].'</td>
                <td>'.$usuario['CPF_CNPJ'].'</td>
                <td>'.$usuario['ENDERECO'].'</td>
                <td>'.$usuario['NUMERO'].'</td>
                <td>'.$usuario['MUNICIPIO'].'</td>
                <td>'.$usuario['EMAIL'].'</td>
                <td><button type="button" class="btn btn-primary" onclick="abrirJanelaEditar('.$usuario["CODIGO_USUARIO"].')">Editar</button></td>
                <td><button type="button" class="btn btn-primary" name="EXCLUIR" onclick="confirmarExcluir('.$usuario['CODIGO_USUARIO'].')">Excluir</button></td>
                </tr>';
                
            }
        }   
            ?>
            
    </tbody>
    </table>
    <div class="d-flex justify-content-center">
        <a href="editar.php"><button type="button" class="btn btn-primary">Atualizar Registro</button></a>
    </div>
    <script type="text/javascript">
        function abrirJanelaEditar(usuario_id){
            window.open('editar.php?editar=true&usuario_id='+usuario_id,'popUpWindow','height=800,width=1000,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
        }
        function confirmarExcluir(usuario_id){
            if (confirm("Deseja mesmo excluir este usuário?")){
                window.location.href="editar.php?excluir=true&usuario_id="+usuario_id;
            }
        }
        function mascarar(){
            $('#cpf_cnpj').mask("000.000.000-00", {reverse: false});
            $('#cep').mask("00000-000", {reverse: false});
        }
        function alterarMascara(value){
            if(value == 'fisica'){
                $('#cpf_cnpj').mask("000.000.000-00", {reverse: false});
            }else{
                $('#cpf_cnpj').mask("00.000.000/0000-00", {reverse: false});
            }
        }
        function verificaPessoa(){
            $('select').change(function (){
                $('#cpf_cnpj').val("");
                var value = $("select option:selected").val();
                alterarMascara(value);
            });
                
        }
    </script>
        
        <?php
    ?>
</body>
</html>