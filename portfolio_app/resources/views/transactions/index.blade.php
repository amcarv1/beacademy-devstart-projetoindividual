@extends('template.portfolios')

@section('title', 'Transações')

@section('content')
<div class="hidden justify-between items-center w-full md:flex md:w-auto md:order-1" id="mobile-menu-2">
    <ul class="flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium">
    <li>
        <a href="{{ route('transactions.purchases') }}" class="block py-2 pr-4 pl-3 text-dark bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white" aria-current="page">Ver Compras</a>
    </li>
    <li>
        <a href="{{ route('transactions.sales') }}" class="block py-2 pr-4 pl-3 text-dark bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white" aria-current="page">Ver Vendas</a>
    </li>
    </ul>
</div>
@endsection