@extends('template.template')

@section('title', 'Relatório de movimentações - Controle de medicamentos')
@section('topo', 'Relatório de movimentações')

@section('main')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Filtrar relatório</h5>
                        <form class="row g-3" action="{{ route('relatorio') }}" method="get">
                            @csrf
                            <div class="@if(auth()->user()->NPerm == 1) col-md-4 @else col-md-6 @endif">
                                <label for="medicamento" class="form-label">Medicamento</label>
                                <select name="medicamento" id="" class="form-control">
                                    <option value=""></option>
                                    @foreach ($medicamentos as $medicamentoOption)
                                    <option value="{{ $medicamentoOption->id }}" @selected($medicamento == $medicamentoOption->id)>{{ $medicamentoOption->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6 pe-0">
                                        <label for="dtIni" class="form-label">Data Início</label>
                                        <input type="text" name="dtIni" class="form-control validade" value="{{ old('dtIni', $dtIni) }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="dtFim" class="form-label">Data Fim</label>
                                        <input type="text" name="dtFim" class="form-control validade" value="{{ old('dtFim', $dtFim) }}">
                                    </div>
                                </div>
                            </div>
                            @if(auth()->user()->NPerm == 1)  
                            <div class="col-md-4">
                                <label for="ubs" class="form-label">Por UBS</label>
                                <select name="ubs" id="" class="form-control">
                                    <option value=""></option>
                                    @foreach ($ubs as $ub)
                                    <option value="{{ $ub->id }}" @selected($ubsFilter == $ub->id)>{{ $ub->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                            <div class="d-flex justify-content-between">
                                <div class="w-50">
                                    <button type="submit" class="btn btn-primary w-50">Filtrar</button>
                                    <a href="{{ route('relatorio') }}" class="btn btn-danger">Limpar</a>
                                </div>
                                
                            </div>
                        </form>
                        <div class="w-100 text-end">
                            <form action="{{ route('relatorio.imprimir') }}" method="get">
                                <input type="hidden" name="medicamento" value="{{ old('medicamento', request('medicamento')) }}">
                                <input type="hidden" name="dtIni" value="{{ old('dtIni', request('dtIni')) }}">
                                <input type="hidden" name="dtFim" value="{{ old('dtFim', request('dtFim')) }}">
                                <input type="hidden" name="ubs" value="{{ old('ubs', request('ubs')) }}">

                                <button type="submit" class="btn btn-success w-25">Baixar relatório</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Relatório geral</h5>
                        <div class="table-wrap">
                            <table class="table table-responsive-xl">
                                <thead>
                                    <tr>
                                        <th style="color: #012970">Nome</th>
                                        <th style="color: #012970">Entradas</th>
                                        <th style="color: #012970">Saídas</th>
                                        <th style="color: #012970">Saldo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($query as $medicamento)
                                        <tr>
                                            <td>{{ $medicamento->nome }}</td>
                                            <td>{{ $medicamento->entradas }}</td>
                                            <td>{{ $medicamento->saidas }}</td>
                                            <td>{{ $medicamento->entradas - $medicamento->saidas }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Relatório detalhado</h5>
                        <div class="table-wrap">
                            <table class="table table-responsive-xl">
                                <thead>
                                    <tr>
                                        <th style="color: #012970">Nome</th>
                                        <th style="color: #012970">Entradas</th>
                                        <th style="color: #012970">Saídas</th>
                                        <th style="color: #012970">Data</th>
                                        <th style="color: #012970">UBS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($queryDetail as $submed)
                                        <tr>
                                            <td>{{ $submed->nome }}</td>
                                            <td>{{ $submed->entradas }}</td>
                                            <td>{{ $submed->saidas }}</td>
                                            <td>{{ \Carbon\Carbon::parse($submed->created_at)->format('d/m/Y') }}</td>
                                            <td>{{ $submed->name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection