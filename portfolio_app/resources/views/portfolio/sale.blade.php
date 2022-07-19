@extends('template.portfolios')

@section('title', 'Vender Ativo')

@section('content')

<div style="background-image: url('/images/sales.png'); background-size: 1533px 639px; width: 1533px; height: 639px; margin: 0; padding: 0; background-repeat: no-repeat;">
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

        @if(session('msg'))
        <p class="msg" style="background-color: #FF3232; text-color: white; border: 1px solid #C3E6BCB; width: 100%; margin-botton: 0; text-align: center; padding: 10px;"><strong>ERRO:</strong>{{ session('msg') }}</p>
        @endif

        <form method="post" action="{{ route('portfolio.sell', $stock->id) }}">
            <div class="w-auto bg-dark shadow-md rounded px-8 py-12 mt-5">
                <h1 class="text-2xl font-semibold leading-tigh py-2 text-white">Vender {{ $stock->name }}</h1>
                @method('PUT')
                @csrf
                <input type="number" placeholder="Digite a quantidade..." name="quantity" class="shadow appearance-none border rounded w-50 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
                <input type="number" placeholder="Digite o valor..." name="value" class="shadow appearance-none border rounded w-50 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
                <input type="date" placeholder="Digite a quantidade..." name="created_at" class="shadow appearance-none border rounded w-50 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
                <button type="submit" class="w-50 shadow bg-blue-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
                    Vender
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection 