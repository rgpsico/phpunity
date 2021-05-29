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


    public function testAvaliadorDeveEnconbtrarOmenorValorDelanceEmOrdemDECrescente(){
        $leilao = new Leilao('Fiat 147 0km');

        $maria = new Usuario('Maria');
        $joao = new Usuario('Joao');
        
        $leilao->recebeLance(new Lance($joao , 2500));
        $leilao->recebeLance(new Lance($maria , 2000));
     
       
        
        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);
        
        $menorValor = $leiloeiro->getmenorValor();
        
      

        self::assertEquals(2000,$menorValor);
    }


    public function testAvaliadorDeveEnconbtrarOmenorValorDelanceEmOrdemCrescente(){
        $leilao = new Leilao('Fiat 147 0km');

        $maria = new Usuario('Maria');
        $joao = new Usuario('Joao');
        
        $leilao->recebeLance(new Lance($joao , 2000));
        $leilao->recebeLance(new Lance($maria , 2500));
     
       
        
        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);
        
        $menorValor = $leiloeiro->getmenorValor();
        
      

        self::assertEquals(2000,$menorValor);
    }
    public function testAvaliadordevebuscartresmaioresvalores(){
        $leilao = new Leilao('fiat 147 0km');
        $joao = new Usuario('Joao');
        $maria = new Usuario('Maria');
        $ana = new Usuario('Ana');
        $jorge = new Usuario('jorge');

        $leilao->recebeLance(new Lance($ana,1500));
        $leilao->recebeLance(new Lance($joao,1000));
        $leilao->recebeLance(new Lance ($maria,2000));
        $leilao->recebeLance(new Lance($jorge, 1700));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);
        
        $maiores = $leiloeiro->getMaioresLances();
        static::assertCount(3,$maiores);
        static::assertEquals(2000,$maiores[0]->getValor());
        static::assertEquals(1700,$maiores[1]->getValor());
        static::assertEquals(1500,$maiores[2]->getValor());
    }

}