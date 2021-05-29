<?php 
namespace Alura\Leilao\Tests\Service;


use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;

use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{

    public function testAvaliadorDeveEnconbtrarOmaiorValorDelanceEmOrdemCrescente(){
        $leilao = new Leilao('Fiat 147 0km');

        $maria = new Usuario('Maria');
        $joao = new Usuario('Joao');
        
        $leilao->recebeLance(new Lance($joao , 2000));
        $leilao->recebeLance(new Lance($maria , 2500));
        
        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);
        
        $maiorValor = $leiloeiro->getmaiorValor();
        
        $valorEsperado = 2500;

        self::assertEquals(2500,$maiorValor);
    }

    public function testAvaliadorDeveEnconbtrarOmaiorValorDelanceEmOrdemDECrescente(){
        $leilao = new Leilao('Fiat 147 0km');

        $maria = new Usuario('Maria');
        $joao = new Usuario('Joao');
        
        $leilao->recebeLance(new Lance($joao , 2500));
        $leilao->recebeLance(new Lance($maria , 2000));
     
       
        
        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);
        
        $maiorValor = $leiloeiro->getmaiorValor();
        
      

        self::assertEquals(2500,$maiorValor);
    }

}