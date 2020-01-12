<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edição de Usuários</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container">
        <form method="POST">
            <nav class="nav nav-pills nav-fill">
                <button type="submit" class="btn btn-link" name="cadastro">Cadastro</button>
                <button type="submit" class="btn btn-link" name="edicao">Edição</button>
            </nav>
        </form>
        <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">Código</th>
            <th>Tipo de Pessoa</th>
            <th scope="col">Nome/Nome Fantasia</th>
            <th scope="col">Razão Social</th>
            <th scope="col">CPF/CNPJ</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $result = $usuario->obterUsuarios();

            if(empty($result)){

            }else{
                foreach($result as $usuario){
                
                    echo"<tr>
                    <th scope='row'>".$usuario['CODIGO_USUARIO']."</th>
                    <td>".$usuario['TIPO_PESSOA']."</td>
                    <td>".$usuario['NOME_CLIENTE']."</td>
                    <td>".$usuario['RAZAO_SOCIAL']."</td>
                    <td>".$usuario['CPF_CNPJ']."</td>
                    </tr>";
                    
                }
            }   
                ?>
                
        </tbody>
        </table>
            
            <?php
        ?>
</body>
</html>