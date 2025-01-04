@extends('template.template')

@section('title', 'Saída - Controle de medicamentos')
@section('topo', 'Saída')

@section('main')

<div class="card">
    <div class="card-body">
      <h5 class="card-title">Saída em medicamento</h5>

      <!-- Multi Columns Form -->
      <form class="row g-3" action="{{ route('medicamento.saida') }}" method="POST">
        @csrf
        <div class="col-md-12">
          <label for="medicamento" class="form-label">Medicamento</label>
          <select name="medicamento" class="form-control" id="">
            @foreach ($medicamentos as $med)
            <option value="{{ $med->id }}">{{ $med->nome }} - {{  \Carbon\Carbon::parse($med->validade)->format('d/m/Y')  }}</option>
            @endforeach
          </select>
        </div>
        
        <div class="col-md-12">
          <label for="inputEmail5" class="form-label">Quantidade</label>
          <input type="number" name="quantidade" class="form-control" >
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Dar saída</button>
        </div>
      </form>
      
    </div>
  </div>

@endsection