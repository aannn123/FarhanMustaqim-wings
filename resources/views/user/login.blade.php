<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>

<body>
    <div class="container">
        @if (Session::has('error'))
            <p class="alert mt-5 {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error') }}</p>
        @endif
        <div class=" d-flex justify-content-center align-items-center mt-5">
            <div class="card w-50 h-50">
                <div class="card-body">
                    <h4 class="card-title text-center mb-3">Login</h5>
                        <form action="{{ route('post.login') }}" method="POST">
                            @csrf
                            <div class="form-group mb-4">
                                <input type="text" name="user" class="form-control" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-info mt-4 text-white rounded-pill">Submit</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
