<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="images/favicon.ico" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        laravel: "#ef3b2d",
                    },
                },
            },
        };
    </script>
    <title>LaraGigs | Find Laravel Jobs & Projects</title>
</head>
<body class="mb-48">
    <div id="app">

        <nav class="flex justify-between items-center mb-4">
            <a href="index.html"
            ><img class="w-24" src="images/logo.png" alt="" class="logo"
                /></a>
            <ul class="flex space-x-6 mr-6 text-lg">
                <!-- Authentication Links -->
                @guest
                @if (Route::has('login'))
                    <li>
                        <a href="{{ route('login') }}" class="hover:text-laravel"
                        ><i class="fa-solid fa-arrow-right-to-bracket"></i>
                            {{ __('Login') }}</a
                        >
                    </li>
                @endif

                @if (Route::has('register'))

                    <li>
                        <a href="{{ route('register') }}" class="hover:text-laravel"
                        ><i class="fa-solid fa-user-plus"></i> {{ __('Register') }}</a
                        >
                    </li>
                @endif
                @else
                    <li>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">


                            <a href="#" class="hover:text-laravel"
                            ><i class="fa-solid fa-user-plus"></i> {{ Auth::user()->name }} - {{ Auth::user()->email }}</a
                            >

                            <a href="{{ url('/') }}" class="hover:text-laravel"
                            > <i class="fa-solid fa-home"></i>  Home </a
                            >

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                        </div>
                    </li>
                @endguest
            </ul>
        </nav>


        <main>
            <div class="mx-8">
                @yield('content')
            </div>
        </main>
    </div>
    <footer
        class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-laravel text-white h-24 mt-24 opacity-90 md:justify-center"
    >
        <p class="ml-2">Copyright &copy; 2022, All Rights reserved</p>

        <a
            href="{{ url('create') }}"
            class="absolute top-1/3 right-10 bg-black text-white py-2 px-5"
        >Post Note</a
        >
    </footer>
    @if(session()->exists('message'))
        <div class="fixed top-0 left-1/2 transform translate-x-1/2  bg-laravel text-white px-48 y-3">
            {{ session('message') }}
        </div>
    @endif
</body>
</html>
