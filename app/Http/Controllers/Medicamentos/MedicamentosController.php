<?php

namespace App\Http\Controllers\Medicamentos;

use App\Http\Controllers\Controller;
use App\Http\Requests\Medicamentos\MedicamentoRequest;
use App\Models\Medicamentos;
use App\Models\Medicamentos_Mov;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MedicamentosController extends Controller
{
    public function index()
    {

        return view('medicamentos.form');

    }

    public function store(MedicamentoRequest $request)
    {

        $data = [
            'nome' => $request->nome,
            'nUbs' => auth()->id(),
            'validade' => Carbon::createFromFormat('d/n/Y', $request->validade)->format('Y-m-d')
        ];

        $medicamento = Medicamentos::create($data);

        $data = null;
        $data = [
            'nMed' => $medicamento->id,
            'nUser' => auth()->id(),
            'nUBS' => auth()->id(),
            'quantidade' => $request->quantidade,
            'nAcao' => 1,
        ];

        $medicamento_mov = Medicamentos_Mov::create($data);

        if ($medicamento AND $medicamento_mov) {

            return to_route('listagem')->with(['message' => 'Medicamento cadastrado com sucesso!']);

        }

        return back()->with(['message'=>'Erro ao cadastrar']);

    }
}
