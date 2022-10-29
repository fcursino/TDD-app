<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Dispensa;
use App\Models\Colaborador;
use Laravel\Lumen\Routing\Controller as BaseController;

class ColaboradorController extends BaseController
{

    private $dispensa;

    public function __construct() {
        $this->dispensa = new Dispensa(1, false);
      }

    public function pegarBolinhoNaDispensa(Request $request) {
        
        $colaborador = new Colaborador(
            $request->nome_colaborador, 
            $request->area_colaborador, 
            $request->quantidade_bolinhos_colaborador
        );

        $this->dispensa->setQuantidadeBolinhos($request->quantidade_bolinhos_dispensa);

        try {
            $colaborador->pegaBolinho($this->dispensa);
            return response()->json(['mensagem' => $colaborador->getNome().', você adquiriu seu bolinho com sucesso'], 200);
        } catch(Exception $e) {
            return response()->json(['mensagem' => $e->getMessage()], 200);
        }

        
    }
}
