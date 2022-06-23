@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <h1>Detalhes do livro {{ $livro->titulo }}</h1>

    <ul>
        <li>ISBN: {{ $livro->isbn }}</li>
        <li>Ano: {{ $livro->ano }}</li>
        <li>Idioma: {{ $livro->idioma }}</li>
    </ul>

    <form action="{{ route('livros.destroy', $livro->id) }}" method="post">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit"> Deletar o livro {{ $livro->titulo }}</button>
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
