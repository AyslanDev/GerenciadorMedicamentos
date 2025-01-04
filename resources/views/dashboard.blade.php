@extends('template.template')

@section('title', 'Listagem - Controle de medicamentos')
@section('topo', 'Listagem')

@section('main')

<section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">

          <!-- Sales Card -->
          <div class="col-md-6">
            <div class="card info-card ">

              <div class="card-body">
                <h5 class="card-title text-danger">Total <span>| Medicamentos</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-capsule text-danger"></i>
                  </div>
                  <div class="ps-3">
                    <h6 class="text-danger">
                      {{ $totalMedicamentos }} Med
                    </h6>
                    {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Sales Card -->

          <!-- Revenue Card -->
          <div class="col-md-6">
            <div class="card info-card " id="cardScale">

              <div class="card-body" data-bs-toggle="modal" data-bs-target="#modal_venci" id="cardVenci">
                <h5 class="card-title text-primary">Validade <span>| Próximo do vencimento</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bx bxs-calendar text-primary"></i>
                  </div>
                  <div class="ps-3">
                    <h6 class="text-primary"> {{ $validadeCount }} Med</h6>
                    {{-- <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Revenue Card -->


          <!-- Reports -->
        </div>
      </div>
    </div>
  </section>

  <section class="section table">
    <div class="row">
      <div class="col-md-12">
        <div class="card" style="box-shadow: 0px 0 30px rgba(1, 41, 112, 0.1);">
          <div class="card-body">
            <h5 class="card-title"></h5>
            <div class="table-wrap">
              <table class="table table-responsive-xl">
                <thead >
                  <tr >
                    <th style="color: #012970">Medicamento</th>
                    <th style="color: #012970">Quantidade</th>
                    <th style="color: #012970">Validade</th>
                    <th style="color: #012970; text-align:center;">Ações</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($medicamentos as $medicamento)
                  <tr>
                    <td>{{ $medicamento->nome }}</td>
                    <td>{{ $medicamento->entradas - $medicamento->saidas }}</td>
                    <td>{{ \Carbon\Carbon::parse($medicamento->validade)->format('d/m/Y') }}</td>
                    <td class="text-center">
                      <button type="button" 
                      class="btn btn-sm btn-primary text-white" 
                      data-bs-toggle="modal" data-bs-target="#largeModal" 
                      data-id="{{ $medicamento->id }}"
                      data-nome="{{ $medicamento->nome }}"
                      data-validade="{{ \Carbon\Carbon::parse($medicamento->validade)->format('d/m/Y') }}" id="btn_modal_val">
                        <i class="bx bxs-edit-alt"></i>
                      </button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="pagination-container text-dark">
                {{ $medicamentos->links('pagination::bootstrap-4') }}
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- MODAL PARA EDIÇÃO DE ITEM-->

  <div class="modal fade" id="largeModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="title_modal">Alterar medicamento</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action=" {{ route('medicamento.alterar') }} " method="post">
            @csrf
            <input type="hidden" name="id" id="id_val">
            <div class="row">
              <div class="col-md-12 mb-3">
                <label for="nome" class="form-label">Medicamento</label>
                <input type="text" class="form-control" name="nome" id="medicamento_val">
              </div>
              <div class="col-md-12 mb-3">
                <label for="validade" class="form-label">Validade</label>
                <input type="text" class="form-control validade" name="validade" id="validade_val">
              </div>
              <div class="col-12 text-center">
                <button class="btn btn-primary w-50" type="submit">Alterar</button>
              </div>
            </div>
            
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal_venci" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="title_modal">Medicamentos perto do prazo de validade</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="table-wrap">
            <table class="table table-responsive-xl">
              <thead >
                <tr >
                  <th style="color: #012970">Medicamento</th>
                  <th style="color: #012970">Validade</th>
                </tr>
              </thead>
              <tbody>
                @foreach($validade as $val)
                <tr>
                  <td>{{ $val->nome }}</td>
                  <td>{{ \Carbon\Carbon::parse($val->validade)->format('d/m/Y') }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>  
      </div>
    </div>
  </div>

  <!-- FIM MORAL -->

@endsection