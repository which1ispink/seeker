@extends('layout.master')
@section('title', 'Hello...')

@section('content')
    <div class="hello">
        <h1>Hello, {{ $name }}!</h1>
    </div>
@endsection