@extends('Layouts.frontend',['title' => 'Home'])
@section('content')
<div class="col-lg-12 hero-image" id="rumah">
    
</div>

<div class="col-lg-12" style="background-image: url('{{ asset('img/background-gereja.webp') }}');background-size:cover;background-position:center;background-repeat:no-repeat;position:relative">
    <div class="color-overlay"></div>
    <div class="row">
        <div class="col-lg-12 services-wrapper">
            <div class="text-center py-5" id="font22" ><h2><strong><font>Pelayanan Kami</font></strong></h2></div>
            <div class="container">
                <div class="row px-3" id="pelayananKami">
                    <div class="col-lg-4 col-sm-4 col-md-6 col-4">
                        <a href="{{url('/jadwalIbadah')}}" style="color:black;text-decoration: none;">
                            <div class="row mb-4">
                                <div class="col-lg-3 col-sm-3 col-2 text-right">
                                    <i class="fas fa-calendar-alt font15px" style="margin-top: 10px;font-size:50px;margin-right:10px;"></i>
                                </div>
                                <div class="col-lg-9 col-sm-9 col-12">
                                    <div id="font15"><strong>Jadwal Ibadah</strong></div>
                                    <div id="font15">Rasakan hadirat Tuhan di setiap waktu lewat pujian, penyembahan dan firman Tuhan.</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-md-6 col-4">
                        <a href="#pelayanan" style="color:black;text-decoration:none" id="layanan"> 
                            <div class="row mb-4">
                                <div class="col-lg-3 col-sm-3 col-2 text-right">
                                    <i class="fas fa-praying-hands font15px" style="margin-top: 10px;font-size:50px"></i>
                                </div>
                                <div class="col-lg-9 col-sm-9 col-12">
                                    <div id="font15"><strong>Pelayanan Doa</strong></div>
                                    <div id="font15">Para hamba Tuhan yang akan siap melayani anda melalui doa.</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-md-6 col-4">
                        <a href="{{url('/komunitas')}}" style="color:black;text-decoration:none"> 
                            <div class="row mb-4">
                                <div class="col-lg-3 col-sm-3 col-2 text-right">
                                    <i class="fas fa-users font15px" style="margin-top: 10px;font-size:50px"></i>
                                </div>
                                <div class="col-lg-9 col-sm-9 col-12">
                                    <div id="font15"><strong>Komunitas Gereja</strong></div>
                                    <div id="font15">Mari bertumbuh bersama lewat komunitas yang telah Tuhan percayakan.</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-md-6 col-4">
                        <a href="#pelayanan" style="color:black;text-decoration:none" id="layanan"> 
                            <div class="row mb-4">
                                <div class="col-lg-3 col-sm-3 col-2 text-right">
                                    <i class="fas fa-hands font15px" style="margin-top: 10px;font-size:50px"></i>
                                </div>
                                <div class="col-lg-9 col-sm-9 col-12">
                                    <div id="font15"><strong>Pelayanan Jemaat</strong></div>
                                    <div id="font15">Melayani setiap jemaat Tuhan dalam kasih dan anugrah Tuhan.</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-md-6 col-4">
                        <a href="#pelayanan" style="color:black;text-decoration:none" id="layanan"> 
                            <div class="row mb-4">
                                <div class="col-lg-3 col-sm-3 col-2 text-right">
                                    <i class="fas fa-hand-holding-medical font15px" style="margin-top: 10px;font-size:50px"></i>
                                </div>
                                <div class="col-lg-9 col-sm-9 col-12">
                                    <div id="font15"><strong>Pelayanan Baptis</strong></div>
                                    <div id="font15">Baptis merupakan bentuk iman kita dalam mengakui Yesus sebagai juru selamat.</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-md-6 col-4">
                        <div class="row mb-4">
                            <div class="col-lg-3 col-sm-3 col-2 text-right">
                                <i class="fas fa-volume-up font15px"  style="margin-top: 10px;font-size:50px"></i>
                            </div>
                            <div class="col-lg-9 col-sm-9 col-12">
                                <div id="font15"><strong>Kesaksian Jemaat</strong></div>
                                <div id="font15">Kesaksian rohani yang diberikan melalui Roh Kudus yang mampu menjamah dan mengubah hidup.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 services-wrapper" id="ayatHarian">
            <div class="text-center py-5" id="font22"><h2><strong><font> Ayat Hari Ini </font></strong></h2></div>
            <div class="container">
                <center>
                   @if($isAyatHarian)
                        <div class="row">
                            <div class="col-lg-12 shadow">
                                <center>
                                    <div style="padding:30px">
                                        <b><font style="font-size: 20px" id="AyatHarian"></font></b><br><br>
                                        <i><font style="font-size: 20px" id="isiAyatHarian"></font></i><hr>
                                    </div>
                                </center>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-lg-12 shadow">
                                <center>
                                    <div style="padding:30px">
                                        <b><font style="font-size: 20px" id="AyatHarian"></font></b><br><br>
                                        <i><font style="font-size: 20px" id="isiAyatHarian"></font></i><hr>
                                    </div>
                                </center>
                            </div>
                        </div>
                    @endif               
                </center>
            </div>
        </div>
        <div class="col-lg-12 services-wrapper" id="about">
            <div class="text-center py-5" id="font22"><h2><strong><font> Tentang Kami </font></strong></h2></div>
                <center>
                    <div class="row">
                        <div class="container">
                            <div class="col-lg-12 px-3" id="font15">
                                <font>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum
                                </font>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="container">
                            <div class="row mt-2">
                                <div class="col-lg-4 col-sm-4 col-md-4">
                                    <acronym title="Struktur Gereja">
                                        <img src="<?= asset('/img/Struktur Organisasi.jpg') ?>" onclick="strukturGereja()" alt="Gereja SION WKO 1" class="p-2" style="height:100%;width:100%;cursor: pointer;">
                                    </acronym>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-md-4">
                                    <acronym title="Visi Misi Gereja">
                                        <img src="<?= asset('/img/Sion 3.jpg') ?>" onclick="visiMisiGereja()" alt="Gereja SION WKO 1" class="p-2" style="height:100%;width:100%;cursor: pointer;">
                                    </acronym>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-md-4">
                                    <acronym title="Majelis Gereja">
                                        <img src="<?= asset('/img/Foto Majelis.jpg') ?>" onclick="majelisGereja()" alt="Gereja SION WKO 1" class="p-2" style="height:100%;width:100%;cursor: pointer;">
                                    </acronym>
                                </div>
                            </div>
                        </div>
                    </div>
                </center>
        </div>
        <div class="col-lg-12 services-wrapper" id="pelayanan">
            <div class="container">
                <div class="text-center py-5" id="font22">
                    <h2><strong> <font>Pelayanan </font> </strong></h2>
                    <font class="font15px"> <u> Tekan gambar untuk informasi lebih lanjut </u> </font>
                </div>
                <center>
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <acronym title="Pelayana Doa">
                                    <img class="d-block w-100" style="cursor: pointer;" onclick="pelayananDoa()" src="<?= asset('/img/Pelayanan Doa.png') ?>" alt="Pelayanan Doa">
                                </acronym>
                            </div>
                            <div class="carousel-item">
                                <acronym title="Pelanan Jemaat">
                                    <img class="d-block w-100" style="cursor: pointer;" onclick="pelayananJemaat()" src="<?= asset('/img/Pelayanan Jemaat.png') ?>" alt="Pelayanan Jemaat">
                                </acronym>
                            </div>
                            <div class="carousel-item">
                                <acronym title="Pelanan Baptis">
                                    <img class="d-block w-100" style="cursor: pointer;" onclick="pelayananBaptis()" src="<?= asset('/img/Pelayanan Baptisan.png') ?>" alt="Pelayanan Baptis">
                                </acronym>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </center>
            </div>
        </div>
        <div class="col-lg-12 services-wrapper" id="berita">
            <div class="container">
                <div class="text-center py-5" id="font22"><h2><strong> <font> Berita Gereja  </font></strong></h2></div>
                <center>
                    <img src="<?= asset('/img/Berita Gereja.png') ?>" alt="Berita" style="width:80%"><br><br>
                    <a href="javascript:void(0)" onclick="downloadBulletin()"> Download Disini </a> 
                </center>
            </div>
        </div>
        <div class="col-lg-12 services-wrapper">
            <div class="text-center py-5" id="font22"><h2><strong> <font> Hubungi Kami </font> </strong></h2></div>
            <div class="container">
                <div class="row px-3">
                    <div class="col-lg-8">
                        <form method="POST" enctype="multipart/form-data" id="saveMessagePost">
                            <div class="form-group">
                                @csrf
                                <input type="hidden" value="{{$id_kesaksian}}" name="testimony_id">
                                <div class="col-xl-12">
                                    <div class="row">
                                        <div class="col-xl-6 col-sm-6">
                                            <input type="text" class="form-control" placeholder="Nama" id="name" name="name" >
                                        </div>
                                        <div class="col-xl-6 col-sm-6">
                                            <input type="text" class="form-control" placeholder="E-mail"  id="email" name="email" >
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-xl-12">
                                            <input type="text" class="form-control" placeholder="Subject" id="subject" name="subject" >
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-xl-12">
                                            <textarea name="message" id="message" placeholder="Pesan" class="form-control" style="resize:none;height:300px;"></textarea>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-xl-2">
                                            <button class="btn btn-secondary" id="saveMessage" type="button" onclick="sendMessage()"> <i class="fas fa-paper-plane"></i> Kirim </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4">
                        <center>
                            <font style="font-size: 24px;" id="font22"> Gedung Gereja </font> <br><br>
                            <img src="<?= asset('/img/Sion 1.jpg') ?>" alt="Gereja" style="width:100px;height:150px;">
                            <img src="<?= asset('/img/Gereja sion-3.jpg') ?>" alt="Gereja" style="width:100px;height:150px;">
                            <img src="<?= asset('/img/Sion 6.jpg') ?>" alt="Gereja" style="width:100px;height:150px;">
                        </center>
                            <br><br>
                            <font class="font15px"><b> Alamat </b> </font><br>
                            <font> WKO, Tobelo Tengah, Halmahera Utara, <br>Maluku Utara, Indonesia </font><br><br>
                            <font><b> Telp  </b></font><br>
                            <font> <a style="text-decoration:none;color:black" href="https://wa.me/6281278293745/?text=Saya hendak menghubungi pihak Gereja untuk suatu keperluan. Apakah bisa menghubungi saya kembali ? Terima kasih. Tuhan Yesus Memberkati"> 0812-7829-3745 </a></font><br><br>
                            <font> <b> Data Statistik Gereja </b> </font> <br>
                            <a href="javascript:void(0)" onclick="dataStatistikJemaat()"> Lihat disini </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 location-wrapper">
           <div class="container">
                <div class="text-center py-5"><h2><strong>Lokasi Gereja</strong></h2></div>
                <div class="row px-3">
                    <div class="col-lg-6"> 
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1994.0250277073437!2d128.0034904136227!3d1.7058890355897067!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x329a6069e30d1633%3A0xdd9dada54edc0988!2sGEREJA%20SION%20WKO!5e0!3m2!1sen!2sid!4v1667395676974!5m2!1sen!2sid"width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="col-lg-6">
                        <div style="background-image: url('{{ asset('img/Sion 3.jpg') }}');background-size:cover;background-position:center;background-repeat:no-repeat;height:100%;"></div>
                    </div>
                </div>  
           </div>
        </div>
        <div class="col-lg-12 footer-wrapper">
            <div class="container">
                <div class="row px-3">
                    <div class="col-lg-12 bible-verse">
                        Janganlah kita menjauhkan diri dari pertemuan-pertemuan ibadah kita seperti dibiasakan beberapa orang tetapi marilah kita saling menashiati dan semakin giat melakukannya menjelang hari tuhan yang mendekat. <br>
                        - Ibrani 10:25 - 
                    </div>
                    <div class="col-lg-12 copyright">
                        2022 OLEH GEREJA MASEHI DI HALMAHERA UTARA <br>
                        &copy; ALL RIGHTS RESERVED
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Link untuk plagiat nanti https://pofo.themezaa.com/home-classic-one-page-portfolio-gallery/-->
@endsection
@push('js')
<script>
    $("#frontend-navbar ul a").on("click", function (e) {  
        e.preventDefault();
        const href = $(this).attr("href");
        $("html, body").animate({ scrollTop: $(href).offset().top }, 800);
    });
    $("#layanan").on("click", function (e) {  
        e.preventDefault();
        const href = $(this).attr("href");
        $("html, body").animate({ scrollTop: $(href).offset().top }, 1000);
    });
    tinymce.init({
      selector: 'textarea#message'
    });
    function downloadBulletin(){
        location.href="<?= asset('/adm/bulletin/downloadBulletin')."/".date('m') ?>"
    }
    function goToIbadah(){
        location.href="<?= url('/jadwalIbadah') ?>";
    }
    function goToKesaksian(){
        location.href="<?= url('/kesaksian') ?>";
    }
    function goToRenungan(){
        location.href="<?= url('/renungan') ?>";
    }
    @if($isAyatHarian)
        refreshAyatHarianDB();
    @else
        refreshAyatHarianAPI();  
    @endif
    function refreshAyatHarianDB(){
        $.ajax({
            url : '<?= url('/loadAyatHarianDB') ?>',
            method : 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                var arr_data = data.split('###');
                $('#AyatHarian').html(arr_data[0]);
                $('#isiAyatHarian').html(arr_data[1]);
            }
        });
    }
    function refreshAyatHarianAPI(){
        $.ajax({
            url : '<?= url('/loadAyatHarianAPI') ?>',
            method : 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                var arr_data = data.split('###');
                $('#AyatHarian').html(arr_data[0]);
                $('#isiAyatHarian').html(arr_data[1]);
                addAyatHarian(arr_data[0],arr_data[1]);
            }
        });
    }
    function addAyatHarian(ayat,isiAyat){
        $.ajax({
            url : '<?= url('/isiAyatHarian') ?>',
            method : 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data : {ayat : ayat , isiAyat : isiAyat},
            success:function(data){
                console.log(data);
            }
        });
    }
    function sendMessage(){
        const nama = $('#name').val();
        const email = $('#email').val();
        const subject = $('#subject').val();
        const pesan = $('#message').val();
        if(nama == ""){
            Swal.fire({
                title: 'Peringatan',
                text: "Nama tidak boleh kosong",
                icon: 'warning',
                showConfirmButton: false,
                timer: 1500
            })
        }else if(email == ""){
            Swal.fire({
                title: 'Peringatan',
                text: "Email tidak boleh kosong",
                icon: 'warning',
                showConfirmButton: false,
                timer: 1500
            })
        }else if(subject == ""){
            Swal.fire({
                title: 'Peringatan',
                text: "Judul tidak boleh kosong",
                icon: 'warning',
                showConfirmButton: false,
                timer: 1500
            })
        }else{
            Swal.fire({
                title: 'Perhatian',
                text: "Apakah data yang di isi sudah sesuai ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, sudah benar',
                cancelButtonText : 'Tidak, belum'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#saveMessagePost').attr('action','<?= '/hubungiKami' ?>');
                    $('#saveMessage').attr('type','submit');
                    setTimeout(function() {
                        $("#saveMessage").trigger('click');
                    }, 100);
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Batal',
                        text: 'Data batal dihapus',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            })
        }
    }
    function pelayananDoa(){
        Swal.fire({
            title: 'Pelayanan Doa <i class="fas fa-praying-hands"></i>',
            html : '<br><div class="row"><div class="col-lg-6" style="float:left;text-align:left;"><br>Kami bisa dikunjungi : <br> <table style="font-size:14px;"> <tr> <th> &nbsp; Tempat </th> <th> : Ruang Konseling </th> </tr> <tr> <th> </th> <th> &nbsp; Gereja Sion WKO  </th> </tr> <tr> <th> &nbsp; Waktu </th> <th> : Setiap Hari Minggu, 10.30 WIT </th> </tr> </table></div><div style="float:right;text-align:right;font-size:14px;" class="col-lg-6"><br>Kami bisa dihubungi : <br> <b> <a style="text-decoration:none;color:black;" href="https://wa.me/6281278293745/?text=Saya hendak mengajukan layanan doa. Apakah bisa menghubungi saya kembali ? Terima kasih. Tuhan Yesus Memberkati"> Sekretaris Gereja Sion WKO (0812-7829-3745) </a> </b><br</div></div><div calss="row"><br><div class="col-lg-12" style="text-align:left;font-size:13px;"> Konseling ini terbuka bagi : <b> Seluruh Jemaat Sion WKO </b></div><div class="col-lg-12" style="font-size:13px;"> <br><br> Filipi 4 : 6 - 7 <br> <i> "Janganlah hendaknya kamu kuatir tentang apa pun juga, tetapi nyatakanlah dalam segala hal keinginanmu kepada Allah dalam doa dan permohonan dengan ucapan syukur. Damai sejahtera Allah, yang melampaui segala akal, akan memelihara hati dan pikiranmu dalam Kristus Yesus." </i> </div></div>',
            showConfirmButton: false,
            showCloseButton: true,
            width : '50%'
        })
    }
    function pelayananJemaat(){
        Swal.fire({
            title: 'Pelayanan Jemaat <i class="fas fa-hands"></i> ',
            html : '<br><div class="row"><div class="col-lg-12" style="float:left;text-align:left;"> Kunjungan dapat dilaksanakan setiap selesai ibadah dengan menghubungi melalui Majelis Lingkungan Pelayanan yang bersangkutan. <br><br> Kontak Person : <br> <b> <font style="font-size:15px;"> Sekretaris Gereja Sion WKO (0812-7829-3745)  </font> </b><br><br> <font style="font-size:13px;"> Roma 14 : 9 <i> "Sebab itu marilah kita mengejar apa yang mendatangkan damai sejahtera dan yang berguna untuk saling membangun." </i> </font> </div></div>',
            showConfirmButton: false,
            showCloseButton: true,
            width : '50%'
        })
    }
    function pelayananBaptis(){
        Swal.fire({
            title: 'Pelayanan Baptis <i class="fas fa-hand-holding-medical"></i> ',
            html : '<br><div class="row"><div class="col-lg-6" style="float:left;"> <center> <div class="col-12" style="border-top:6px dashed;border-bottom:6px dashed;margin:20px;padding:20px;"> <br><br><br> <h2> Baptisan Air </h2> <br><br> <br> Info dan Pendaftaran : <br> <b> Sekretasi Sion WKO </b>  <br><br><br> <font style="font-size:13px;"> Yohanes 3 : 5 <i> Jawab Yesus: ”Aku berkata kepadamu, sesungguhnya jika seorang tidak dilahirkan dari air dan Roh, ia tidak dapat masuk ke dalam Kerajaan Allah. </i> </font> </div></center> </div><div class="col-lg-6" style="float:left;"> <img src="<?= asset("/img/Gambar Baptis.jpg") ?>" style="width:100%;"> </div></div>',
            showConfirmButton: false,
            width : '50%',
            showCloseButton: true,
            position : 'bottom'
        })
    }
    function strukturGereja(){
        Swal.fire({
            html : '<br><div class="row"><div class="col-lg-12"><img src="<?= asset('/img/Struktur Organisasi.jpg') ?>" style="width:60%;"><br><font style="font-size:15px"> <b> Gambar 1. </b> Struktur Gereja Sion WKO</font></div><div class="col-lg-12" style="text-align:justify;font-size:16px;margin-top:10px"> <p>  &emsp; Gereja Sion WKO yang berlokasi di Kabupaten Halmahera Utara, Kec. Tobelo Utara merupakan gereja Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p> </div></div>',
            showConfirmButton: false,
            width : '50%',
            showCloseButton: true,
            position : 'bottom'
        })
    }
    function visiMisiGereja(){
        Swal.fire({
            html : '<br><div class="row"><div class="col-lg-12"><img src="<?= asset('/img/Sion 3.jpg') ?>" style="width:60%;"><br><font style="font-size:15px"> <b> Gambar 2. </b> Visi Misi Gereja Sion WKO</font></div><div class="col-lg-12" style="text-align:justify;margin-top:10px;font-size:16px"> <p>  &emsp; Gereja Sion WKO yang berlokasi di Kabupaten Halmahera Utara, Kec. Tobelo Utara merupakan gereja Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p> </div></div>',
            showConfirmButton: false,
            width : '50%',
            showCloseButton: true,
            position : 'bottom'
        })
    }
    function majelisGereja(){
        Swal.fire({
            html : '<br><div class="row"><div class="col-lg-12"><img src="<?= asset('/img/Foto Majelis.jpg') ?>" style="width:60%;"><br><font style="font-size:15px"> <b> Gambar 3. </b> Majelis Gereja Sion WKO</font></div><div class="col-lg-12" style="text-align:justify;margin-top:10px;font-size:16px"> <p>  &emsp; Gereja Sion WKO yang berlokasi di Kabupaten Halmahera Utara, Kec. Tobelo Utara merupakan gereja Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry.  </p> </div></div>',
            showConfirmButton: false,
            width : '50%',
            showCloseButton: true,
            position : 'bottom'
        })
    }
    function dataStatistikJemaat(){
        $.ajax({
            url : '<?= url('/dataStatistikJemaat') ?>',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                Swal.fire({
                    html : data,
                    showConfirmButton: false,
                    showCloseButton: true,
                    width : '100%',
                    position : 'bottom'
                })
            }
        });
    }
</script>
@endpush