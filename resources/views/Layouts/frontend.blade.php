<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" type="image" href="{{asset('/img/Gereja WKO.jpg')}}">
<title> {{$title}} </title>
<head>
    <!-- Head -->
    @include('Includes.head')
    <script src="{{ asset('/js/jquery-3.6.1.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('/css/frontend.css')}}">
    <style>
        #navbar {
            overflow: hidden;
            background-color: #333;
        }
        #navbar a {
            float: left;
            display: block;
            color: #f2f2f2;
            padding: 14px;
            text-decoration: none;
        }
        .content {
            padding: 16px;
        }
        .sticky {
            position: fixed;
            top: 0;
            width: 100%;
        }
        .navColor{
            background-color: white !important;
            height:100px;
        }
        .sticky + .content {
            padding-top: 60px;
        }
        .fontHome , .fontIbadah, .fontBerita, .fontTentangKami, .fontEvent, .fontKesaksian , .fontRenungan{
            color:black !important;
        }

    </style>
    <script src="https://cdn.tiny.cloud/1/drzndcs7x99r8cewem7nspuqoj8oakvdc6b38dmtrikywtub/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <!-- Styles and Scripts -->
    @stack('head-script')
</head>

<body>
    <div class="container-fluid">
        <header>
            @include('Includes.headerFrontend')
        </header>

        <main class="row main-wrapper">
            @yield('content')
        </main>

        <footer>
            @include('Includes.footerFrontend')
        </footer>
        <script src="<?= asset('/js/jquery-3.5.1.js') ?>"></script>
        <script src="<?= asset('/js/bootstrap.js') ?>"></script>
        <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
            window.onscroll = function() {myFunction()};
            var navbar = document.getElementById("navbar");
            var fontHome = document.getElementById('fontHome');
            var fontIbadah = document.getElementById('fontIbadah');
            var fontBerita = document.getElementById('fontBerita');
            var fontTentangKami = document.getElementById('fontTentangKami');
            var fontEvent = document.getElementById('fontEvent');
            var fontKesaksian = document.getElementById('fontKesaksian');
            var fontRenungan = document.getElementById('fontRenungan');
            var sticky = navbar.offsetTop;
            function myFunction() {
                if (window.pageYOffset >= sticky) {
                    navbar.classList.add("sticky")
                    if(window.pageYOffset >= 660){
                        fontHome.classList.add("fontHome");
                        fontIbadah.classList.add("fontIbadah");
                        fontBerita.classList.add("fontBerita");
                        fontTentangKami.classList.add("fontTentangKami");
                        fontEvent.classList.add("fontEvent");
                        fontKesaksian.classList.add("fontKesaksian");
                        fontRenungan.classList.add("fontRenungan");
                        navbar.classList.add("navColor");
                    }else{
                        fontHome.classList.remove("fontHome");
                        fontIbadah.classList.remove("fontIbadah");
                        fontBerita.classList.remove("fontBerita");
                        fontTentangKami.classList.remove("fontTentangKami");
                        fontEvent.classList.remove("fontEvent");
                        fontKesaksian.classList.remove("fontKesaksian");
                        fontRenungan.classList.remove("fontRenungan");
                        navbar.classList.remove("navColor");
                    }
                } else {
                    navbar.classList.remove("sticky");
                }
            }
            
        </script>
        @stack('js')
</body>
</html>