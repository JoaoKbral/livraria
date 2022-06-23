@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <h2>Editar o autor {{ $autor->nome }}</h2>
    @if ($errors->all())
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    @endif

    <div>
        <form action="{{ route('autores.update', $autor->id) }}">
            @method('put')
            @csrf
            <p>Nome: <input type="text" name="nome" id="nome" placeholder="Digite o nome" value="{{$autor->nome}}"></p>
            <p>Ano de nascimento: <input type="text" name="ano_nasc" id="ano_nasc" placeholder="Digite o ano de nascismento" value="{{$autor->ano_nasc}}"></p>
            <p>País: <input type="text" name="pais" id="pais" placeholder="Digite o pais" value="{{$autor->pais}}"></p>
            <p>Area: <input type="text" name="area" id="area" placeholder="Digite a area" value="{{$autor->area}}"></p>
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
