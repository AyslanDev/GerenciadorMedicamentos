<?php

namespace App\Http\Controllers\Medicamentos;

use App\Http\Controllers\Controller;
use App\Http\Requests\Medicamentos\MedicamentosSaidaRequest;
use App\Models\Medicamentos;
use App\Models\Medicamentos_Mov;
use Illuminate\Http\Request;

class MedicamentosSaidaaController extends Controller
{
    public function index(){

        $medicamentos = Medicamentos::all();
        
        return view('medicamentos.saida', compact('medicamentos'));

    }

    public function store(MedicamentosSaidaRequest $request)
    {

        $data = [
            'nMed' => $request->medicamento,
            'nUser' => auth()->id(),
            'nUBS' => auth()->id(),
            'quantidade' => $request->quantidade,
            'nAcao' => 2,
        ];

        $entrada = Medicamentos_Mov::create($data);

        if($entrada)
        {
            return to_route('medicamento.entrada')->with(['message' => 'Saída realizada com sucesso!']);
        }

        return back()->with(['message'=>'Erro ao dar saída']);

    }
}
