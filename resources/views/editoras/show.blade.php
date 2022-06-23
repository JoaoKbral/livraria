@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 style="text-transform: capitalise;">{{ $editora->nome }}</h1>
@stop

@section('content')
    <h1>Detalhes da editora {{ $editora->nome }}</h1>

    <ul>
        <li>Local: {{ $editora->local }}</li>
        <li>Email: {{ $editora->email }}</li>
    </ul>

    <form action="{{ route('editoras.destroy', $editora->id) }}" method="post">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit"> Deletar a editora {{ $editora->nome }}</button>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
