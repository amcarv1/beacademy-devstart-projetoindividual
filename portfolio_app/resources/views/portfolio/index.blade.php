@extends('template.portfolios')

@section('title', 'Meus Ativos')

@section('content')

<div style="background-image: url('/images/painel.svg'); background-size: 1333px 639px; width: 1333px; height: 639px; margin: 0; padding: 0; background-repeat: no-repeat;" class="mt-3">
    <div class="container" style="margin-top">

        {{-- 
        <div class="d-flex justify-content-end">
        <form action="{{ route('stocks.index') }}" method="get" class="py-8">
            <input type="text" name="search" placeholder="Pesquisar" class="md:w-1/6 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus focus:border-purple-300">
            <button class="shadow bg-purple-300 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">Pesquisar</button>
        </form>
        </div>--}}
        <div class="text-center mt-5" style="margin-top: 100px">
            <h1 class="text-2xl font-semibold leading-tigh py-2" style="font-size: 50px"></h1>
        </div>



    <div class="d-flex justify-content-between" style="margin-left: 100px; margin-top: 100px">
        <a href="{{ route('portfolio.choice') }}" class="btn btn-primary mb-3">Adicionar Novo Ativo</a>
        <form action="{{ route('stocks.updateAllQuote') }}" method="post">
            @csrf
            @method('POST')
            <button class="btn" style="background: green; color: white;" type="submit">Atualizar Valores</button>
        </form>
    </div>

    
    <div class="d-flex justify-content-center">
        @if(session('msg'))
        <p class="msg" style="background-color: #D4EDDA; color: #13724 border: 1px solid #C3E6BCB; width: 500px; margin-botton: 0; text-align: center; padding: 10px;"><strong>Sucesso:</strong> {{ session('msg') }}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        @endif
    </div>

    @yield('conteudo')
        <div class="text-center justify-content-center" style="margin-left: 200px;">
            <table class="table table-dark">
                <thead>
                    <tr class="table-dark">
                    <th class="px-3 py-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-white-700 uppercase tracking-wider text-center table-dark">NOME</th>
                    <th class="px-3 py-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-white-700 uppercase tracking-wider text-center table-dark">TICKET</th>
                    <th class="px-3 py-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-white-700 uppercase tracking-wider text-center table-dark">QUANTIDADE</th>
                    <th class="px-3 py-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-white-700 uppercase tracking-wider text-center table-dark">TOTAL INVESTIDO</th>
                    <th class="px-3 py-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-white-700 uppercase tracking-wider text-center table-dark">COTAÇÃO ATUAL</th>
                    <th class="px-3 py-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-white-700 uppercase tracking-wider text-center table-dark" scope="col-3">AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stocks as $stock)
                    <tr>
                        <td class="px-3 py-4 border-b border-gray-200 text-sm text-center table-dark">{{ $stock['name'] }}</td>
                        <td class="px-3 py-4 border-b border-gray-200 text-sm text-center table-dark">{{ $stock['ticket'] }}</td>
                        <td class="px-3 py-4 border-b border-gray-200 text-sm text-center table-dark">{{ $stock['COUNT(stocks.id)'] }}</td>
                        <td class="px-3 py-4 border-b border-gray-200 text-sm text-center table-dark">R$ {{ $stock['(COUNT(stocks.id) * stocks.price)'] }}</td>
                        <td class="px-3 py-4 border-b border-gray-200 text-sm text-center table-dark">R$ {{ $stock['price'] }}</td>

                        <td class="px-3 py-4 border-b border-gray-200 text-sm">
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('portfolio.purchase', $stock['id']) }}" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                                    <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
                                </svg></a>
                                <a class="btn btn-warning" style="margin-left: 8px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-minus-fill" viewBox="0 0 16 16">
                                        <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM6 7.5h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1 0-1z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('portfolio.destroy', $stock['id']) }}" method="post" style="margin-left: 8px;">
                                    @method('DELETE')
                                    @csrf
                                    <button  type="submit" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                    </svg></button>
                                </form>
                            </div>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection