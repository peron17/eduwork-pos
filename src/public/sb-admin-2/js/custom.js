/**
 * setup ajax header
 */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

/**
 * button trigger modal
 */
$('body').on('click', '.btn-modal', function(e) {
    e.preventDefault();

    var url = $(this).attr('href');
    var title = $(this).attr('title');
    
    var modal = $('#modal');
    modal.modal('show');

    var form = $('#modal form');
    form.attr('action', url);

    var method = 'post';
    $('#btn-modal-submit').html('Create');
    $('#modal-label').text(title);

    if ($(this).hasClass('btn-edit')) {
        method = 'put';
        $('#btn-modal-submit').html('Save');
        
        var data = $(this).data('model');
        $.each(data, function(key, value){
            if ($('#'+key).is('input:text')) {
                $('#'+key).val(value);
            }
        });
    }

    form.attr('method', method);
});

/**
 * submit modal form
 */
//  $(document).on('submit', '#modal form', function(e) {
 $('#modal form').submit(function(e) {
    e.preventDefault();

    var form = $(this);
    console.log(form.serialize());
    var url = form.attr('action');
    var method = form.attr('method');

    $.ajax({
        url: url,
        type: method,
        data: form.serialize(),
        success: function(data) {
            if (data.status) {
                $('#modal').modal('hide');
                resetModal();
                reloadDataTable();

                if (method == 'post') {
                    Swal.fire(
                        'Sukses',
                        'Data berhasil dibuat',
                        'success'
                    )
                } else {
                    Swal.fire(
                        'Sukses',
                        'Data berhasil diperbarui',
                        'success'
                    )
                }
            } else {
                console.log(data.error);
                Swal.fire(
                    'Gagal',
                    data.error,
                    'error'
                )
            }
        },
        error: function(e) {
            var errors = e.responseJSON.errors;
            $('body .error-message').remove();
            $.each(errors, function(key, value){
                console.log(key);
                if ($('#error-message-' + key).length === 0) {
                    form.find('#'+ key ).after('<span class="error-message" id="error-message-'+ key +'">'+ value + '</span>');
                    // form.find('input[name="'+ key +'"]').after('<span class="error-message" id="error-message-'+ key +'">'+ value + '</span>');
                    // checkbox
                    // form.find('#checkbox-area').append('<span class="error-message" id="error-message-'+ key +'">'+ value + '</span>');
                }
            });
        },
    });

    return false;
 });


// button delete
$('body').on('click', '.btn-delete', function(e){
    e.preventDefault();

    var url = $(this).attr('href');

    Swal.fire({
        icon: 'warning',
        title: 'Apakah anda yakin menghapus data ini?',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak',
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                method: 'delete',
                success: function(data){
                    if (data.status) {
                        reloadDataTable();

                        Swal.fire(
                            'Sukses',
                            'Data berhasil dihapus',
                            'success'
                        )
                    } else {
                        Swal.fire(
                            'Gagal',
                            data.error,
                            'error'
                        )
                    }
                },
                error: function(err){
                    Swal.fire(
                        'Error',
                        'Internal Server Error',
                        'error'
                    )
                },
            });
        } 
    })

});
    
function reloadDataTable()
{
    $('#datatable').DataTable().ajax.reload();
}

$("#modal").on('hide.bs.modal', function(){
    resetModal();
});

function resetModal()
{
    $('#modal').find('form')[0].reset();
    $('body .error-message').remove();
}
