<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" type="image" href="{{asset('/img/Gereja WKO.jpg')}}">
<title> {{$title}} </title>
<head>
    <!-- Head -->
    @include('Includes.head')

    <!-- Styles and Scripts -->
    @stack('head-script')
</head>

<body>
    <div class="loading-wrapper">
        <div>Loading...</div>
    </div>
    <div class="container-fluid">
        <header>
            @include('Includes.header')
        </header>

        <main class="row">
           @include('Includes.sidebar')
            <div class="float-left" style="background-color: #f3F3F3" id="content">
                <div class="row">
                    @yield('content')
                </div>
            </div>
        </main>

        <footer>
            @include('Includes.footer')
        </footer>
    </div>
    <script src="<?= asset('/js/jquery-3.5.1.js') ?>"></script>
    <script src="<?= asset('/js/bootstrap.js') ?>"></script>
    <script src="{{asset('/js/font-awesome.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.tiny.cloud/1/drzndcs7x99r8cewem7nspuqoj8oakvdc6b38dmtrikywtub/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        $('#data_jemaat').click(function() {
            $('#manajemen_jemaat').slideToggle('slow');
            $('#baptis').slideToggle("slow");
            $('#sidi').slideToggle("slow");
            $('#kartu_keluarga').slideToggle("slow");
        });
        $('#event').click(function() {
            $('#hut').slideToggle("slow");
            $('#hari_reformasi_gereja').slideToggle("slow");
            $('#perjamuan_kudus').slideToggle("slow");
        });
        $('#manajemen_pelayan').click(function(){
            $('#rapat_evaluasi').slideToggle("slow");
            $('#pembagian_tugas').slideToggle("slow");
            $('#pembagian_majelis').slideToggle("slow");
        });
        $('#pembagian_tugas').click(function(){
            $('#majelis_ibadah_minggu').slideToggle("slow");
            $('#khadim').slideToggle("slow");
            $('#penataan_bunga').slideToggle("slow");
            $('#pemusik').slideToggle("slow");
            $('#pujian').slideToggle("slow");
            $('#penerima_tamu').slideToggle("slow");
        });
        $('#website').click(function() {
            $('#slideshow').slideToggle("slow");
            $('#aboutUs').slideToggle("slow");
            $('#service').slideToggle("slow");
            $('#bulletin').slideToggle("slow");
            $('#testimony').slideToggle("slow");
            $('#renungan').slideToggle("slow");
        });
        $('#pengaturan').click(function(){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-primary m-2',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                title: 'Write Down Your Password <i class="fas fa-key"> </i>',
                input: 'password',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Confirm <i class="fas fa-check-circle"> </i>',
                cancelButtonText : 'Batal <i class="fas fa-times-circle"> </i>',
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    $.ajax({
                        url : '<?= asset('/adm/login/cekPassword') ?>',
                        method : 'POST',
                        data : {password : login},
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success:function(data){
                            if(data != "FAILED"){
                                Swal.fire({
                                    title: '<i class="fas fa-spinner fa-pulse"> </i>',
                                    text : 'Processing',
                                    showConfirmButton: false,
                                    timer: 3500
                                })
                                $('#pengaturanModal').modal('show');
                            }else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Wrong Password',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                            console.log(data);
                        }
                    })
                }
            })
        });
        @if(!session()->has('username'))
            $('div').css('display','none');
            Swal.fire({
                icon: 'error',
                title: 'Peringatan',
                text : 'Anda wajib melakukan login terlebih dahulu',
                showConfirmButton: false,
                timer: 2500            
            })
            location.href="<?= asset('/login') ?>";
        @endif 
    </script>
    @stack('js')
</body>

</html>