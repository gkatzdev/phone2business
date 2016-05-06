<?php
/**
 * Created by Gabriela Katz


 */
?>
<div id="modal-company-details" class="modal modal-cabecalho fade" tabindex="990" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-company">
            <div class="modal-header">
                <button type="button" class="close ico_close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Edição de Empresas
            </div>
            <div class="modal-body modal-body-company">
                {!! Form::open(array('name' => 'frm-company', 'id' => 'frm-company', 'url' => route('post.company'), 'method' => 'POST')) !!}
                {!! Form::hidden('company_id', '', ['id' => 'company_id']) !!}
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
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <div class="col-sm-3 pull-right">
                    <div class="Quadrado_azul_copy">
                        <button id="btn-insert-company" class="btn Quadrado_azul Salvar">Salvar</button>
                        <button id="btn-update-company" class="btn Quadrado_azul Salvar">Salvar</button>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-3">
                    <div class="Quadrado_cinza_copy">
                        <button id="button" class="btn Quadrado_cinza Cancelar" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>