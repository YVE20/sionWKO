<<<<<<< HEAD
@extends('layouts.frontend',['title' => 'Home'])
=======
@extends('Layouts.frontend',['title' => 'Home'])
>>>>>>> e31524c9c0cb566971c2c2d7d469a6cb9f1aac23
@section('content')
<div class="col-lg-12 hero-image" id="rumah">
    
</div>

<div class="col-lg-12" style="background-image: url('{{ asset('img/background-gereja.webp') }}');background-size:cover;background-position:center;background-repeat:no-repeat;position:relative">
    <div class="color-overlay"></div>
    <div class="row">
        <div class="col-lg-12 services-wrapper">
            <div class="text-center py-5"><h2><strong>Pelayanan Kami</strong></h2></div>
            <div class="container">
                <div class="row px-3">
                    <div class="col-lg-4 col-6">
                        <a href="{{url('/jadwalIbadah')}}" style="color:black;text-decoration: none;">
                            <div class="row mb-4">
                                <div class="col-lg-3 col-3 text-right">
                                    <i class="fas fa-calendar-alt" style="margin-top: 10px;font-size:50px;margin-right:10px;"></i>
                                </div>
                                <div class="col-lg-9 col-9">
                                    <div><strong>Jadwal Ibadah</strong></div>
                                    <div>Rasakan hadirat Tuhan di setiap waktu lewat pujian, penyembahan dan firman Tuhan.</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-6">
                        <a href="#pelayanan" style="color:black;text-decoration:none" id="layanan"> 
                            <div class="row mb-4">
                                <div class="col-lg-3 col-3 text-right">
                                    <i class="fas fa-praying-hands" style="margin-top: 10px;font-size:50px"></i>
                                </div>
                                <div class="col-lg-9 col-6">
                                    <div><strong>Pelayanan Doa</strong></div>
                                    <div>Para hamba Tuhan yang akan siap melayani anda melalui doa.</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-12">
                        <a href="{{url('/komunitas')}}" style="color:black;text-decoration:none"> 
                            <div class="row mb-4">
                                <div class="col-lg-3 col-3 text-right">
                                    <i class="fas fa-users" style="margin-top: 10px;font-size:50px"></i>
                                </div>
                                <div class="col-lg-9 col-9">
                                    <div><strong>Komunitas Gereja</strong></div>
                                    <div>Mari bertumbuh bersama lewat komunitas yang telah Tuhan percayakan.</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row px-3 mb-4">
                    <div class="col-lg-4 col-6">
                        <a href="#pelayanan" style="color:black;text-decoration:none" id="layanan"> 
                            <div class="row mb-4">
                                <div class="col-lg-3 col-3 text-right">
                                    <i class="fas fa-hands" style="margin-top: 10px;font-size:50px"></i>
                                </div>
                                <div class="col-lg-9 col-9">
                                    <div><strong>Pelayanan Jemaat</strong></div>
                                    <div>Melayani setiap jemaat Tuhan dalam kasih dan anugrah Tuhan.</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-6">
                        <a href="#pelayanan" style="color:black;text-decoration:none" id="layanan"> 
                            <div class="row mb-4">
                                <div class="col-lg-3 col-3 text-right">
                                    <i class="fas fa-hand-holding-medical" style="margin-top: 10px;font-size:50px"></i>
                                </div>
                                <div class="col-lg-9 col-9">
                                    <div><strong>Pelayanan Baptis</strong></div>
                                    <div>Baptis merupakan bentuk iman kita dalam mengakui Yesus sebagai juru selamat.</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="row mb-4">
                            <div class="col-lg-3 col-3 text-right">
                                <i class="fas fa-volume-up"  style="margin-top: 10px;font-size:50px"></i>
                            </div>
                            <div class="col-lg-9 col-9">
                                <div><strong>Kesaksian Jemaat</strong></div>
                                <div>Kesaksian rohani yang diberikan melalui Roh Kudus yang mampu menjamah dan mengubah hidup.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 services-wrapper" id="about">
            <div class="text-center py-5"><h2><strong> Tentang Kami </strong></h2></div>
                <center>
                    <div class="col-lg-7 px-3">
                        <font>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum
                        </font><br>
                        <div class="col-lg-4 col-3  float-left" style="margin-top:50px;">
                            <img src="<?= asset('/img/Sion 2.jpg') ?>" alt="Gereja SION WKO 1" class="p-2" style="height:200px;width:80%px">
                        </div>
                        <div class="col-lg-4 col-3  float-left" style="margin-top:50px;">
                            <img src="<?= asset('/img/Sion 3.jpg') ?>" alt="Gereja SION WKO 1" class="p-2" style="height:200px;width:80%px">
                        </div>
                        <div class="col-lg-4 col-3  float-left" style="margin-top:50px;">
                            <img src="<?= asset('/img/Sion 7.jpg') ?>" alt="Gereja SION WKO 1" class="p-2" style="height:200px;width:80%px">
                        </div>
                    </div>
                </center>
        </div>
        <div class="col-lg-12 services-wrapper" id="pelayanan">
            <div class="container">
                <div class="text-center py-5">
                    <h2><strong> Pelayanan </strong></h2>
                    <font> <u> Tekan gambar untuk informasi lebih lanjut </u> </font>
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
                                    <img class="d-block w-100" style="cursor: pointer;" onclick="pelayananDoa()" src="<?= asset('/img/Pelayanan Doa.jpg') ?>" alt="Pelayanan Doa">
                                </acronym>
                            </div>
                            <div class="carousel-item">
                                <acronym title="Pelanan Jemaat">
                                    <img class="d-block w-100" style="cursor: pointer;" onclick="pelayananJemaat()" src="<?= asset('/img/Pelayanan Jemaat.jpg') ?>" alt="Pelayanan Jemaat">
                                </acronym>
                            </div>
                            <div class="carousel-item">
                                <acronym title="Pelanan Baptis">
                                    <img class="d-block w-100" style="cursor: pointer;" onclick="pelayananBaptis()" src="<?= asset('/img/Pelayanan Baptis.png') ?>" alt="Pelayanan Baptis">
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
                <div class="text-center py-5"><h2><strong> Berita Gereja </strong></h2></div>
                <center>
                    <img src="<?= asset('/img/Berita Gereja.png') ?>" alt="Berita" style="width:80%"><br><br>
                    <a href="javascript:void(0)" onclick="downloadBulletin()"> Download Disini </a>||
                    <a href="<?= asset('/downloadManageJemaat') ?>"> Download Data Jemaat </a>
                </center>
            </div>
        </div>
        <div class="col-lg-12 services-wrapper">
            <div class="text-center py-5"><h2><strong> Hubungi Kami </strong></h2></div>
            <div class="container">
                <div class="row px-3">
                    <div class="col-lg-8">
                        <form method="POST" enctype="multipart/form-data" id="saveMessagePost">
                            <div class="form-group">
                                @csrf
                                <input type="hidden" value="{{$id_kesaksian}}" name="testimony_id">
                                <div class="col-xl-12">
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <input type="text" class="form-control" placeholder="Nama" id="name" name="name" >
                                        </div>
                                        <div class="col-xl-6">
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
                        <font style="font-size: 24px;"> Gedung Gereja </font> <br><br>
                        <img src="<?= asset('/img/Sion 1.jpg') ?>" alt="Gereja" style="width:120px;height:170px;">
                        <img src="<?= asset('/img/Gereja sion-3.jpg') ?>" alt="Gereja" style="width:120px;height:170px;">
                        <br><br>
                        <font><b> Alamat </b> </font><br>
                        <font> WKO, Tobelo Tengah, Halmahera Utara, <br>Maluku Utara, Indonesia </font><br><br>
                        <font><b> Telp  </b></font><br>
                        <font> 0831-1233-1234</font>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 location-wrapper">
           <div class="container">
                <div class="text-center py-5"><h2><strong>Lokasi Gereja</strong></h2></div>
                <div class="row px-3">
                    <div class="col-lg-6">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3987.9998450299563!2d128.00999027308282!3d1.7299409197953088!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x329a61b6631599d3%3A0xc88152b44c94111c!2sKantor%20Sinode%20Gereja%20Masehi%20Injili%20Halmahera!5e0!3m2!1sid!2sid!4v1665719176949!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>   
                    </div>
                    <div class="col-lg-6">
                        <div style="background-image: url('{{ asset('img/2019-04-19.jpg') }}');background-size:cover;background-position:center;background-repeat:no-repeat;height:100%;"></div>
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
            html : '<br><div class="row"><div class="col-lg-6" style="float:left;text-align:left;"><br>Kami bisa dikunjungi : <br> <table style="font-size:14px;"> <tr> <th> &nbsp; Tempat </th> <th> : Ruang Konseling </th> </tr> <tr> <th> </th> <th> &nbsp; Gereja Sion WKO  </th> </tr> <tr> <th> &nbsp; Waktu </th> <th> : Setiap Hari Minggu, 10.30 WIT </th> </tr> </table></div><div style="float:right;text-align:right;font-size:14px;" class="col-lg-6"><br>Kami bisa dihubungi : <br> <b> <a style="text-decoration:none;color:black;" href="https://wa.me/6281278293745/?text=Saya hendak mengajukan layanan doa. Apakah bisa menghubungi saya kembali ? Terima kasih. Tuhan Yesus Memberkati"> Sekretaris Gereja Sion WKO (0812-7829-3745) </a> </b><br</div></div><div calss="row"><br><div class="col-lg-12" style="text-align:left;font-size:13px;"> Konseling ini terbuka bagi : <b> Pasutri, Orangtua Tunggal, Lanjut Usia, Keluarga, UBK (Umat Kebutuhan Khusus) </b></div><div class="col-lg-12" style="font-size:13px;"> <br><br> Filipi 4 : 6 - 7 <br> <i> "Janganlah hendaknya kamu kuatir tentang apa pun juga, tetapi nyatakanlah dalam segala hal keinginanmu kepada Allah dalam doa dan permohonan dengan ucapan syukur. Damai sejahtera Allah, yang melampaui segala akal, akan memelihara hati dan pikiranmu dalam Kristus Yesus." </i> </div></div>',
            showConfirmButton: false,
            width : '50%'
        })
    }
    function pelayananJemaat(){
        Swal.fire({
            title: 'Pelayanan Jemaat <i class="fas fa-hands"></i> ',
            html : '<br><div class="row"><div class="col-lg-12" style="float:left;text-align:left;"> Kunjungan akan dilaksanakan setiap selesai ibadah dengan menghubungi melalui Majelis Lingkungan Pelayanan yang bersangkutan. <br><br> Kontak Person : <br> <b> <font style="font-size:15px;"> Sekretaris Gereja Sion WKO (0812-7829-3745)  </font> </b><br><br> <font style="font-size:13px;"> Roma 14 : 9 <i> "Sebab itu marilah kita mengejar apa yang mendatangkan damai sejahtera dan yang berguna untuk saling membangun." </i> </font> </div></div>',
            showConfirmButton: false,
            width : '50%'
        })
    }
    function pelayananBaptis(){
        Swal.fire({
            title: 'Pelayanan Baptis <i class="fas fa-hand-holding-medical"></i> ',
            html : '<br><div class="row"><div class="col-lg-6" style="float:left;"> <center> <div class="col-12" style="border-top:6px dashed;border-bottom:6px dashed;margin:20px;padding:20px;"> <br><br><br> <h2> Baptisan Air </h2> <br><br> Dilaksanakan setiap minggu ke-3 <br><br><br> Info dan Pendaftaran : <br> <b> Sekretasi Sion WKO </b>  <br><br><br> <font style="font-size:13px;"> Yohanes 3 : 5 <i> Jawab Yesus: ”Aku berkata kepadamu, sesungguhnya jika seorang tidak dilahirkan dari air dan Roh, ia tidak dapat masuk ke dalam Kerajaan Allah. </i> </font> </div></center> </div><div class="col-lg-6" style="float:left;"> <img src="<?= asset("/img/Gambar Baptis.jpg") ?>" style="width:100%;"> </div></div>',
            showConfirmButton: false,
            width : '50%'
        })
    }
</script>
@endpush