<?php
namespace Alura\Leilao\Tests\Model;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use PHPUnit\Framework\TestCase;

class LeilaoTest extends TestCase
{

    

    public function testLeilaoNaoDeveReceberLancesRepetidos(){

        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Usuario não pode propor 2 lances consecutivos');

        $leilao = new leilao('Variante');
        $ana = new Usuario('Ana');

        $leilao->recebeLance(new Lance($ana , 1000));
        $leilao->recebeLance(new Lance($ana, 1500));

      

    }
    /**
     * @dataProvider geraLances
     */
    public function testLeilaoDeveReceberLances(int $qtdLances, Leilao $leilao, array $valores)
    {
        static::assertCount($qtdLances, $leilao->getLances());
        foreach ($valores as $i => $valorEsperado) {
            static::assertEquals($valorEsperado, $leilao->getLances()[$i]->getValor());
        }
    }
    public function geraLances()
    {

        $joao = new Usuario("Joao");
        $maria = new Usuario("Maria");

        $leilaoCom2Lances = new Leilao("Fiat 147 0km");
        $leilaoCom2Lances->recebeLance(new Lance($joao, 1000));
        $leilaoCom2Lances->recebeLance(new Lance($maria, 2000));

        $leilaoCom1Lance = new Leilao("Fusca 147 0km");
        $leilaoCom1Lance->recebeLance(new Lance($maria, 5000));

        

        return [
            '2-lances' => [2, $leilaoCom2Lances, [1000, 2000]],
            '1-lance' => [1, $leilaoCom1Lance, [5000]],
        ];
    }

    public function testeLeilaoNaoDeveAceitarMaisDe5LancesPorUsuario(){
        $this->expectException(\Domainexception::class);
        $this->expectExceptionMessage('Usuario não pode propor mai de 3 lances consecutivos');
        
        $leilao = new Leilao('Brasilia amarela');
        $joao = new Usuario('Joao');
        $maria = new Usuario("Maria");

        $leilao->recebeLance(new Lance($joao , 1000));
        $leilao->recebeLance(new Lance($maria , 1500));
        $leilao->recebeLance(new Lance($joao , 2000));
        $leilao->recebeLance(new Lance($maria , 2500));
        $leilao->recebeLance(new Lance($joao , 3000));
        $leilao->recebeLance(new Lance($maria , 3500));
        $leilao->recebeLance(new Lance($joao , 4000));
        $leilao->recebeLance(new Lance($maria , 4500));
        $leilao->recebeLance(new Lance($joao , 5000));
        $leilao->recebeLance(new Lance($maria , 5500));

        $leilao->recebeLance(new Lance($joao, 6000));
        static::assertCount(10,$leilao->getLances());
        static::assertEquals(5500,$leilao->getLances()[count($leilao->getLances()) - 1]->getValor());



    }

}
