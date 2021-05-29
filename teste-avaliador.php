<?php 

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;

require 'vendor\autoload.php';

$leilao = new Leilao('Fiat 147 0km');

$maria = new Usuario('Maria');
$joao = new Usuario('Joao');

$leilao->recebeLance(new Lance($joao , 2000));
$leilao->recebeLance(new Lance($maria , 2500));

$leiloeiro = new Avaliador();
$leiloeiro->avalia($leilao);

$maiorValor = $leiloeiro->getmaiorValor();

$valorEsperado = 2500;
if($maiorValor == $valorEsperado){
    echo "teste ok";
}else{
    echo "teste falhou";
}

/*

A estrutura de um teste automatizado: 
Quando falamos de testes automatizados estamos falando de tres partes 
a primeira parte é  Arrange - Given: 
Voce preparar o ambiente pro teste  , onde voce cria um cenario , 
por exemplo : se o usuario no campo nome digitar numeros , qual o resultado teremos ? 
              se o usuario no campo telefone digitar 20 numeros qual a resposta ele tera 
              se digitar o padrao correto qual resposta receberar 
ou seja , a primeira parte onde você vai imaginar varias hipoteses , varios cenários. 

a segunda parte é ACT-When : 
execultar o codigo que iremos testar  

terceira parte (ASSERT-then):
e a terceira e saber se o valor esperado e o valor que esperamos.  

padrão:
arrange act assert 
ou 
givewhenthen 






*/



