<?php
/**
 * Created by Gabriela Katz
 * Date: 05/05/2016
 */
?>
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
			@include('includes.user.table.table-accounts', $data)
		</div>
	</div>
</article>
@include('includes.user.modal.modal-employee-details')
@push('scripts')
	@include('includes.user.scripts.employee-scripts')
@endpush