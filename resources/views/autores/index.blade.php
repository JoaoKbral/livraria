@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p><a href="{{ route('autores.create') }}">Inserir novo autor</a></p>
    <hr>

    <div>
        <form action="{{ route('autores.search') }}" method="post"></form>
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


    Lista de autores
    @foreach (@$autores as $autor)
        <p>
            <img src="{{ url("storage/{$autor->capa}") }}" alt="{{ $autor->nome }}" style="max-width:100px;">
            {{ $autor->titulo }}
            <a href="{{ route('autores.show', $autor->id) }}">[Ver detalhes]</a>
            <a href="{{ route('autores.edit', $autor->id) }}">[Editar autor]</a>
        </p>
    @endforeach

    @if (isset($filters))
        {{ $autor->appends($filters)->links() }}
    @else
        {{ $autores->links() }}
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
