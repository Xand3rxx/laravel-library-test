<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <div
            class="sticky top-0 z-40 w-full backdrop-blur flex-none transition-colors duration-500 lg:z-50 lg:border-b lg:border-slate-900 border-slate-50 bg-slate-900">
            <div class="max-w-8xl mx-auto">
                <div class="py-4 border-b lg:px-8 lg:border-0 border-slate-300 mx-4 lg:mx-0">
                    <div class="relative flex items-center">
                        <a class="mr-3 flex-none w-[2.0625rem] overflow-hidden md:w-auto text-white" href="/">
                            {{ config('app.name', 'Laravel') }}
                        </a>

                        <div class="relative hidden lg:flex items-center ml-auto">
                            <nav class="text-sm leading-6 font-semibold text-slate-200">
                                <ul class="flex space-x-8">
                                    @guest
                                        <li>
                                            <a class="hover:text-sky-400" href="{{ route('authors.index') }}">Authors</a>
                                        </li>
                                        @if (Route::has('login'))
                                            <li>
                                                <a class="hover:text-sky-400"
                                                    href="{{ route('login') }}">{{ __('Login') }}</a>
                                            </li>
                                        @endif

                                        @if (Route::has('register'))
                                            <li>
                                                <a class="hover:text-sky-400"
                                                    href="{{ route('register') }}">{{ __('Register') }}</a>
                                            </li>
                                        @endif
                                    @else
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdown" class="hover:text-sky-400 dropdown-toggle" href="#"
                                                role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false" v-pre>
                                                {{ Auth::user()->name }}
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                                                     document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>
                                    @endguest
                                </ul>
                            </nav>
                            <div class="flex items-center border-l border-slate-800 ml-6 pl-6">
                                <label class="sr-only" id="headlessui-listbox-label-3">Theme</label>
                                <a href="https://github.com/Xand3rxx"
                                    class="ml-6 block text-slate-400 hover:text-slate-300"><span
                                        class="sr-only">Tailwind CSS on GitHub</span><svg viewBox="0 0 16 16"
                                        class="w-5 h-5" fill="currentColor" aria-hidden="true">
                                        <path
                                            d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z">
                                        </path>
                                    </svg></a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <main class="max-w-8xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="text-center mt-5">
                <h4 class="font-medium leading-tight text-2xl mt-0 mb-2 text-slate-600">{{ config('app.name', 'Laravel') }}</h4>
                <h2 class="font-medium leading-tight mt-0 mb-2 text-slate-600">This application is simply to test if some basic functions of a book library can be executed without hassle</h2>
            </div>
            @yield('content')
        </main>
    </div>
</body>

</html>
