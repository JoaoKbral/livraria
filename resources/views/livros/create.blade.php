@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div>
        <form action="{{ route('livros.store') }}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <p>Título: <input type="text" name="titulo" id="titulo" placeholder="Digite o titulo"
                    value="{{ old('titulo') }}"></p>
            <p>Ano: <input type="text" name="ano" id="ano" placeholder="Digite ano"
                    value="{{ old('ano') }}"></p>
            <p>Idioma: <input type="text" name="idioma" id="idioma" placeholder="Digite o ano"
                    value="{{ old('idioma') }}"></p>
            <p>ISBN: <input type="text" name="isbn" id="isbn" placeholder="Digite o ISBN"
                    value="{{ old('isbn') }}"></p>
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
