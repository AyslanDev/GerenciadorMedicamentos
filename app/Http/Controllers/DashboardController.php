<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    
    public function index()
    {

        $medicamentos = DB::table('medicamentos')
        ->leftJoin('medicamentos_mov', 'medicamentos.id', '=', 'medicamentos_mov.nMed')
        ->select('medicamentos.id', 'medicamentos.nome', 'medicamentos.validade',
            DB::raw('SUM(CASE WHEN medicamentos_mov.nAcao = 1 THEN medicamentos_mov.quantidade ELSE 0 END) as entradas'),
            DB::raw('SUM(CASE WHEN medicamentos_mov.nAcao = 2 THEN medicamentos_mov.quantidade ELSE 0 END) as saidas')
        )
        ->groupBy('medicamentos.id', 'medicamentos.nome', 'medicamentos.validade')
        ->paginate(10);

        $totalMedicamentos = DB::table('medicamentos')->count();

        $validade = DB::table('medicamentos')
        ->whereBetween('validade', [DB::raw('CURDATE()'), DB::raw('DATE_ADD(CURDATE(), INTERVAL 30 DAY)')])
        ->select('medicamentos.id', 'medicamentos.nome', 'medicamentos.validade')
        ->get();

        $validadeCount = $validade->count();

        return view('dashboard', compact('medicamentos', 'totalMedicamentos', 'validadeCount', 'validade'));

    }

}
