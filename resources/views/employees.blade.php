<?php
/**
 * Created by Gabriela Katz
 * Date: 05/05/2016
 */
?>
@extends('layouts.employee.default')

@include('includes.employee.modal.modal-employee-details')
@section('content')
	<div class="cabecalho_tabela">
		<span class="header-colaboradores">
			Colaboradores

			<a href="" data-toggle="modal" data-target="#modal-employee-details"><img class="ico_mais" src="/img/ico-add.png" alt=""></a>
		</span>
		<span class="Filtrar pull-right">
			<input type="text" placeholder="Filtrar" class="input_Filtrar" />
		</span>
		<hr class="linha_Azul">
	</div>

	<div class="col-sm-12 col-xs-12 table-responsive">
		@include('includes.employee.table.table-employees', $data)
	</div>
	@push('scripts')
	@include('includes.employee.scripts.employee-scripts')
	@endpush
	{{--@include('includes.user.modal.modal-contract')--}}
@stop