<?php

require realpath(dirname(__FILE__, 4)).'\vendor\autoload.php';

// dependências
use App\Helpers\Awesome\Economy;

function dolarValue() {
    $economy = new Economy;

    // executa a requisição da api
    $cotation = $economy->CotationConsult('USD', 'BRL');
    
    // ajusta o responde dos dados
    $cotation = $cotation['USDBRL'] ?? [];
    
    // retorna o valor da cotação atual do dólar em real.
    return $cotation['bid'];
}


