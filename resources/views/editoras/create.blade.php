@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div>
        <form action="{{ route('editoras.store') }}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <p>Nome: <input type="text" name="nome" id="nome" placeholder="Digite o nome"
                    value="{{ old('nome') }}"></p>
            <p>Local: <input type="text" name="local" id="local" placeholder="Digite o local"
                    value="{{ old('local') }}"></p>
            <p>Email: <input type="email" name="email" id="email" placeholder="Digite o email"
                    value="{{ old('email') }}"></p>
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
