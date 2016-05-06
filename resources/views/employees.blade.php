<?php
/**
 * Created by Gabriela Katz
 * Date: 05/05/2016
 */
?>
@extends('layouts.employee.default')

@section('content')
	<div class="top-header-bg"></div>
	<section>
		<div class="second-page-header">
			<div class="container">
				<h2>Colaboradores</h2>
			</div>
		</div>
	</section>
	<section class="section-services">
		<div class="block2">
			<div class="container">
				<div class="row">
					<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="box-border block-form wow fadeInLeft" data-wow-duration="1s">
							<div class="row">
								<span class="alert alert-danger hidden"></span>
								<span class="alert alert-success hidden"></span>
								<div class="col-md-12">
									<div class="col-md-6">
										<h3>
											<a class="btn btn-next pull-right" class="label btn btn-next" data-toggle="modal" data-target="#modal-employee-details"
											   data-account-id="0" data-employee-name="Novo Colaborador"
											   data-doc-number="">Colaboradores</a>
										</h3>
									</div>
								</div>
							</div>
							<div class="row">
								<hr>
							</div>
							<div class="table-responsive">
								@include('includes.employee.table.table-employees', $data)
							</div>
						</div>
					</article>
					@include('includes.employee.modal.modal-employee-details')
					@push('scripts')
					@include('includes.employee.scripts.employee-scripts')
					@endpush
				</div>
			</div>
		</div>
	</section>
	{{--@include('includes.user.modal.modal-contract')--}}
@stop