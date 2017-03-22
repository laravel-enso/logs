@extends('core::layouts.app')

@section('pageTitle', __("Logs"))

@section('content')

	<section class="content-header">
		@include('core::partials.breadcrumbs')
	</section>

	<section class="content" v-cloak>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
							<div class="box-title">
									{{ __("Logs") }}
							</div>
							<div class="box-tools pull-right">
									<button class="btn btn-box-tool btn-sm" data-widget="collapse">
											<i class="fa fa-minus">
											</i>
									</button>
							</div>
					</div>
					<div class="box-body">
						<table id="logs" class="table display">
							<thead>
								<tr>
									<th>#</th>
									<th>{{ __("Name") }}</th>
									<th>{{ __("Date") }}</th>
									<th>{{ __('Last Modified') }}</th>
									<th class="text-right">{{ __('File Size') }}</th>
									<th>{{ __("Actions") }}</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($logs as $k => $log)
								<tr>
									<td>{{ $k+1 }}</td>
									<td>{{ $log['filename'] }}</td>
									<td>{{ $log['lastModifiedDate'] }}</td>
									<td>{{ $log['lastModifiedTime'] }}</td>
									<td class="text-right">{{ $log['fileSize'] }}</td>
									<td>
											<a class="btn btn-xs btn-success"
												href="{{ url('/system/logs/' . $log['filename']) }}">
												<i class="fa fa-eye"></i>
											</a>
											<a class="btn btn-xs btn-info"
												href="{{ url('/system/logs/download/' . $log['filename']) }}">
												<i class="fa fa-cloud-download"></i>
											</a>
											@if($hasActionButtons['delete'])
											<button class="btn btn-xs btn-danger"
												@click="confirmDelete({{ $k }}, '{{ $log['filename'] }}')">
												<i class="fa fa-trash-o"></i>
											</button>
											@endif
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<modal :show="showModal" @cancel-action="showModal = false" @commit-action="deleteDocument">
			@include('core::partials.modal')
		</modal>
	</section>

@endsection

@push('scripts')

	<script>

		var vue = new Vue({
			el: '#app',
			data: {
					showModal: false,
					itemToBeDeleted: null,
					dtHandle: null,
					row: null
			},
			methods: {
					confirmDelete: function(index, filename) {
							this.itemToBeDeleted = filename;
							this.row = index;
							this.showModal = true;
					},
					deleteDocument: function() {
							axios.delete('/system/logs/' + this.itemToBeDeleted).then((response) => {
									this.itemToBeDeleted = null;
									this.showModal = false;
									this.dtHandle.cell(this.row, 2).data(response.data.last_modified_date);
									this.dtHandle.cell(this.row, 3).data(response.data.lastModifiedTime);
									this.dtHandle.cell(this.row, 4).data(response.data.fileSize);
									this.dtHandle.row(this.row).draw();
									this.row = null;
									toastr['success'](response.data.message);
							});
					},
			},
			mounted: function() {
					var options = { serverSide: false };
					this.dtHandle = $('#logs').DataTable(options);
			}
		});

	</script>

@endpush