<h1>Listagem de Stocks</h1>
<a href="{{ route('stocks.create') }}" class="btn btn-success">Novo Stock</a>
<table class="table">
    <thead class="text-center">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">NOME</th>
        <th scope="col">TICKET</th>
        <th scope="col">COTAÇÃO</th>
        <th scope="col">AÇÕES</th>
        <th scope="col">ATUALIZAR</th>

      </tr>
    </thead>
    <tbody class="text-center">
        @foreach($stocks as $stock)
        <tr>
            <th scope="row">{{ $stock->id }}</th>
            <td>{{ $stock->name }}</td>
            <td>{{ $stock->ticket }}</td>
            <td>{{ $stock->price }}</td>
            <td>{{ $stock->price }}</td>
            <td>
                <a href="{{ route('stocks.edit', $stock->id)}}">Editar</a>
                <form action="{{ route('stocks.destroy', $stock->id)}}"  method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit">Apagar</button>
                </form>
            </td>
            <td>
              <form action="{{ route('stocks.updateQuote', $stock->id)}}" method="post">
                @csrf
                @method('POST')
                <button class="btn btn-primary" type="submit">Update Quote</button>
              </form>
          </td>
        </tr>
        @endforeach
    </tbody>
  </table>