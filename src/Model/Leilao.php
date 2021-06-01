<?php

namespace Alura\Leilao\Model;

/*
TESTES de regreção

Capitulo de 05
Mais de Cinco Lances por usuario

 */
class Leilao
{
    /** @var Lance[] */
    private $lances;
    
    /** @var string */
    private $descricao;

    /**@var bool */
    private $finalizado;

    public function __construct(string $descricao)
    {
        $this->descricao = $descricao;
        $this->lances = [];
        $this->finalizado = false;
    }

    public function recebeLance(Lance $lance)
    {
        if (!empty($this->lances) && $this->ehDoUltimoUsuario($lance)) {
          throw new \DomainException(('Usuario não pode propor 2 lances consecutivos'));
        }

       
        $totalLancesUsuario =  $this->quantidadeLancesPorUsuario($usuario = $lance->getUsuario());
        if ($totalLancesUsuario >= 5) {
            throw new \DomainException(('Usuario não pode propor mai de 3 lances consecutivos'));
        }

        $this->lances[] = $lance;
    }

    public function finaliza(){
        $this->finalizado = true;
    }

    /**
     * @return Lance[]
     */
    public function getLances(): array
    {
        return $this->lances;
    }

    public function estaFinalizado(): bool
    {
        return $this->finalizado;
    }

    /**
     * @param Lance $lance
     * @return bool
     */
    private function ehDoUltimoUsuario(Lance $lance): bool
    {
        $ultimoLance = $this->lances[count($this->lances) - 1];
        return $lance->getUsuario() == $ultimoLance->getUsuario();
    }

    /**
 * @param Usuario $usuario
 * @return Lance|mixed
 */
private function quantidadeLancesPorUsuario(Usuario $usuario): int
{
    $totalLancesUsuario = array_reduce(
        $this->lances,
        function (int $totalAcumulado, Lance $lanceAtual) use ($usuario) {
            if ($lanceAtual->getUsuario() == $usuario) {
                return $totalAcumulado + 1;
            }
            return $totalAcumulado;
        },
        0
    );
    return $totalLancesUsuario;
}

}
