<?php
/**
 * Created by Gabriela Katz

 * Date: 09/03/2016
 */
?>
<script>
    var companyId = $('#company_id').val();

    function clearFields(){
        $('#company_id').val('0');
        $('#name').val('');
    }

    function populateCompanyForm(compId){
        var url = '{{ route("get.company", ":company_id") }}';
        url = url.replace(':company_id', compId);
        $.ajax({
            method: 'GET',
            url: url,
            dataType: "json",
            success: function(data){
                var data = data[0];
                if(typeof data != 'undefined'){
                    $('#name').val(data.name);
                    return data[0];
                } else {
                    clearFields();
                }

            },
            error: function(){
                $('.alert-danger').text('Ocorreu um erro ao obter as insformações da empresa');
                $('.alert-danger').removeClass('hidden');
                $('#modal-company-details').modal('hide');
                setTimeout(function(){
                    $('.alert-danger').addClass('hidden');
                }, 2000);
            },
            fail: function(){
                clearFields();
            }
        });
    }

    $(window).load(function(){
        clearFields();
    });

    $("#frm-company").validate({
        rules: {
            name: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Campo obrigatório"
            }
        },
        ignore: '.ignore'
    });

    $('#modal-company-details').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var modal = $(this);
        var compId = button.data('company-id');
        var name = button.data('name');

        if(compId == 0){
            $('#company_id').val('');
            $("#btn-update-company").addClass('hidden');
            $("#btn-insert-company").removeClass('hidden');
        } else {
            populateCompanyForm(compId);
            $("#btn-insert-company").addClass('hidden');
            $("#btn-update-company").removeClass('hidden');
        }

        modal.find('#name').text(name);
        modal.find('#company_id').val(compId);
    });

    $("#modal-company-details").on('hide.bs.modal', function(){
        clearFields();
    });

    $("#btn-insert-company").on('click', function(){
        if($("#frm-company").valid()){
            $.ajax({
                method: 'POST',
                url: 'company',
                async: false,
                data: $("#frm-company").serialize(),
                dataType: 'JSON',
                success: function() {
                    $('.alert-success').text('Empresa incluída com sucesso!');
                    $('.alert-success').removeClass('hidden');
                    $('#modal-company-details').modal('hide');
                    setTimeout(function(){
                        $('.alert-success').addClass('hidden');
                    }, 2000);

                    location.reload(true);
                },
                error: function(){
                    $('.alert-error').text('Ocorreu um erro ao incluir a empresa');
                    $('.alert-error').removeClass('hidden');
                    $('#modal-company-details').modal('hide');
                    setTimeout(function(){
                        $('.alert-error').addClass('hidden');
                    }, 2000);
                },
                fail: function() {
                    $('.alert-error').text('Ocorreu um erro ao incluir a empresa');
                    $('.alert-error').removeClass('hidden');
                    $('#modal-company-details').modal('hide');
                    setTimeout(function(){
                        $('.alert-error').addClass('hidden');
                    }, 2000);
                }
            });
        }
    });

    $("#btn-update-company").on('click', function(e){
        if($("#frm-company").valid()){
            $.ajax({
                method: 'PUT',
                url: 'company',
                async: false,
                data: $("#frm-company").serialize(),
                dataType: 'JSON',
                success: function() {
                    $('.alert-success').text('Empresa atualizada com sucesso!');
                    $('.alert-success').removeClass('hidden');
                    $('#modal-company-details').modal('hide');
                    setTimeout(function(){
                        $('.alert-success').addClass('hidden');
                    }, 2000);

                    location.reload(true);
                },
                error: function(){
                    $('.alert-error').text('Ocorreu um erro ao atualizar a empresa');
                    $('.alert-error').removeClass('hidden');
                    $('#modal-company-details').modal('hide');
                    setTimeout(function(){
                        $('.alert-error').addClass('hidden');
                    }, 2000);
                },
                fail: function() {
                    $('.alert-error').text('Ocorreu um erro ao atualizar a empresa');
                    $('.alert-error').removeClass('hidden');
                    $('#modal-company-details').modal('hide');
                    setTimeout(function () {
                        $('.alert-error').addClass('hidden');
                    }, 2000);
                }
            });
            $("#modal-company-details").modal('hide');
        }
    });

    $('.btn-delete-company').on('click', function(){
        var compId = $(this).data('company-id');
        var token = $(this).data('token');
        $.ajax({
            method: 'POST',
            url: 'company',
            async: false,
            data: {
                _method: 'delete',
                _token: token,
                company_id: compId
            },
            dataType: 'JSON',
            success: function() {
                $('.alert-success').text('Empresa excluída com sucesso!');
                $('.alert-success').removeClass('hidden');
                $('#modal-company-details').modal('hide');
                setTimeout(function(){
                    $('.alert-success').addClass('hidden');
                }, 2000);

                location.reload(true);
            },
            error: function(){
                $('.alert-error').text('Ocorreu um erro ao excluir a empresa');
                $('.alert-error').removeClass('hidden');
                $('#modal-company-details').modal('hide');
                setTimeout(function () {
                    $('.alert-error').addClass('hidden');
                }, 2000);
            },
            fail: function() {
                $('.alert-error').text('Ocorreu um erro ao excluir a empresa');
                $('.alert-error').removeClass('hidden');
                $('#modal-company-details').modal('hide');
                setTimeout(function () {
                    $('.alert-error').addClass('hidden');
                }, 2000);
            }
        });
    });
</script>