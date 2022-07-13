@extends('template.portfolios')

@section('title', 'Vender Ativo')

@section('content')
<h1 class="text-2xl font-semibold leading-tigh py-2">Vender {{ $stock->name }}</h1>

@include('includes.validations-form')

@if(session('msg'))
<p class="msg" style="background-color: #FF3232; text-color: white; border: 1px solid #C3E6BCB; width: 100%; margin-botton: 0; text-align: center; padding: 10px;"><strong>{{ session('msg') }}</strong></p>
@endif

<form method="post" action="{{ route('portfolio.sell', $stock->id) }}">
    <div class="w-auto bg-white shadow-md rounded px-8 py-12">
        @method('PUT')
        @csrf
        <input type="number" placeholder="Digite a quantidade..." name="quantity" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
        <input type="number" placeholder="Digite o valor..." name="value" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
        <input type="date" placeholder="Digite a quantidade..." name="created_at" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
        <button type="submit" class="w-full shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
            Vender
        </button>
    </div>
</form>

@endsection 