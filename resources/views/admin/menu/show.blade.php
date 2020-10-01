@extends('__layouts.admin', ['url' => ['admin', 'menu', $menu->name]])

@section('title', $menu->name)

@section('content')

	<x-product-detail :menu="$menu"></x-product-detail>

@endsection