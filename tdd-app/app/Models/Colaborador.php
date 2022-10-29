<?php

namespace App\Models;

use App\Models\Dispensa;

class Colaborador {
   
    private string $nome;
    private string $area;
    private int $quantidade_bolinhos;

    public function __construct( string $nome, string $area, int $quantidade_bolinhos)
    {
        $this->nome = $nome;
        $this->area = $area;
        $this->quantidade_bolinhos = $quantidade_bolinhos;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getArea(): string
    {
        return $this->area;
    }

    public function getQuantidadeBolinhos(): int
    {
        return $this->quantidade_bolinhos;
    }

    public function pegaBolinho(Dispensa $dispensa): void
    {
        if($this->quantidade_bolinhos > 0) {
            throw new \DomainException($this->nome.', você já tem um bolinho');
        }
        elseif ($dispensa->getQuantidadeBolinhos() === 0) {
            $this->pedeReposicao($dispensa);
            throw new \DomainException($this->nome.', a dispensa está vazia. Já pedimos mais bolinhos, fique no aguardo');
        }
        else {
            $dispensa->setQuantidadeBolinhos($dispensa->getQuantidadeBolinhos() - 1);
            $this->quantidade_bolinhos += 1;

        }
    }

    public function pedeReposicao(Dispensa $dispensa): void
    {
        $dispensa->setPrecisaReposicao(true);
    }
}