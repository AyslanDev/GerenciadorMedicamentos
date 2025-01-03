<?php

namespace App\Http\Controllers\Medicamentos;

use App\Http\Controllers\Controller;
use App\Http\Requests\Medicamentos\MedicamentosEntradaRequest;
use App\Models\Medicamentos;
use App\Models\Medicamentos_Mov;
use Illuminate\Http\Request;

class MedicamentosEntradaController extends Controller
{
    public function index()
    {

        $medicamentos = Medicamentos::all();
        
        return view('medicamentos.entrada', compact('medicamentos'));

    }

    public function store(MedicamentosEntradaRequest $request)
    {

        $data = [
            'nMed' => $request->medicamento,
            'nUser' => auth()->id(),
            'nUBS' => auth()->id(),
            'quantidade' => $request->quantidade,
            'nAcao' => 1,
        ];

        $entrada = Medicamentos_Mov::create($data);

        if($entrada)
        {
            return to_route('medicamento.entrada')->with(['message' => 'Entrada realizada com sucesso!']);
        }

        return back()->with(['message'=>'Erro ao dar entrada']);

    }
}
