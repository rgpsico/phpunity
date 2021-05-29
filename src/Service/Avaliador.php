<?php
namespace Alura\leilao\Service;

use Alura\Leilao\Model\Leilao;

class Avaliador
{
    private $maiorValor = -INF;
    private $menorValor = INF;

    public function avalia(Leilao $leilao): void
    {

        foreach ($leilao->getLances() as $lance) {
            if ($lance->getValor() > $this->maiorValor) {
                $this->maiorValor = $lance->getValor();

            } 
             if ($lance->getValor() < $this->menorValor) {
                $this->menorValor = $lance->getValor();
            }
        }
    }
    public function getmaiorValor(): float
    {
        return $this->maiorValor;

    }

    public function getMenorValor():float 
    {
        return $this->menorValor;
    }

}
