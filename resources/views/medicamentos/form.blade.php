@extends('template.template')

@section('title', 'Incluir medicamento - Controle de medicamentos')
@section('topo', 'Incluir medicamento')

@section('main')

<div class="row">
    @error('nome')
    @if($message === 'The nome field is required.')
    <div class="col-lg-6">
        <div class="alert alert-danger alert-dismissible fade show " role="alert">
            <i class="bi bi-exclamation-octagon me-1"></i>
            O campo nome é obrigatório
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif
@enderror

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

@error('validade')
    @if($message === 'The validade field is required.')
    <div class="col-lg-6">
        <div class="alert alert-danger alert-dismissible fade show " role="alert">
            <i class="bi bi-exclamation-octagon me-1"></i>
            O campo validade é obrigatório
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    @if($message ===  'The validade field must be a date after today.')
    <div class="col-lg-6">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-1"></i>
            A data de validade tem que ser maior que a data atual
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    @if($message ===  'The validade field must be a valid date.')
    <div class="col-lg-6">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-1"></i>
            A data de validade tem que válida
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif
@enderror
</div>

<div class="card">
    <div class="card-body">
      <h5 class="card-title">Dados do medicamento</h5>

      <!-- Multi Columns Form -->
      <form class="row g-3" action="{{ route('incluir') }}" method="POST">
        @csrf
        <div class="col-md-12">
          <label for="inputName5" class="form-label">Nome</label>
          <input type="text" name="nome" class="form-control" >
        </div>
        
        <div class="col-md-6">
          <label for="inputEmail5" class="form-label">Quantidade</label>
          <input type="number" name="quantidade" class="form-control" >
        </div>
      
        <div class="col-md-6">
          <label for="inputPassword5" class="form-label" >Validade</label>
          <input type="text" name="validade" class="form-control" id="validade">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Incluir</button>
        </div>
      </form>
      
    </div>
  </div>

@endsection 