<div>
    <form action="{{route ('editoras.store')}}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <p>Título: <input type="text" name="nome" id="nome" placeholder="Digite o nome" value="{{old('nome')}}"></p>
        <p>Ano: <input type="text" name="ano" id="ano" placeholder="Digite ano" value="{{old('ano')}}"></p>
        <p>Idioma: <input type="text" name="idioma" id="idioma" placeholder="Digite o ano" value="{{old('idioma')}}"></p>
        <p>ISBN: <input type="text" name="isbn" id="isbn" placeholder="Digite o ISBN" value="{{old('isbn')}}"></p>
        <p>Capa: <input type="file" name="capa" id="capa"></p>
        <p><button type="submit">Enviar</button></p>
    </form>
</div>
