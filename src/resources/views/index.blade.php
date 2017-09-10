@extends('laravel-enso/core::layouts.app')

@section('pageTitle', __("Logs"))

@section('content')

	<page v-cloak>
		<div class="col-md-12">
			<div v-for="log in logs" class="col-md-6 col-lg-6">
				<box :theme="log.size ? 'danger' : 'success'"
                    icon="fa fa-terminal"
                    :title="log.name"
                    border open>
                    <span slot="btn-box-tool">
                        @include('laravel-enso/logmanager::actions')
                    </span>
	              	<dl class="dl-horizontal">
	                	<dt>{{ __("Last updated") }}</dt>
	                	<dd>@{{ log.lastModified }}</dd>
	                	<dt>{{ __("Size") }}</dt>
	                	<dd>@{{ log.size }} {{ __("MB") }}</dd>
	              	</dl>
             	</box>
		    </div>
		</div>
	</page>

@endsection

@push('scripts')

	<script>

		const vm = new Vue({
			el: '#app',
			data: {
				showModal: false,
				itemToBeDeleted: null,
				logs: {!! $logs !!}
			},
			methods: {
				empty() {
					axios.delete('/system/logs/' + this.itemToBeDeleted).then(response => {
						this.showModal = false;

						let index = this.logs.findIndex(log => {
							return this.itemToBeDeleted == log.name;
						});

						console.log(index);

						this.logs.splice(index, 1, response.data);
						this.itemToBeDeleted = null;
					}).catch(error => {
						this.showModal = false;
						this.reportEnsoException(error);
					});
				}
			}
		});

	</script>

@endpush