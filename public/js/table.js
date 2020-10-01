$(function () {
	const table = $('table').DataTable({
		serverSide: true,
		ajax: ajax_url,
		columns: [
			{ data: 'DT_RowIndex' },
			{ data: 'no' },
			{
				data: 'status',
				render: function (data) {
					return `<span class="badge badge-${data ? 'success' : 'primary'}">${data ? 'full' : 'empty'}</span>`
				}
			},
			{
				data: 'action',
				'orderable': false,
				'searchable': false
			},
		],
		order: [[1, 'asc']]
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

	$('#create').submit(function(e) {
		e.preventDefault()
		$.ajax({
			url: this.action,
			method: this.method,
			data: $(this).serialize(),
			dataType: 'json',
			success: res => {
				let msg = alert.replace(':msg', res.message)
				let el = $('[name=no]')
				
				reload()
				$('#alert').html(msg)
				this.reset()
				el.removeClass('is-invalid')
				el.next('.invalid-feedback').html('')
			},
			error: err => {
				if (err.status == 422) {
					let errors = err.responseJSON.errors
					let el = $('[name=no]')

					el.addClass('is-invalid')
					el.next('.invalid-feedback').html(errors['no'][0])
				}
			}
		})
	})
})