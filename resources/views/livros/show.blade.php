@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 style="text-transform: capitalise;">{{ $editora->nome }}</h1>
@stop

@section('content')
    <h1>Detalhes do livro {{ $editora->nome }}</h1>

    <ul>
        <li>ISBN: {{ $editora->isbn }}</li>
        <li>Ano: {{ $editora->ano }}</li>
        <li>Idioma: {{ $editora->idioma }}</li>
    </ul>

    <form action="{{ route('livros.destroy', $editora->id) }}" method="post">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit"> Deletar o livro {{ $editora->nome }}</button>
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
