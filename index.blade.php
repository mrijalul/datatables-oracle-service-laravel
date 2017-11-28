@push('after-script')
	{{ Html::script('build/js/datatables.js') }}
	{{ Html::script('js/sweetalert.js') }}
	<script>
		$('#table-subscriber').DataTable({
			processing: true,
			serverSide: true,
			deferRender: true,
			orderClasses: false,
			ajax: '{!! route('admin.data.datatables') !!}',
			order: [[0, "desc"]],
			columns: [
				{ data: 'rownum', name: 'rownum', 'searchable': false, 'orderable':true },
				{ 
					// change if 2 condition from javascript
					data: 'field1',
					render: function(data) {
						if(data == 1){
							return '<span class="label label-success">ada</span>';
						}else{
							return '<span class="label label-danger">tidak ada</span>';
						}
					}
				},
				{ data: 'field2' },
				{ data: 'field3' },
				{ data: 'field4' },
				{ data: 'created_at' },
				{ data: 'action', 'searchable': false, 'orderable':false }
			]
		});
		// message alert confirmation
		@include('backend.include.sweetalert')
	</script>
@endpush