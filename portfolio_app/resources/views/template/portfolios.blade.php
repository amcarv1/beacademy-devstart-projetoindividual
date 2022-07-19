<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    
</head>
<body class="bg-gray-50" style="background: #EFEFEF; margin: 0px;">
    <div class="text-center bg-blue-500">
        <nav>
            <div class="container flex flex-wrap justify-between items-center mx-auto">
                <div class="flex items-center md:order-2">
                    <button type="button" class="text-white" aria-expanded="false" type="button" data-dropdown-toggle="dropdown">
                        <span>Olá, {{ Auth::user()->name }}!</span>
                    </button>
                    <!-- Dropdown menu -->
                    <div class="hidden z-50 my-4 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown">
                        <div class="py-3 px-4">
                            @if(Auth::user())
                                <span class="block text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
                                <span class="block text-sm font-medium text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
                            @endif
                        </div>
                        <ul class="py-4" aria-labelledby="dropdown">
                            @if(Auth::user()->is_admin == 1)
                                <li>
                                <div class="py-3 px-4">
                                    <a href="/admin">
                                        <span class="block text-sm font-medium text-gray-900 truncate dark:text-gray-400">
                                            Painel Admin
                                        </span>
                                    </a>
                                </div>
                                </li>
                            @endif
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-responsive-nav-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Sair') }}
                                    </x-responsive-nav-link>
                                </form>                
                            </li>
                        </ul>
                    </div>
                    <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                    <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
                <div class="hidden justify-between items-center w-full md:flex md:w-auto md:order-1" id="mobile-menu-2" style="padding: 0; margin: 0;">
                    <ul class="flex flex-col md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium" style="padding: 24px">
                    <li>
                        <a href="{{ route('home') }}" class="block py-2 pr-4 pl-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white" aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('portfolio.index') }}" class="block py-2 pr-4 pl-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white" aria-current="page">Minha Carteira</a>
                    </li>
                    <li>
                        <a href="{{ route('transactions.index') }}" class="block py-2 pr-4 pl-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white" aria-current="page">Transações</a>
                    </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    @yield('content')

</body>
<script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
</html>