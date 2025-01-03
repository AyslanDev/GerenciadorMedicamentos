<?php

namespace App\Http\Controllers\Medicamentos;

use App\Http\Controllers\Controller;
use App\Http\Requests\Medicamentos\MedicamentosUpdateRequest;
use App\Models\Medicamentos;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MedicamentosUpdateController extends Controller
{

    public function __invoke(MedicamentosUpdateRequest $request)
    {
    
        $id = $request->id;
        
        $medicamentoUpdt = Medicamentos::find($id);

        $medicamentoUpdt->nome = $request->nome;
        $medicamentoUpdt->validade = Carbon::createFromFormat('d/n/Y', $request->validade)->format('Y-m-d');
        $medicamentoUpdt->save();

        if($medicamentoUpdt){
            return to_route('listagem')->with(['message' => 'Medicamento alterado com sucesso!']);
        }

        return back()->with(['message'=>'Erro ao alterar']);

    }

}
