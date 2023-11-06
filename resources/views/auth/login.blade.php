<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <!-- Menggunakan Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
    <style>
          body {
            background: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-6" >
                <div class="card bg-pattern shadow-none">
                    <div class="card-body">
                        <div class="p-3">
                            <h4 class="font-18 text-center">Login Page</h4>
                            <p class="text-muted text-center mb-4">Sign in to admin</p>
                            <form class="form-horizontal" action="{{route('goLogin')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Input username">
                                    @error('name') <span class="text-danger"></span>@enderror
                                </div>

                                <div class="form-group mt-2">
                                    <label for="userpassword">Password</label>
                                    <input type="password" name="password" class="form-control" id="userpassword" placeholder="Input password">
                                    @error('password') <span class="text-danger"></span>@enderror
                                </div>

                                <div class="mt-3">
                                    <button class="btn btn-dark col-12" type="submit">Log In</button>
                                </div>
                            </form>
                            <div class="text-center">
                                <p class="mb-0 mt-3"><a class="nav-link" href="{{route('home')}}">Back To Website?</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
