<p><a href="{{ route('editoras.create') }}">Inserir novo editora</a></p>
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


Lista de editoras
@foreach (@$editoras as $editora)
    <p>{{ $editora->nome }}
        <a href="{{ route('editoras.show', $editora->id) }}">[Ver detalhes]</a>
        <a href="{{ route('editoras.edit', $editora->id) }}">[Editar editora]</a>
    </p>
@endforeach

@if (isset($filters))
    {{ $editora->appends($filters)->links() }}
@else
    {{ $editoras->links() }}
@endif


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


    Lista de editoras
    @foreach (@$editoras as $editora)
        <p>
            <img src="{{ url("storage/{$editora->capa}") }}" alt="{{ $editora->nome }}" style="max-width:100px;">
            {{ $editora->nome }}
            <a href="{{ route('editoras.show', $editora->id) }}">[Ver detalhes]</a>
            <a href="{{ route('editoras.edit', $editora->id) }}">[Editar editora]</a>
        </p>
    @endforeach

    @if (isset($filters))
        {{ $editora->appends($filters)->links() }}
    @else
        {{ $editoras->links() }}
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
