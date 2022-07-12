@extends('template.portfolios')

@section('title', 'Adicionar Ativos')

@section('content')

<table class="min-w-full leading-normal shadow-md rounded-lg overflow-hidden">
    <thead>
        <tr>
        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider text-center">NOME</th>
          <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider text-center">TICKET</th>
          <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider text-center">COTAÇÃO ATUAL</th>
          <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider text-center">AÇÃO</th>

        </tr>
      </thead>
      <tbody>
        @foreach ($stocks as $stock)
        <tr>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">{{ $stock['name'] }}</td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">{{ $stock['ticket'] }}</td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">{{ $stock['price'] }}</td>

            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                <a href="{{ route('portfolio.purchase', $stock['id']) }}" class="bg-green-200 rounded-full py-2 px-6">Adicionar a Carteira</a>
            </td>

        </tr>
    @endforeach
    </tbody>
</table>
@endsection