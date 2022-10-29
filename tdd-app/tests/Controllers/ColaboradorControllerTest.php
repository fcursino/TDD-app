<?php

use App\Models\Dispensa;
use App\Models\Colaborador;

class ColaboradorTest extends TestCase {


    /**
     * @dataProvider dadosColaboradorJaTemBolinho
     * @dataProvider dadosColaboradorPegouBolinho
     * @dataProvider dadosDispensaVazia
     */
    public function testColaboradorDeveReceberRespostaCorretaDoSistema($variaveis) {
        $json_variaveis = json_decode(json_encode($variaveis));
        $request = [
            'nome_colaborador' => 'Ana',
            'area_colaborador' => 'Vendas',
            'quantidade_bolinhos_colaborador' => $json_variaveis->quantidade_bolinhos_colaborador,
            'quantidade_bolinhos_dispensa' => $json_variaveis->quantidade_bolinhos_dispensa
          ];
      
        $response = $this->post('/pegar/bolinho', $request);
        $mensagem = json_decode(json_encode($response->response->getOriginalContent()))->mensagem;
        $this->assertEquals('Ana'.$json_variaveis->resposta_esperada, $mensagem);
    }

    /* ------ DADOS ------- */
    public function dadosColaboradorJaTemBolinho() {

        $variaveis = [
            'quantidade_bolinhos_colaborador' => 1,
            'quantidade_bolinhos_dispensa' => 1,
            'resposta_esperada' => ', você já tem um bolinho'
        ];

        return [
            'colaborador-ja-tem-bolinho' => [$variaveis]
        ];
    }

    public function dadosColaboradorPegouBolinho() {

        $variaveis = [
            'quantidade_bolinhos_colaborador' => 0,
            'quantidade_bolinhos_dispensa' => 1,
            'resposta_esperada' => ', você adquiriu seu bolinho com sucesso'
        ];

        return [
            'colaborador-pegou-bolinho' => [$variaveis]
        ];
    }

    public function dadosDispensaVazia() {

        $variaveis = [
            'quantidade_bolinhos_colaborador' => 0,
            'quantidade_bolinhos_dispensa' => 0,
            'resposta_esperada' => ', a dispensa está vazia. Já pedimos mais bolinhos, fique no aguardo'
        ];

        return [
            'dispensa-vazia' => [$variaveis]
        ];
    }
}