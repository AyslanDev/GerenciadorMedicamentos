$(document).ready(function () {
    $("#validade").mask('00/00/0000');
    $(".validade").mask('00/00/0000');
});

$("#largeModal").on('show.bs.modal', function(event){

    var button = $(event.relatedTarget)
    var id = button.data('id');
    var nome = button.data('nome');
    var validade = button.data('validade');
    var modal = $(this)

    modal.find('.modal-body #id_val').val(id);
    modal.find('.modal-body #medicamento_val').val(nome);
    modal.find('.modal-body #validade_val').val(validade);

});


