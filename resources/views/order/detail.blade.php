@extends('__layouts.app', ['url' => ['Order', 'detail', $menu->name]])

@section('title', $menu->name)

@section('content')

	<x-product-detail :menu="$menu"></x-product-detail>

@endsection