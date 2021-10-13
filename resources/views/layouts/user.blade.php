<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/bootstrap.min.css') }}" crossorigin="anonymous">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('assets/admin/images/logo.png') }}" type="image/x-icon">
    <!-- TinyMCE 5 -->
    <script src="{{ asset('assets/admin/js/plugins/tinymce/tinymce.min.js') }}"></script>

    <title>{{ $title ?? config('app.name') }} - Repository</title>

    <style>
        .float-whatsapp {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 100;
        }

        .my-float-whatsapp {
            margin-top: 16px;
        }
    </style>
</head>

<body>
    {{-- [Start-Navbar] --}}
    @include('layouts.components-user.navbar')
    {{-- [End-Navbar] --}}
    <div class="container-fluid">
        {{-- [Start-Jumbotron] --}}
        @include('layouts.components-user.jumbotron')
        {{-- [End-Jumbotron] --}}
        <div class="card text-center">
            {{-- [Start-Menu] --}}
            @include('layouts.components-user.menu')
            {{-- [End-Menu] --}}
            <div class="row">
                {{-- [Start-SideMenu] --}}
                @include('layouts.components-user.sidemenu')
                {{-- [End-SideMenu] --}}
                <div class="col-md-9">
                    <div class="card-body">
                        @yield('content')
                        <hr>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent">Copyright &copy; 2021</div>
        </div>
    </div>
    <a href="https://api.whatsapp.com/send?phone=+6281398911599&text=Hallo! Saya ingin bertanya perihal Repository Fakultas Teknik."
        class="float-whatsapp" target="_blank">
        <i class="fab fa-whatsapp my-float-whatsapp"></i>
    </a>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="{{ asset('assets/user/js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
    <!-- Custom Js -->
    @yield('js')
</body>

</html>