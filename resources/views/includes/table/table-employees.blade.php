<?php
/**
 * Created by Gabriela Katz


 */
?>
<div class="employees-table">
    <table id="employees-table" class="table table-hover">
        <thead>
        <tr class="table-title">
            <th class="Nome">Nome</th>
            <th>Empresa</th>
            <th class="text-center"></th>
        </tr>
        </thead>
        <tbody>
        @if(count($data))
            @foreach($data as $employeeKey => $employee)
                <tr>
                    <td class="Nomes">
                        <a class="label btn btn-next" data-toggle="modal" data-target="#modal-employee-details"
                           data-employee-id="{!! $employee->id !!}" data-name="{!! $employee->name !!}"
                           data-company-id="{!! $employee->company_id !!}">
                            {!! $employee->name !!}
                        </a>
                    </td>
                    <td class="table-title">{!! $employee->company_name !!}</td>
                    <td class="text-center">
                        &nbsp;
                        <a class="btn label btn-prev btn-delete-employee" data-token="{!! csrf_token() !!}" data-employee-id="{!! $employee->id !!}"
                           data-company-id="{!! $employee->company_id !!}">
                            <i class="fa fa-eraser"></i>
                            Excluir
                        </a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr class="Nomes">
                <td colspan="6" class="text-center">Nenhum colaborador cadastrado</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>