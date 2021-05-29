<?php 
namespace Alura\leilao\Service;

use Alura\Leilao\Model\Leilao;

class Avaliador 
{
    private $maiorValor;
    public function avalia (Leilao $leilao):void
    {
        $lances = $leilao->getLances();
        $ultimolance = $lances[count($lances) - 1];
        $this->maiorValor = $ultimolance->getValor();
        

    }
public function getmaiorValor():float
{
    return $this->maiorValor;

}
}