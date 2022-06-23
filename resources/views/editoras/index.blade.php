<p><a href="{{ route('editoras.create') }}">Inserir novo livro</a></p>
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
@foreach (@$editoras as $livro)
    <p>{{ $livro->titulo }}
        <a href="{{ route('editoras.show', $livro->id) }}">[Ver detalhes]</a>
        <a href="{{ route('editoras.edit', $livro->id) }}">[Editar livro]</a>
    </p>
@endforeach

@if (isset($filters))
    {{ $livro->appends($filters)->links() }}
@else
    {{ $editoras->links() }}
@endif
