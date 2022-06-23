@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 style="text-transform: capitalise;">{{ $autor->nome }}</h1>
@stop

@section('content')
    <h1>Detalhes do autor {{ $autor->nome }}</h1>

    <ul>
        <li>Ano de nascimento: {{ $autor->ano_nasc }}</li>
        <li>País: {{ $autor->pais }}</li>
        <li>Area: {{ $autor->area }}</li>
    </ul>

    <form action="{{ route('autores.destroy', $autor->id) }}" method="post">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit"> Deletar o autor {{ $autor->nome }}</button>
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
