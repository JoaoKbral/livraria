<h2>Editar o livro {{ $livro->titulo }}</h2>
@if ($errors->all())
    @foreach ($errors->all() as $error)
        <p>{{$error}}</p>
    @endforeach
@endif

<div>
    <form action="{{ route('livros.update', $livro->id) }}">
        @method('put')
        @csrf
        <p>Título: <input type="text" name="titulo" id="titulo" placeholder="Digite o titulo"
                value="{{ $livro->titulo }}"></p>
        <p>Ano: <input type="text" name="ano" id="ano" placeholder="Digite ano" value="{{ $livro->ano }}">
        </p>
        <p>Idioma: <input type="text" name="idioma" id="idioma" placeholder="Digite o ano"
                value="{{ $livro->idioma }}"></p>
        <p>ISBN: <input type="text" name="isbn" id="isbn" placeholder="Digite o ISBN"
                value="{{ $livro->isbn }}"></p>
        <p><button type="submit">Enviar</button></p>
    </form>
</div>
