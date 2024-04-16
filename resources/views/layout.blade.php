<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="images/favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="images/favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <style>
        body {
            width: 99%;
        }
    </style>
    <title>FreeLancing</title>
</head>

<body class="mb-48">
    <nav class="flex justify-between items-center mb-4">
        <a href="/"><img class="w-24" src="images/logo.png" alt="" class="logo" /></a>

        <ul class="flex space-x-6 mr-6 text-lg">
            <ul>
                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li>
                        <a rel="alternate" hreflang="{{ $localeCode }}"
                            href="{{ LaravelLocalization::getLocalizedURL($localeCode) }}">
                            {{ $properties['native'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
            @guest

                <li>
                    <a href="{{ route('register') }}" class="hover:text-laravel"><i class="fa-solid fa-user-plus"></i>
                        @lang('main.register')</a>
                </li>
                <li>
                    <a href="{{ route('login') }}" class="hover:text-laravel"><i
                            class="fa-solid fa-arrow-right-to-bracket"></i>
                        @lang('main.login')</a>
                </li>
            @endguest
            @auth

                <li>
                    <a class="hover:text-laravel" href="{{ route('user_profile.index', Auth::user()->id) }}"><i
                            class="fa-solid fa-user-plus"></i>
                        user name : {{ Auth::user()->name }}</a>
                </li>
                <li>
                    <a class="hover:text-laravel"><i class="fa-solid fa-user-plus"></i>
                        Email : {{ Auth::user()->email }}</a>
                </li>
                <li>
                    <a class="hover:text-laravel" href="{{ route('message.index') }}"><i class="fa-solid fa-user-plus"></i>
                        All message </a>
                </li>
                <li>
                    <a class="hover:text-laravel" href="{{ route('mange.index') }}"><i class="fa-solid fa-user-plus"></i>
                        all jops from {{ Auth::user()->name }} </a>
                </li>
                <li>
                    <a class="hover:text-laravel" href="{{ route('listing.trash') }}"><i class="fa-solid fa-user-plus"></i>
                        Trash </a>
                </li>
                <li>
                    @if (Auth::user()->type == 'admin')
                        <a class="hover:text-laravel" href="{{ route('admin.allusers') }}"><i
                                class="fa-solid fa-user-plus"></i>
                            All users </a>
                    @endif

                </li>
                <li>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="hover:text-laravel"><i class="fa-solid fa-arrow-right-to-bracket"></i>
                            Logout</button>
                    </form>
                </li>

            @endauth

        </ul>

    </nav>
    @auth
        @component('components.notify')
        @endcomponent
    @endauth

    <!-- Hero -->
    <section class="relative h-72 bg-laravel flex flex-col justify-center align-center text-center space-y-4 mb-4">
        <div class="absolute top-0 left-0 w-full h-full opacity-10 bg-no-repeat bg-center"
            style="background-image: url('images/laravel-logo.png')"></div>

        <div class="z-10">
            <h1 class="text-6xl font-bold uppercase text-white">
                Lara<span class="text-black">Gigs</span>
            </h1>
            <p class="text-2xl text-gray-200 font-bold my-4">
                @lang('main.Find or post Laravel jobs & projects')
            </p>
            <div>
                @guest

                    <a href="{{ route('register') }}"
                        class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:text-black hover:border-black">
                        @lang('main.Sign Up to List a Gig')</a>
                @endguest

                <a href="{{ route('listings.index') }}"
                    class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:text-black hover:border-black">
                    @lang('main.Back to home')</a>

            </div>
        </div>
    </section>

    <main>
        <!-- Search -->
        <form action="{{ route('listings.index') }}" method="get">
            <div class="relative border-2 border-gray-100 m-4 rounded-lg">
                <div class="absolute top-4 left-3">
                    <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i>
                </div>
                <input type="text" name="search"
                    class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none"
                    placeholder="Search Laravel Gigs..." />
                <div class="absolute top-2 right-2">
                    <button type="submit" class="h-10 w-20 text-white rounded-lg bg-red-500 hover:bg-red-600">
                        Search
                    </button>
                </div>
            </div>
        </form>

        <!-- Item 1 -->
        @yield('content')

    </main>

    <footer
        class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-laravel text-white h-24 mt-24 opacity-90 md:justify-center">

        <p class="ml-2">Copyright &copy; 2022, All Rights reserved</p>

        <a href="{{ route('listings.create') }}" class="absolute top-1/3 right-10 bg-black text-white py-2 px-5">
            @lang('main.Post Job')</a>

    </footer>
</body>

</html>
