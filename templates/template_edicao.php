<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edição de Usuários</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <nav class="nav nav-pills nav-fill">
            <a class="nav-item nav-link" href="index.php">Cadastro</a>
            <a class="nav-item nav-link active" href="editar.php">Edição</a>
        </nav>
    </div>
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
        $result = $usuario->obterUsuarios();

        if(empty($result)){
            echo "<tr><td colspan='6'>Não existem usuários cadastrados!<td><tr>";
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
    <script type="text/javascript">
        function abrirJanelaEditar(usuario_id){

        }
        function confirmarExcluir(usuario_id){
            if (confirm("Deseja mesmo excluir este usuário?")){
                window.location.href="editar.php?excluir=true&usuario_id="+usuario_id;
            }
        }
    </script>
        
        <?php
    ?>
</body>
</html>