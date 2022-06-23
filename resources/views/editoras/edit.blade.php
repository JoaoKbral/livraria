@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <h2>Editar a editora {{ $editora->nome }}</h2>
    @if ($errors->all())
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    @endif

    <div>
        <form action="{{ route('editoras.update', $editora->id) }}">
            @method('put')
            @csrf
            <p>Nome: <input type="text" name="nome" id="nome" placeholder="Digite o nome" value="{{$editora->nome}}"></p>
            <p>Local: <input type="text" name="local" id="local" placeholder="Digite o local" value="{{$editora->local}}"></p>
            <p>Email: <input type="email" name="email" id="email" placeholder="Digite o email" value="{{$editora->email}}"></p>
            <p>Capa: <input type="file" name="capa" id="capa"></p>
            <p><button type="submit">Enviar</button></p>
        </form>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
