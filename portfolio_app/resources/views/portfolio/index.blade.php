@extends('template.portfolios')

@section('title', 'Meus Ativos')

@section('content')

<h1 class="text-2xl font-semibold leading-tigh py-2">Meus Ativos</h1>

<a href="{{ route('portfolio.choice') }}" class="bg-black rounded-full text-white px-5 py-3 text-sm">Adicionar Novo Ativo</a>


<form action="{{ route('stocks.index') }}" method="get" class="py-8">
    <input type="text" name="search" placeholder="Pesquisar" class="md:w-1/6 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
    <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">Pesquisar</button>
</form>

<form action="{{ route('stocks.updateAllQuote') }}" method="post">
    @csrf
    @method('POST')
    <button class="bg-green-200 rounded-full py-2 px-6" type="submit">Atualizar Valores</button>
</form>

@if(session('msg'))
<p class="msg" style="background-color: #D4EDDA; color: #155724 border: 1px solid #C3E6BCB; width: 100%; margin-botton: 0; text-align: center; padding: 10px;"><strong>Sucesso:</strong> {{ session('msg') }}</p>
@endif

@yield('conteudo')
<table class="datatables">
    <thead>
        <tr>
        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider text-center">NOME</th>
          <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider text-center">TICKET</th>
          <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider text-center">QUANTIDADE</th>
          <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider text-center">TOTAL INVESTIDO</th>
          <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider text-center">COTAÇÃO ATUAL</th>
          <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider text-center">COMPRAR ATIVO</th>
          <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider text-center">VENDER ATIVO</th>
          <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider text-center">EXCLUIR ATIVO</th>


        </tr>
      </thead>
      <tbody>
        @foreach ($stocks as $stock)
        <tr>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">{{ $stock['name'] }}</td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">{{ $stock['ticket'] }}</td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">{{ $stock['COUNT(stocks.id)'] }}</td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">R$ {{ $stock['(COUNT(stocks.id) * stocks.price)'] }}</td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">R$ {{ $stock['price'] }}</td>

            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <a href="{{ route('portfolio.purchase', $stock['id']) }}" class="bg-green-200 rounded-full py-2 px-4">Comprar</a>
            </td>

            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <a href="{{ route('portfolio.sale', $stock['id']) }}" class="bg-orange-200 rounded-full py-2 px-4">Vender</a>
            </td>

            <td class="text-center">
                <form action="{{ route('portfolio.destroy', $stock['id']) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button  type="submit" class="bg-red-400 rounded-full py-1 px-4 sm">Deletar</button>
                    </form>
            </td>

        </tr>
        @endforeach
    </tbody>
    
</table>

@endsection