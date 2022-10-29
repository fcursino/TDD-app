<?php

namespace App\Tests\Models;

use App\Models\Dispensa;
use App\Models\Colaborador;
use PHPUnit\Framework\TestCase;

class ColaboradorTest extends TestCase {

    public function testColaboradorDeveConseguirPegarBolinho() {
        
        $dispensa = new Dispensa(1, false);
        $ana = new Colaborador('Ana', 'Vendas', 0);

        $ana->pegaBolinho($dispensa);     

        $bolinhos_ana = $ana->getQuantidadeBolinhos();

        $this->assertEquals(1, $bolinhos_ana);
        $this->assertEquals(0, $dispensa->getQuantidadeBolinhos());
    }

    public function testColaboradorNãoDeveConseguirPegarMaisDeUmBolinho() {
        
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Ana, você já tem um bolinho');

        $dispensa = new Dispensa(1, false);
        $ana = new Colaborador('Ana', 'Vendas', 1);

        $ana->pegaBolinho($dispensa);
    }

    public function testColaboradorDevePedirReposicaoCasoDispensaEstejaVazia() {

        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Ana, a dispensa está vazia. Já pedimos mais bolinhos, fique no aguardo');

        $dispensa = new Dispensa(0, false);
        $ana = new Colaborador('Ana', 'Vendas', 0);

        $ana->pegaBolinho($dispensa);
    }
}