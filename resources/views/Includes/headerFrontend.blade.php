<nav class="navbar navbar-expand-lg navbar-light bg-light my-navbar" id="navbar">
    <a class="navbar-brand" href="{{url('/')}}" id="navGerejaMasehi">
        <img src="{{asset('/img/Gereja SION WKO.png')}}" style="max-width:80px;" alt="">
        <span style="line-height: 1;display:inline-block;margin-left:10px;font-size:16px !important;font-weight:bold;vertical-align:middle;color:black;">
            GEREJA SION WKO <br> HALMAHERA UTARA
        </span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#frontend-navbar"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse ml-auto " id="frontend-navbar">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item ">
                <a class="nav-link fontSmall" href="{{url('/')}}"> <font style="color:white;" id="fontHome"> <i class="fas fa-home font15px"></i> HOME </font> </a>
            </li>
            <li class="nav-item">
                <a class="nav-link fontSmall" onclick="goToIbadah()" style="cursor: pointer;"> <font style="color:white;" id="fontIbadah"> <i class="fas fa-church"></i> IBADAH </font> </a>
            </li>
            <li class="nav-item">
                <a class="nav-link fontSmall" onclick="goToRenungan()" style="cursor: pointer;"> <font style="color:white;" id="fontRenungan"> <i class="fas fa-book-open"></i> RENUNGAN HARIAN </font> </a>
            </li>
            <li class="nav-item">
                <a class="nav-link fontSmall" href="#berita"> <font style="color:white;" id="fontBerita"> <i class="fas fa-newspaper"></i> BERITA </font> </a>
            </li>
            <li class="nav-item">
                <a class="nav-link fontSmall" href="#about"> <font style="color:white;" id="fontTentangKami"> <i class="fas fa-user-tie"></i> TENTANG KAMI </font> </a>
            </li>
            <li class="nav-item">
                <a class="nav-link fontSmall" onclick="gotoToEvent()" style="cursor: pointer"> <font style="color:white;" id="fontEvent"> <i class="fas fa-calendar-week"></i> EVENT </font> </a>
            </li>
            <li class="nav-item">
                <a class="nav-link fontSmall" onclick="goToKesaksian()" style="cursor: pointer;"> <font style="color:white;" id="fontKesaksian"> <i class="fas fa-volume-up"></i> KESAKSIAN </font> </a>
            </li>
        </ul>
    </div>
</nav>
