@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p><a href="{{ route('livros.create') }}">Inserir novo livro</a></p>
    <hr>

    <div>
        <form action="{{ route('livros.search') }}" method="post"></form>
        @csrf
        <p>Buscar:</p>
        <input type="text" name="search" id="search" placeholder="Digite sua busca">
        <button type="submit">Buscar</button>
    </div>

    @if (session('message'))
        <div>
            {{ session('message') }}
        </div>
    @endif

    Lista de livros
    @foreach (@$livros as $livro)
        <p>{{ $livro->titulo }}
            <img src="{{ url("storage/{$livro->capa}") }}" alt="{{ $livro->titulo }}" style="max-width:100px;">
            {{$livro->titulo}}
            <a href="{{ route('livros.show', $livro->id) }}">[Ver detalhes]</a>
            <a href="{{ route('livros.edit', $livro->id) }}">[Editar livro]</a>
        </p>
    @endforeach

    @if (isset($filters))
        {{ $livro->appends($filters)->links() }}
    @else
        {{ $livros->links() }}
    @endif

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
