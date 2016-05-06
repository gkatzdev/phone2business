<?php
/**
 * Created by Gabriela Katz

 * Date: 05/05/2016
 */
?>
<script>
    var employeeId = $('#employee_id').val();

    function clearFields(){
        $('#employee_id').val('');
        $('#company_id').val('');
        $('#name').val('');
    }

    function populateEmployeeForm(empId){
        var url = '{{ route("get.employee", ":employee_id") }}';
        url = url.replace(':employee_id', empId);
        $.ajax({
            method: 'GET',
            url: url,
            dataType: "json",
            success: function(data){
                var data = data[0];
                if(typeof data != 'undefined'){
                    $('#company_id').val(data.id);
                    $('#name').val(data.name);
                    return data[0];
                } else {
                    clearFields();
                }

            },
            error: function(){
                $('.alert-danger').text('Ocorreu um erro ao obter as insformações do colaborador');
                $('.alert-danger').removeClass('hidden');
                $('#modal-employee-details').modal('hide');
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

    $("#frm-employee").validate({
        rules: {
            company_id: {
                required: true
            },
            name: {
                required: true
            }
        },
        messages: {
            company_id: {
                required: "Campo obrigatório"
            },
            name: {
                required: "Campo obrigatório"
            }
        },
        ignore: '.ignore'
    });

    $('#modal-employee-details').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var modal = $(this);
        var empId = button.data('employee-id');
        var name = button.data('name');
        var compId = button.data('company-id');

        if(empId == ''){
            $('#company_id').val('');
            $("#btn-update-employee").addClass('hidden');
            $("#btn-insert-employee").removeClass('hidden');
        } else {
            populateEmployeeForm(empId);
            $("#btn-insert-employee").addClass('hidden');
            $("#btn-update-employee").removeClass('hidden');
        }

        modal.find('#name').text(name);
        modal.find('#employee_id').val(empId);
        modal.find('#company_id').val(compId);
    });

    $("#modal-employee-details").on('hide.bs.modal', function(){
        clearFields();
    });

    $("#btn-insert-employee").on('click', function(){
        if($("#frm-employee").valid()){
            $.ajax({
                method: 'POST',
                url: 'employee',
                async: false,
                data: $("#frm-employee").serialize(),
                dataType: 'JSON',
                success: function() {
                    /*$('.alert-success').text('Colaborador incluído com sucesso!');
                    $('.alert-success').removeClass('hidden');
                    $('#modal-employee-details').modal('hide');
                    setTimeout(function(){
                        $('.alert-success').addClass('hidden');
                    }, 2000);*/
                    location.reload(true);
                },
                error: function(){
                    $('.alert-error').text('Ocorreu um erro ao incluir o colaborador');
                    $('.alert-error').removeClass('hidden');
                    $('#modal-employee-details').modal('hide');
                    setTimeout(function(){
                        $('.alert-error').addClass('hidden');
                    }, 2000);
                },
                fail: function() {
                    $('.alert-error').text('Ocorreu um erro ao incluir o colaborador');
                    $('.alert-error').removeClass('hidden');
                    $('#modal-employee-details').modal('hide');
                    setTimeout(function(){
                        $('.alert-error').addClass('hidden');
                    }, 2000);
                }
            });
        }
    });

    $("#btn-update-employee").on('click', function(e){
        if($("#frm-employee").valid()){
            $.ajax({
                method: 'PUT',
                url: 'employee',
                async: false,
                data: $("#frm-employee").serialize(),
                dataType: 'JSON',
                success: function() {
                    $('.alert-success').text('Colaborador atualizado com sucesso!');
                    $('.alert-success').removeClass('hidden');
                    $('#modal-employee-details').modal('hide');
                    setTimeout(function(){
                        $('.alert-success').addClass('hidden');
                        location.reload(true);
                    }, 2000);
                },
                error: function(){
                    $('.alert-error').text('Ocorreu um erro ao atualizar o colaborador');
                    $('.alert-error').removeClass('hidden');
                    $('#modal-employee-details').modal('hide');
                    setTimeout(function(){
                        $('.alert-error').addClass('hidden');
                    }, 2000);
                },
                fail: function() {
                    $('.alert-error').text('Ocorreu um erro ao atualizar o colaborador');
                    $('.alert-error').removeClass('hidden');
                    $('#modal-employee-details').modal('hide');
                    setTimeout(function () {
                        $('.alert-error').addClass('hidden');
                    }, 2000);
                }
            });
            $("#modal-employee-details").modal('hide');
        }
    });

    $('.btn-delete-employee').on('click', function(){
        var empId = $(this).data('employee-id');
        var token = $(this).data('token');
        $.ajax({
            method: 'POST',
            url: 'employee',
            async: false,
            data: {
                _method: 'delete',
                _token: token,
                employee_id: empId
            },
            dataType: 'JSON',
            success: function() {
                $('.alert-success').text('Colaborador excluído com sucesso!');
                $('.alert-success').removeClass('hidden');
                $('#modal-employee-details').modal('hide');
                setTimeout(function(){
                    $('ico_delete').css('margin-top','0px')
                    $('.alert-success').addClass('hidden');
                    location.reload(true);
                }, 2000);
            },
            error: function(){
                $('.alert-error').text('Ocorreu um erro ao excluir o colaborador');
                $('.alert-error').removeClass('hidden');
                $('#modal-employee-details').modal('hide');
                setTimeout(function () {
                    $('.alert-error').addClass('hidden');
                }, 2000);
            },
            fail: function() {
                $('.alert-error').text('Ocorreu um erro ao excluir o colaborador');
                $('.alert-error').removeClass('hidden');
                $('#modal-employee-details').modal('hide');
                setTimeout(function () {
                    $('.alert-error').addClass('hidden');
                }, 2000);
            }
        });
    });
</script>