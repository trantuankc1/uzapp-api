@extends('admin::dashboard.base')

@section('title', 'Tomosia')

@section('content')
    <h1>Hello World</h1>
    <a href="{{ route('admin::logout') }}">logout</a>
    <p>
        This view is loaded from module: {!! config('admin.name') !!}
    </p>
@endsection
