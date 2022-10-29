<?php

namespace App\Models;

class Dispensa {
   
    private int $quantidade_bolinhos;
    private bool $precisa_reposicao;

    public function __construct( int $quantidade_bolinhos, bool $precisa_reposicao)
    {
        $this->quantidade_bolinhos = $quantidade_bolinhos;
        $this->precisa_reposicao = $precisa_reposicao;
    }

    public function getQuantidadeBolinhos(): int
    {
        return $this->quantidade_bolinhos;
    }

    public function getPrecisaReposicao(): int
    {
        return $this->precisa_reposicao;
    }

    public function setPrecisaReposicao(bool $requisicao): void
    {
        $this->precisa_reposicao = $requisicao;
    }

    public function setQuantidadeBolinhos(int $bolinhos): void
    {
        $this->quantidade_bolinhos = $bolinhos;
    }
}