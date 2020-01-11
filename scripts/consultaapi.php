<?php

require './apiconnection.class.php';

$request = new apiConnection;

if (isset($_POST['cnpj']) && !empty($_POST['cnpj'])){
    $cnpj = $_POST['cnpj'];
    $url = "http://www.receitaws.com.br/v1/cnpj/".$cnpj;

    $response = $request->apiRequest($url);

    echo $response;

}

if(isset($_POST['cep']) && !empty($_POST['cep'])){
    $cep = $_POST['cep'];
    $url = "viacep.com.br/ws/$cep/json/";

    $response = $request->apiRequest($url);
       
    echo $response;
}



?>