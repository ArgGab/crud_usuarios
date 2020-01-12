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
include './templates/template_edicao.php';





?>