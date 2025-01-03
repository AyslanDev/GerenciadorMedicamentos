@extends('template.template')

@section('title', 'Entrada - Controle de medicamentos')
@section('topo', 'Entrada')

@section('main')

@error('quantidade')
    @if($message === 'The quantidade field is required.')
    <div class="col-lg-6">
        <div class="alert alert-danger alert-dismissible fade show " role="alert">
            <i class="bi bi-exclamation-octagon me-1"></i>
            O campo quantidade é obrigatório
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    @if($message === 'The quantidade field must be at least 1.')
    <div class="col-lg-6">
        <div class="alert alert-warning alert-dismissible fade show " role="alert">
            <i class="bi bi-exclamation-triangle me-1"></i>
            A quantidade tem que ser maior que 1
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif    
@enderror

<div class="card">
    <div class="card-body">
      <h5 class="card-title">Entrada em medicamento</h5>

      <!-- Multi Columns Form -->
      <form class="row g-3" action="{{ route('medicamento.entrada') }}" method="POST">
        @csrf
        <div class="col-md-12">
          <label for="medicamento" class="form-label">Medicamento</label>
          <select name="medicamento" class="form-control" id="">
            @foreach ($medicamentos as $med)
            <option value="{{ $med->id }}">{{ $med->nome }}</option>
            @endforeach
          </select>
        </div>
        
        <div class="col-md-12">
          <label for="inputEmail5" class="form-label">Quantidade</label>
          <input type="number" name="quantidade" class="form-control" >
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Dar entrada</button>
        </div>
      </form>
      
    </div>
  </div>

@endsection