<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    @yield('css')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light d-flex justify-content-between" style="background-color: #7952b3">
        <a class="navbar-brand text-white" href="#">Navbar</a>
    
        <div class="float-right" id="">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('siswa.pemilihanJurusan') }}">Pemilihan_Jurusan</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link text-white" href="{{ route('siswa.profile') }}">Profile</a>
                </li>
                <li class="nav-item active">
                    <form action="{{ route('logout') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <a class="nav-link text-white" href="javascript:void(0);" onclick="$(this).closest('form').submit()">Sign Out</a>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
    <section>
        @yield('content')
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    @yield('script')
</body>
</html>