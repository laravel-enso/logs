@extends('laravel-enso/core::layouts.app')

@section('pageTitle', __("Logs"))

@section('content')

	<section class="content-header">
		@include('laravel-enso/menumanager::breadcrumbs')
	</section>

	<section class="content" v-cloak>
		<div class="row">
			<div class="col-md-12">
				<div v-for="log in logs" class="col-md-4">
					<div class="box box-solid">
			            <div class="box-header with-border">
			              	<i class="fa fa-terminal"></i>
			              	<h3 class="box-title">@{{ log.name }}</h3>
			              	<div class="pull-right">
								@include('laravel-enso/logmanager::actions')
							</div>
			            </div>
			            <div class="box-body">
			              <dl class="dl-horizontal">
			                <dt>{{ __("Last updated") }}</dt>
			                <dd>@{{ log.lastModified }}</dd>
			                <dt>{{ __("Size") }}</dt>
			                <dd>@{{ log.size }} {{ __("MB") }}</dd>
			              </dl>
			            </div>
			          </div>
				</div>
			</div>
		</div>
	</section>

@endsection

@push('scripts')

	<script>

		let vm = new Vue({
			el: '#app',
			data: {
				showModal: false,
				itemToBeDeleted: null,
				logs: {!! $logs !!}
			},
			methods: {
				empty() {
					axios.delete('/system/logs/' + this.itemToBeDeleted).then(response => {
						this.modal = false;
						let index = this.logs.indexOf(this.itemToBeDeleted);
						this.logs.splice(index, 1, response.data);
						this.itemToBeDeleted = null;
					}).catch(error => {
						this.modal = false;
						this.reportEnsoException(error);
					});
				}
			}
		});

	</script>

@endpush