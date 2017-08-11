@if($actionButtons['show'])
	<a class="btn btn-xs btn-success" v-if="log.canBeSeen"
		:href="'{{ url('/system/logs') }}' + '/' + log.name">
		<i class="fa fa-eye"></i>
	</a>
@endif
@if($actionButtons['download'])
	<a class="btn btn-xs btn-info"
		:href="'{{ url('/system/logs/download') }}' + '/' + log.name">
		<i class="fa fa-cloud-download"></i>
	</a>
@endif
@if($actionButtons['delete'])
	<button class="btn btn-xs btn-danger"
		@click="showModal=true;itemToBeDeleted=log.name">
		<i class="fa fa-trash-o"></i>
	</button>
@endif
<modal :show="showModal"
	@cancel-action="showModal=false;itemToBeDeleted=null"
	@commit-action="empty()">
</modal>