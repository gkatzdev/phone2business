<?php
/**
 * Created by Gabriela Katz


 */
?>
<table id="accounts-table" class="table table-hover">
    <thead>
    <tr>
        <th>Banco</th>
        <th>Agência</th>
        <th>Número-DV</th>
        <th>Nome</th>
        <th>Tipo de Conta</th>
        <th class="text-center">Ações</th>
    </tr>
    </thead>
    <tbody>
        @if(count($data['userAccounts']))
            @foreach($data['userAccounts'] as $userAccounts => $accountDetails)
                <tr>
                    <td>{!! $accountDetails->bank_name !!}</td>
                    <td>{!! $accountDetails->agency !!}</td>
                    <td>{!! $accountDetails->account_number.'-'.$accountDetails->digit !!}</td>
                    <td>{!! $accountDetails->account_name !!}</td>
                    <td>{!! $accountDetails->type_name !!}</td>
                    <td class="text-center">
                        <a class="label btn btn-next" data-toggle="modal" data-target="#modal-account-details"
                            data-account-id="{!! $accountDetails->account_id !!}" data-account-name="{!! $accountDetails->account_name !!}"
                            data-doc-number="{!! $accountDetails->document_number !!}">
                            <i class="fa fa-search"></i>
                            Editar
                        </a>
                        &nbsp;
                        <a class="btn label btn-prev btn-delete-account" data-token="{!! csrf_token() !!}" data-account-id="{!! $accountDetails->account_id !!}"
                           data-doc-number="{!! $accountDetails->document_number !!}">
                            <i class="fa fa-eraser"></i>
                            Excluir
                        </a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6" class="text-center">Você ainda não possui contas cadastradas</td>
            </tr>
        @endif
    </tbody>
</table>