@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p><a href="{{ route('editoras.create') }}">Inserir nova editora</a></p>
    <hr>

    <div>
        <form action="{{ route('editoras.search') }}" method="post"></form>
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

    <br>
    Lista de editoras
    @foreach ($editora as $editor)
        <p>
            <img src="{{ url("storage/{ $editor->capa}") }}" alt="{{ $editor->nome }}" style="max-width:100px;">
            {{ $editor->nome }}
            <a href="{{ route('editoras.show', $editor->id) }}">[Ver detalhes]</a>
            <a href="{{ route('editoras.edit', $editor->id) }}">[Editar editora]</a>
        </p>
    @endforeach

    @if (isset($filters))
        {{ $editora->appends($filters)->links() }}
    @else
        {{ $editora->links() }}
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
