<?php 

function photo($photo)
{
	return asset("storage/images/{$photo}");
}

function active($url, $group = null)
{
	$active = $group ? request()->is($url) || request()->is($url.'/*') : request()->is($url);
	return $active;
}

function normalDate($date)
{
	return date('d M Y', strtotime($date));
}

function site($key)
{
	return Cache::get('site')->$key;
}

function currencyToNumber($cur)
{
	return intval(str_replace(',', '', str_replace('.00', '', $cur)));
}

function numberToCurrency($int)
{
	return number_format(intval($int), 2, '.', ',');
}

function totalPrice($price, $qty)
{
	$price = intval(str_replace(',', '', str_replace('.00', '', $price)));
	$qty = intval($qty);
	return number_format($price * $qty, 2, '.', ',');
}

 ?>