@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div>
        <form action="{{ route('livros.store') }}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <p>Nome: <input type="text" name="nome" id="nome" placeholder="Digite o nome"
                    value="{{ old('nome') }}"></p>
            <p>Ano de nascimento: <input type="text" name="ano_nasc" id="ano_nasc" placeholder="Digite de nascimento"
                    value="{{ old('ano_nasc') }}"></p>
            <p>País: <input type="pais" name="pais" id="pais" placeholder="Digite o ano_nasc"
                    value="{{ old('pais') }}"></p>
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
