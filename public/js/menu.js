$(function () {
	const table = $('table').DataTable({
		serverSide: true,
		ajax: ajax_url,
		columns: [
			{ data: 'DT_RowIndex' },
			{ data: 'name' },
			{
				data: 'action',
				orderable: false,
				searchable: false
			}
		]
	})

	function reload() {
		table.ajax.reload()
	}

	$('tbody').on('click', '.edit', function () {
		let data = table.row($(this).parents('tr')).data()
		let categories = JSON.parse(data.categories)
		let route = update_url

		route = route.replace(':id', data.id)

		$('.modal').find('form').attr('action', route)
		$('.modal').find('[name=name]').val(data.name)
		$('.modal').find('[name=price]').val(data.price)
		$('.modal').find('[name=description]').val(data.description)
		$('.modal').find('#photo').html(data.photo)

		$.each(categories, function (index, category) {
			$('#categories').append(`<option value=${category.id} selected>${category.name}</option>`)
		})

		$('.modal').modal('show')
	})

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

	$('.modal form').submit(function (e) {
		e.preventDefault()
		
		let formData = new FormData(this)
		let file = $('[name=file]')[0].files[0]

		if (file) {
			formData.append('file', $('[name=file]')[0].files[0])
		}
		formData.append('_method', 'put')
		
		$.ajax({
			url: this.action,
			type: this.method,
			data: formData,
			processData: false,
			contentType: false,
			dataType: 'json',
			headers: {
		        'X-CSRF-TOKEN': $('[name=_token]').val()
		    },
			success: res => {
				let msg = alert.replace(':msg', res.message)
				reload()
				$('#alert').html(msg)
				$('.modal').modal('hide')
				$('#categories').empty()
			},
			error: err => {
				if (err.status == 422) {
					let errors = err.responseJSON.errors

					$.each(errors, function(i, error) {
						let el = $(this).find('[name='+i+']')
						el.addClass('is-invalid')
						el.next('.invalid-feedback').html(error[0])
					})
				}
			}
		})
	})

	$('#categories').select2({
		placeholder: 'Categories',
		ajax: {
			url: get_category_url,
			type: 'post',
			data: params => {
				return {
					'_token': $('[name=_token]').val(),
					'nama_kategori': params.term
				}
			},
			dataType: 'json',
			processResults: res => ({
				results: res
			}),
			cache: true
		}
	})

	bsCustomFileInput.init()
	$('#price').inputmask({
		alias: 'currency',
		prefix: ''
	})
})