$(function () {
	const table = $('table').DataTable({
		serverSide: true,
		ajax: ajax_url,
		columns: [
			{ data: 'DT_RowIndex' },
			{ data: 'name' },
			{ data: 'email' },
			{
				data: 'action',
				'orderable': false,
				'searchable': false
			},
		],
	})

	function reload() {
		table.ajax.reload()
	}

	$('tbody').on('click', '.delete', function() {
		if (confirm('Are you sure?')) {
			let data = table.row($(this).parents('tr')).data()
			let route = destroy_url

			route = route.replace(':id', data.id)

			$.ajax({
				url: route,
				type: 'post',
				data: {
			        '_token': $('[name=_token').val(),
			        '_method': 'delete'
			    },
			    success: res => {
					let msg = alert.replace(':msg', res.message)
					reload()
					$('#alert').html(msg)
			    }
			})
		}
	})
})