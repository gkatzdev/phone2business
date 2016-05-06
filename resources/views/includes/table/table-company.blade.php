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
        </tr>
        </thead>
        <tbody>
        @if(count($data))
            @foreach($data as $companyKey => $company)
                <tr>
                    <td>
                        <a class="Nomes" class="label btn btn-next" data-toggle="modal" data-target="#modal-company-details"
                           data-company-id="{!! $company->id !!}" data-name="{!! $company->name !!}" !!}>
                            {!! $company->name !!}
                        </a>
                        <a class="btn label btn-prev btn-delete-company pull-right" data-token="{!! csrf_token() !!}" data-company-id="{!! $company->id !!}">
                            <img class="ico_delete ico_delete_empresa" src="/img/ico-del.png" alt="">
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