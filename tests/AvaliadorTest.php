<?php 
namespace Alura\Leilao\Tests\Service;

/*Parei na aula 07 xml capitulo 04*/
use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;

use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
    private $leiloeiro;

    protected function setUp(): void{
    $this->leiloeiro = new Avaliador();
    }
    /** 
    * @dataProvider leilaoEmOrdemAleatoria
    * @dataProvider leilaoEmOrdemCrescente
    * @dataProvider leilaoEmOrdemDeCrescente
    */ 

    public function testAvaliadorDeveEnconbtrarOmaiorValorDelanceEmOrdemCrescente(Leilao $leilao){
        $this->leiloeiro->avalia($leilao);
        
        $maiorValor = $this->leiloeiro->getmaiorValor();
        
        $valorEsperado = 2500;

        self::assertEquals(2500,$maiorValor);
    }

    
 /** 
    * @dataProvider leilaoEmOrdemAleatoria
    * @dataProvider leilaoEmOrdemCrescente
    * @dataProvider leilaoEmOrdemDeCrescente
    */ 

    public function testAvaliadorDeveEnconbtrarOmenorValorDelance(Leilao $leilao){
     
        $this->leiloeiro->avalia($leilao);
        
        $menorValor = $this->leiloeiro->getmenorValor();
        self::assertEquals(1700,$menorValor);
    }
    
    /** 
    * @dataProvider leilaoEmOrdemAleatoria
    * @dataProvider leilaoEmOrdemCrescente
    * @dataProvider leilaoEmOrdemDeCrescente
    */ 

    public function testAvaliadorDeveEnconbtrarOmenorValorDelanceEmOrdemCrescente(Leilao $leilao){
      
        $this->leiloeiro->avalia($leilao);
        
        $menorValor = $this->leiloeiro->getmenorValor();
        
        self::assertEquals(1700,$menorValor);
    }

    public function leilaoEmOrdemCrescente(){
        $leilao = new Leilao('Fiat 147 0km');

        $maria = new Usuario('Maria');
        $joao  = new Usuario('Joao');
        $ana   = new Usuario('Ana');

        $leilao->recebeLance(new Lance($ana, 1700));
        $leilao->recebeLance(new Lance($joao , 2000));
        $leilao->recebeLance(new Lance($maria , 2500));

        return ['ordem-crescente'=>
            [$leilao]
        ];

    }

    public function leilaoEmOrdemDeCrescente(){
        $leilao = new Leilao('Fiat 147 0km');

        $maria = new Usuario('Maria');
        $joao  = new Usuario('Joao');
        $ana   = new Usuario('Ana');

        $leilao->recebeLance(new Lance($maria , 2500));
        $leilao->recebeLance(new Lance($joao , 2000));
        $leilao->recebeLance(new Lance($ana, 1700));
        
    

        return ['ordem-Decrescente'=>
            [$leilao]
        ];

    }

    public function leilaoEmOrdemAleatoria(){
        $leilao = new Leilao('Fiat 147 0km');

        $maria = new Usuario('Maria');
        $joao  = new Usuario('Joao');
        $ana   = new Usuario('Ana');

        
        $leilao->recebeLance(new Lance($joao , 2000));
        $leilao->recebeLance(new Lance($maria , 2500));
        $leilao->recebeLance(new Lance($ana, 1700));
        
    
        return ['ordem-Aleatoria'=>
            [$leilao]
        ];

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