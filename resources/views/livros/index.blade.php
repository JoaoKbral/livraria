<p><a href="{{route('livros.create')}}">Inserir novo livro</a></p>
<hr>

@if (session('message'))
    <div>
        {{session('message')}}
    </div>
@endif

Lista de livros
@foreach (@$livros as $livro)
    <p>{{$livro->titulo}}
    <a href="{{ route ('livros.show', $livro->id)}}">[Ver detalhes]</a>
    <a href="{{ route ('livros.edit', $livro->id)}}">[Editar livro]</a>
    </p>
@endforeach
