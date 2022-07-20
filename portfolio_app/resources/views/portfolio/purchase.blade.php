@extends('template.portfolios')

@section('title', 'Adicionar Ativo')

@section('content')

<div style="background-image: url('/images/purchase.jpg'); background-size: 1533px 800px; width: 1533px; height: 639px; margin: 0; padding: 0; background-repeat: no-repeat;">
    <div class="container w-50 text-center">
        <div>
        <h1 class="text-2xl font-semibold leading-tigh py-2"></h1>
        @include('includes.validations-form')

        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        <h1 class="text-2xl font-semibold leading-tigh py-2 mt-5">Adicionar {{ $stock->name }}</h1>
        <form method="post" action="{{ route('portfolio.buy', $stock->id) }}">
            <div class="w-auto bg-dark shadow-md rounded px-8 py-12">
                @method('PUT')
                @csrf
                <input type="number" placeholder="Digite a quantidade..." name="quantity" class="shadow appearance-none border rounded w-50 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
                <input type="number" placeholder="Digite o valor..." name="value" class="shadow appearance-none border rounded w-50 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
                <input type="date" placeholder="Digite a quantidade..." name="created_at" class="shadow appearance-none border rounded w-50 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
                <button type="submit" class="w-50 shadow bg-blue-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
                    Comprar
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection 
