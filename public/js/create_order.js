$(function () {

	function toInt(str) {
		return parseInt(str.substr(0, str.length-3).replace(/,/g, ''))
	}

	function toMoney(int) {
		return new Intl.NumberFormat().format(int)+'.00';
	}

	function createLi(id, title, price) {
		let li = document.createElement('li')
		let div = document.createElement('div')
		let button = document.createElement('button')

		$(li).attr('data-key', id)
		$(li).addClass('menu list-group-item d-flex justify-content-between align-items-center py-2 px-3')

		$(div).addClass('mt-1')
		$(div).append(`<h6 class="my-0">${title} <span class="badge badge-primary rounded-circle ml-1 qty">1</span></h6><small class="text-muted price">${price}</small>`)

		$(button).addClass('close')
		$(button).append('<small>&times;</small>')

		$(button).click(function () {
			let listGroup = $('.list-group-item')
			let checkout = $('.checkout')

			$(this).parents('li').remove()

			if (listGroup.length <= 1) {
				$('#cart').append('<li class="list-group-item empty">Empty</li>')
				checkout.attr('disabled', 'disabled')
			}

		})

		$(li).append(div)
		$(li).append(button)

		return li;

	}

	function addCart(menu) {
		let listGroup = $('.list-group-item')
		let empty = $('.empty')
		let checkout = $('.checkout')
		let cart = $('#cart')
		let table = $('[name=table_id]').val()

		let id = menu.attr('id')
		let title = menu.find('.title').html()
		let price = menu.find('.price').html()
		let total = $('[data-key='+id+']')

		if (listGroup.length <= 1) {
			empty.remove()
		}

		if (table) {
			checkout.removeAttr('disabled')
		}

		if (total.length > 0) {
			let qty = total.find('.qty')
			let priceTotal = total.find('.price')

			let newQty = parseInt(qty.html()) + 1
			let newPrice = toMoney(newQty * toInt(price))

			qty.html(newQty)
			priceTotal.html(newPrice)
		} else {
			cart.append(createLi(id, title, price))
		}
	}

	function createMenu(id, photo, title, price) {

		// Product Img Head

		let productPhoto = $('<img/>', {
			src: `${asset}/${photo}`,
			'class': 'img-fluid',
			css: {
				height: '150px',
				width: '100%',
				objectFit: 'cover'
			}
		})

		let productImg = $('<div/>',{
			'class': 'product-img p-0',
			append: productPhoto
		})

		let productImgHead = $('<div/>', {
			'class': 'product-img-head',
			append: productImg
		})

		// Product Content Head

		let productTitle = $('<h3/>', {
			'class': 'product-title title',
			text: title
		})

		let priceSpan = $('<span/>', {
			class: 'price',
			text: price
		})

		let productPrice = $('<div/>',{
			'class': 'product-price mt-3',
			text: 'Rp ',
			append: priceSpan
		})

		let productContentHead = $('<div/>', {
			'class': 'product-content-head',
			append: [productTitle, productPrice]
		})

		// Product Btn

		let btn = $('<button/>', {
			'class': 'btn btn-sm btn-primary mr-1',
			text: 'Add To Cart',
			on: {
				click: function () {
					addCart(menu)
				}
			}
		})

		let a = $('<a/>',{
			href: orderDetailUrl.replace(':id', id),
			'class': 'btn btn-sm btn-outline-light',
			text: 'Details'
		})

		let productBtn = $('<div/>',{
			'class': 'product-btn',
			append: [btn, a]
		})

		// Content

		let productContent = $('<div/>', {
			'class': 'product-content',
			append: [productContentHead, productBtn]
		})

		// Thumbnail

		let productThumbnail = $('<div/>', {
			'class': 'product-thumbnail',
			append: [productImgHead, productContent]
		})

		// Menu

		let menu = $('<div/>', {
			id: id,
			'class': 'col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12 menu',
			append: productThumbnail
		})

		return menu;
	}

	function createPagination(links) {
		let ul = $('<ul/>',{
			'class': 'pagination'
		})

		$.each(links, function (index, el) {
			let span = $('<span/>',{
				'class': 'page-link',
				text: el.label
			})

			let a = $('<a/>',{
				'class': 'page-link',
				href: el.url,
				text: el.label,
				on: {
					click: function (e) {
						e.preventDefault()
						nextPage(this)
					}
				}
			})

			let li = $('<li/>', {
				'class': `page-item ${el.active ? 'active' : ''}`,
				append: el.active || !el.url ? span : a
			})

			ul.append(li)
		})

		return ul;
	}

	function nextPage(el) {
		let url = el.href
		
		$.get(url, function (res) {

			refresh(res, `Page ${res.current_page}`)
		})
	}

	function refresh(res, title) {
		let product = $('#product')
		let pagination = $('#pagination')
		let pageHeader = $('.page-header h2')

		pageHeader.html(title)

		product.empty()
		pagination.empty()


		$.each(res.data, function (index, el) {
			let menu = createMenu(el.id, el.photo, el.name, el.price)

			product.append(menu)
		})

		pagination.append(createPagination(res.links))

		$(window).scrollTop(0)
	}

	$('.checkout').attr('disabled', 'disabled')
	
	$('.add-cart').click(function () {
		addCart($(this).parents('.menu'))
	})

	$('#checkout').submit(function () {
		let cart = $('#cart')
		let menus = cart.find('.menu')

		$.each(menus, function (i, item) {
			let qty = $(item).find('.qty').html()
			let menu = $(item).attr('data-key')

			$(this).append(`<input type='hidden' name='menu[]' value='${menu}''>`)
			$(this).append(`<input type='hidden' name='qty[]' value='${qty}''>`)
		})

		return true

	})

	$('.pagination a').click(function (e) {
		e.preventDefault()

		nextPage(this)
	})

	$('#search').submit(function (e) {
		e.preventDefault()

		$.post(searchUrl, $(this).serialize())
		.done(function (res) {
			refresh(res.menus, `Search ${res.name}`)
		})
	})

	$('#category').submit(function (e) {
		e.preventDefault()

		$.post(categoryUrl, $(this).serialize())
		.done(function (res) {
			refresh(res, 'Sorted')
		})
	})
})