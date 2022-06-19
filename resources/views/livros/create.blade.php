<div>
    <form action="{{route ('livros.store')}}" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <p>Título: <input type="text" name="titulo" id="titulo" placeholder="Digite o titulo" value="{{old('titulo')}}"></p>
        <p>Ano: <input type="text" name="ano" id="ano" placeholder="Digite ano" value="{{old('ano')}}"></p>
        <p>Idioma: <input type="text" name="idioma" id="idioma" placeholder="Digite o ano" value="{{old('idioma')}}"></p>
        <p>ISBN: <input type="text" name="isbn" id="isbn" placeholder="Digite o ISBN" value="{{old('isbn')}}"></p>
        <p><button type="submit">Enviar</button></p>
    </form>
</div>
