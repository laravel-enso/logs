@extends('core::layouts.app')

@section('includesCss')

	<!-- highlight.js monokai -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.10.0/styles/monokai-sublime.min.css"/>

@endsection

@section('pageTitle', __("Logs"))

@section('content')

	<section class="content-header">
		@include('core::partials.breadcrumbs')
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
							<div class="box-title">
									{{ __("Show Logs from") }} {{ $log['lastModified'] }} {{ $log['fileSize'] }}
							</div>
							<div class="box-tools pull-right">
									<button class="btn btn-box-tool btn-sm" data-widget="collapse">
											<i class="fa fa-minus">
											</i>
									</button>
							</div>
					</div>
					<div class="box-body">
						<pre>
							<code>
	{{ $log['content'] }}
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

	var vue = new Vue({
			el: '#app'
	});

</script>

@endpush
