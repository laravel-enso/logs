@extends('laravel-enso/core::layouts.app')

@section('css')

	<!-- highlight.js monokai -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.10.0/styles/monokai-sublime.min.css"/>

@endsection

@section('pageTitle', __("Logs"))

@section('content')

	<section class="content-header">
		@include('laravel-enso/menumanager::breadcrumbs')
	</section>

	<section class="content" v-cloak>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
							<div class="box-title">
									{{ __("The log file") }} <code>@{{ log.name }}</code> {{ __("was last updated on") }} @{{ log.lastModified }}. {{ __("Current file size is") }} @{{ log.size }} {{ __("MB") }}
							</div>
							<div class="pull-right">
								@include('laravel-enso/logmanager::actions')
							</div>
					</div>
					<div class="box-body">
						<pre>
							<code id="log-body">
{{ $content }}
							</code>
						</pre>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection

@push('scripts')

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.10.0/highlight.min.js"></script>
	<script>hljs.initHighlightingOnLoad();</script>

	<script>

		let vm = new Vue({
			el: '#app',

			data: {
				showModal: false,
				itemToBeDeleted: null,
				log: {!! $log !!}
			},

			methods: {
				empty() {
					axios.delete('/system/logs/' + this.itemToBeDeleted).then(response => {
						this.showModal = false;
						this.log = response.data;
						this.emptyHtml();
						this.itemToBeDeleted = null;
					}).catch(error => {
						this.showModal = false;
						this.reportEnsoException(error);
					});
				},
				emptyHtml() {
					document.getElementById('log-body').innerHTML = "";
				}
			}
		});

	</script>

@endpush
