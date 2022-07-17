@extends('template.portfolios')

@section('title', 'Vendas')

@section('content')
<table class="min-w-full leading-normal shadow-md rounded-lg overflow-hidden">
    <thead>
        <tr>
        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider text-center">Nº</th>
          <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider text-center">ATIVO</th>
          <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider text-center">TICKET</th>
          <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider text-center">TIPO</th>
          <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider text-center">QUANTIDADE</th>
          <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider text-center">VALOR</th>
          <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider text-center">DATA COMPRA</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($sales as $sal)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">{{ $sal->id}}</td>
                    @foreach ($stocks as $stock)
                        @if ($sal->stock_id === $stock->id)
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">{{ $stock->name }}</td> 
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">{{ $stock->ticket }}</td>
                        @endif
                    @endforeach        
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">Venda</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">{{ $sal->quantity }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">R$ {{ $sal->value }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">{{ date('d/m/Y', strtotime($sal->created_at)) }}</td>
                </tr>
        @endforeach
    </tbody>
</table>
<div class="pagination">
    {{ $sales->links() }}
</div>
@endsection
