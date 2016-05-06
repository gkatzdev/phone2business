<?php
/**
 * Created by Gabriela Katz


 */
?>
<div id="modal-employee-details" class="modal fade" tabindex="990" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body">
                {!! Form::open(array('name' => 'frm-employee', 'id' => 'frm-employee', 'url' => route('post.employee'), 'method' => 'POST')) !!}
                {!! Form::hidden('employee_id', '', ['id' => 'employee_id']) !!}
                <div class="row col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5 for="name" class="control-h5">Nome:</h5>
                                <div>
                                    {!! Form::text('name', '', ['id' => 'name', 'class'=>'form-control', 'maxlength' => '45' ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5 for="bank_id" class="control-h5">Empresa:</h5>
                                <div>
                                    <select name="company_id" id="bank_id" class="form-control autocomplete">
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
                </div>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <div class="col-sm-3 pull-right">
                    <button id="btn-insert-employee" class="btn btn-primary btn-next">Salvar</button>
                    <button id="btn-update-employee" class="btn btn-primary btn-next">Salvar</button>
                </div>
                <div class="col-sm-3">
                    <button id="button" class="btn btn-primary btn-prev" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>