<?php
/**
 * Created by Gabriela Katz


 */
?>
<div class="company-table">
    <table id="company-table" class="table table-hover">
        <thead>
        <tr class="table-title">
            <th class="Nome">Nome</th>
            <th class="text-center"></th>
        </tr>
        </thead>
        <tbody>
        @if(count($data))
            @foreach($data as $companyKey => $company)
                <tr>
                    <td class="Nomes">
                        <a class="label btn btn-next" data-toggle="modal" data-target="#modal-company-details"
                           data-company-id="{!! $company->id !!}" data-name="{!! $company->name !!}" !!}>
                            {!! $company->name !!}
                        </a>
                    </td>
                    <td class="table-title">{!! $company->company_name !!}</td>
                    <td class="text-center">
                        &nbsp;
                        <a class="btn label btn-prev btn-delete-company" data-token="{!! csrf_token() !!}" data-company-id="{!! $company->id !!}">
                            <i class="fa fa-eraser"></i>
                            Excluir
                        </a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr class="Nomes">
                <td colspan="6" class="text-center">Nenhuma empresa cadastrada</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>