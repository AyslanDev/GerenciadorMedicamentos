<?php

namespace App\Http\Controllers\Medicamentos;

use App\Http\Controllers\Controller;
use App\Models\Medicamentos;
use App\Models\Medicamentos_Mov;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatoriosController extends Controller
{

    public function index(Request $request)
    {
        $medicamento = $request->input('medicamento');
        $dtIni = $request->input('dtIni');
        $dtFim = $request->input('dtFim');
        $ubsFilter = $request->input('ubs');

        // Primeira consulta com agregação
        $query = DB::table('medicamentos_mov as mm')
            ->join('medicamentos as m', 'mm.nMed', '=', 'm.id')
            ->select(
                'm.nome',
                DB::raw('SUM(CASE WHEN mm.nAcao = 1 THEN mm.quantidade ELSE 0 END) as entradas'),
                DB::raw('SUM(CASE WHEN mm.nAcao = 2 THEN mm.quantidade ELSE 0 END) as saidas')
            )
            ->when(request('medicamento') && request('medicamento') !== '', function ($query) {
                return $query->where('mm.nMed', '=', request('medicamento'));
            })
            ->when(request('dtIni') && request('dtIni') !== '', function ($query) {
                return $query->where('mm.created_at', '>=', Carbon::createFromFormat('d/n/Y', request('dtIni'))->format('Y-m-d'));
            }, function($query) {
    
                $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
    
                return $query->where('mm.created_at', '>=', $startOfMonth);
    
            })
            ->when(request('dtFim') && request('dtFim') !== '', function ($query) {
                return $query->where('mm.created_at', '<=', Carbon::createFromFormat('d/n/Y', request('dtFim'))->format('Y-m-d'));
            })
            ->when(request('ubs') && request('ubs') !== '', function ($query) {
                return $query->where('mm.nUBS', '=', request('ubs'));
            })
            ->groupBy('m.nome') // Agrupando pelo nome do medicamento
            ->orderBy('m.nome', 'asc')
            ->get();

        // Segunda consulta com mais detalhes
        $queryDetail = DB::table('medicamentos_mov as mm')
            ->join('medicamentos as m', 'mm.nMed', '=', 'm.id')
            ->join('users as u', 'mm.nUBS', '=', 'u.id')
            ->select(
                'm.nome',
                DB::raw('CASE WHEN mm.nAcao = 1 THEN mm.quantidade ELSE 0 END as entradas'),
                DB::raw('CASE WHEN mm.nAcao = 2 THEN mm.quantidade ELSE 0 END as saidas'),
                'mm.quantidade',
                'mm.nAcao',
                'mm.created_at',
                'u.name'
            )
            ->when(request('medicamento') && request('medicamento') !== '', function ($queryDetail) {
                return $queryDetail->where('mm.nMed', '=', request('medicamento'));
            })
            ->when(request('dtIni') && request('dtIni') !== '', function ($queryDetail) {
                return $queryDetail->where('mm.created_at', '>=', Carbon::createFromFormat('d/n/Y', request('dtIni'))->format('Y-m-d'));
            })
            ->when(request('dtFim') && request('dtFim') !== '', function ($queryDetail) {
                return $queryDetail->where('mm.created_at', '<=', Carbon::createFromFormat('d/n/Y', request('dtFim'))->format('Y-m-d'));
            })
            ->when(request('ubs') && request('ubs') !== '', function ($queryDetail) {
                return $queryDetail->where('mm.nUBS', '=', request('ubs'));
            })
            ->orderBy('mm.created_at', 'desc')
            ->get();

        // Carregando os medicamentos e as UBS
        $medicamentos = Medicamentos::all();
        $ubs = User::all();
        // Retornando para a view com as variáveis
        return view('medicamentos.relatorio', compact('medicamentos', 'ubs', 'query', 'dtIni', 'medicamento', 'dtFim', 'ubsFilter', 'queryDetail'));
    }



    public function gerarRelatorio(Request $request)
    {
        // Recuperando os parâmetros da requisição
        $medicamento = $request->input('medicamento');
        $dtIni = $request->input('dtIni');
        $dtFim = $request->input('dtFim');
        $ubsFilter = $request->input('ubs');

        // Definir as datas de início e fim, considerando o valor passado ou valores padrões
        $dtIni = $dtIni ? Carbon::createFromFormat('d/n/Y', $dtIni)->format('Y-m-d') : Carbon::now()->startOfMonth()->format('Y-m-d');
        $dtFim = $dtFim ? Carbon::createFromFormat('d/n/Y', $dtFim)->format('Y-m-d') : null;

        // Consultando o total de entradas e saídas por medicamento
        $query = DB::table('medicamentos_mov as mm')
            ->join('medicamentos as m', 'mm.nMed', '=', 'm.id')
            ->select(
                'm.nome',
                DB::raw('SUM(CASE WHEN mm.nAcao = 1 THEN mm.quantidade ELSE 0 END) as entradas'),
                DB::raw('SUM(CASE WHEN mm.nAcao = 2 THEN mm.quantidade ELSE 0 END) as saídas')
            )
            ->when($medicamento, function ($query) use ($medicamento) {
                return $query->where('mm.nMed', '=', $medicamento);
            })
            ->when($dtIni, function ($query) use ($dtIni) {
                return $query->where('mm.created_at', '>=', $dtIni);
            })
            ->when($dtFim, function ($query) use ($dtFim) {
                return $query->where('mm.created_at', '<=', $dtFim);
            })
            ->when($ubsFilter, function ($query) use ($ubsFilter) {
                return $query->where('mm.nUBS', '=', $ubsFilter);
            })
            ->groupBy('m.nome') // Agrupando pelo nome do medicamento
            ->orderBy('m.nome', 'asc')
            ->get();

        // Consultando detalhes de entradas e saídas por medicamento
        $queryDetail = DB::table('medicamentos_mov as mm')
            ->join('medicamentos as m', 'mm.nMed', '=', 'm.id')
            ->join('users as u', 'mm.nUBS', '=', 'u.id')
            ->select(
                'm.nome',
                DB::raw('CASE WHEN mm.nAcao = 1 THEN mm.quantidade ELSE 0 END as entradas'),
                DB::raw('CASE WHEN mm.nAcao = 2 THEN mm.quantidade ELSE 0 END as saídas'),
                'mm.quantidade',
                'mm.nAcao',
                'mm.created_at',
                'u.name'
            )
            ->when($medicamento, function ($queryDetail) use ($medicamento) {
                return $queryDetail->where('mm.nMed', '=', $medicamento);
            })
            ->when($dtIni, function ($queryDetail) use ($dtIni) {
                return $queryDetail->where('mm.created_at', '>=', $dtIni);
            })
            ->when($dtFim, function ($queryDetail) use ($dtFim) {
                return $queryDetail->where('mm.created_at', '<=', $dtFim);
            })
            ->when($ubsFilter, function ($queryDetail) use ($ubsFilter) {
                return $queryDetail->where('mm.nUBS', '=', $ubsFilter);
            })
            ->orderBy('mm.created_at', 'desc')
            ->get();

        // Gerando o PDF com os resultados das consultas
        $pdf = Pdf::loadView('relatorios.medicamentos', compact('query', 'queryDetail'));

        // Retornando o PDF para download
        return $pdf->download('relatorio_medicamentos.pdf');
    }
}
