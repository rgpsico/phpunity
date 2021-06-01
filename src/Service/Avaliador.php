<?php
namespace Alura\leilao\Service;

use Alura\Leilao\Model\Leilao;
/*Classes de equivalencia
        Capitulo 03
        Os valores permitidos  
        idade por exemplo de 18 a 120  
        caso seja maior de 18 
        caso seja menor de 18 
        
        analise de valor de limite 
        ou valores de fronteira 

        Alternativa correta! Podemos identificar classes de equivalência para entender quais dados deverão ser utilizados para montar os cenários de teste. 
        Você pode conferir mais detalhes neste link, sob o título "Particionamento de Equivalência".
*/

class Avaliador
{
    private $maiorValor = -INF;
    private $menorValor = INF;
    private $maioresLances;

    public function avalia(Leilao $leilao): void
    {
        if($leilao->estaFinalizado()){
            throw new \DomainException('Leilao já finalizado');

        }

        if(empty($leilao->getLances())){
            throw new \DomainException('Não é possível avaliar leilão vazio');
        }
        
        

        foreach ($leilao->getLances() as $lance) {
            if ($lance->getValor() > $this->maiorValor) {
                $this->maiorValor = $lance->getValor();

            } 
             if ($lance->getValor() < $this->menorValor) {
                $this->menorValor = $lance->getValor();
            }
        }
        $lances = $leilao->getLances();
        usort($lances,function($lance1, $lance2){
            return $lance2->getValor() - $lance1->getValor();
        });
        $this->maioresLances = array_slice($lances,0,3);
    }
    public function getmaiorValor(): float
    {
        return $this->maiorValor;

    }

    public function getMenorValor():float 
    {
        return $this->menorValor;
    }

    public function getMaioresLances(): array
    {
        return $this->maioresLances;

    }

}
