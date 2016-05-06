<?php
/**
 * Created by Gabriela Katz


 */
?>
<div id="modal-employee-details" class="modal modal-cabecalho fade" tabindex="990" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close ico_close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Edição de Colaboradores
            </div>
            <div class="modal-body">
                {!! Form::open(array('name' => 'frm-employee', 'id' => 'frm-employee', 'url' => route('post.employee'), 'method' => 'POST')) !!}
                {!! Form::hidden('employee_id', '', ['id' => 'employee_id']) !!}
                <div class="row col-md-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group col-sm-3 modal-name modal-label">
                                <span for="name" class="table-title">Nome:</span>
                            </div>
                            <div class="form-group col-sm-6">
                                {!! Form::text('name', '', ['id' => 'name', 'class'=>'form-control', 'maxlength' => '45' ]) !!}
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group col-sm-3 modal-label">
                                <span for="bank_id" class="table-title">Empresa:</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <select name="company_id" id="company_id" class="form-control autocomplete">
                                    <option value=""> Selecionar</option>
                                    @foreach($companies as $companyKey => $company)
                                        <option value='{!! $company->id !!}'>
                                            {!! $company->name!!}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <div class="col-sm-3 pull-right">
                    <div class="Quadrado_azul_copy">
                        <button id="btn-insert-employee" class="btn Quadrado_azul Salvar">Salvar</button>
                        <button id="btn-update-employee" class="btn Quadrado_azul Salvar">Salvar</button>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="Quadrado_cinza_copy">
                        <button id="button" class="btn Quadrado_cinza Cancelar" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>