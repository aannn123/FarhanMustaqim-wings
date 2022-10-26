<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light px-4 py-4">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex justify-content-between align-items-center"
                id="navbarTogglerDemo01">
                {{-- <div class=""> --}}
                <div class="d-flex flex-row">
                    <a class="navbar-brand" href="#">Penjualan</a>
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="#"><b>{{ ucwords(Auth::user()->role) }}</b></a>
                        </li>
                        @if (Auth::user()->role == 'user')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}"><b>Product</b></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('cart') }}"><b>Cart</b> <b style="color:red" class="cart ml-1"></b> </a>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="d-flex flex-row ">
                    <b class="nav-link disabled">{{ Auth::user()->name }}</b>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Logout</button>
                    </form>
                </div>
                {{-- </div> --}}
            </div>
        </nav>

        <div class="p-5">
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        let getProduct = JSON.parse(localStorage.getItem("products"))
        $('.cart').html(getProduct.length)
    </script>
    @stack('js')
</body>

</html>
